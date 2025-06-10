<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ServiceTypeController extends Controller {
    public function index(Request $request) {
        try {
            if ($request->ajax()) {
                $data = CMS::where('section', 'user-type-container')->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('description', function ($data) {
                        $description      = $data->description;
                        $shortDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                        return '<p>' . $shortDescription . '</p>';
                    })
                    ->addColumn('image', function ($data) {
                        $defaultImage = asset('backend/images/users/user-dummy-img.jpg');
                        $url          = $data->image ? asset($data->image) : $defaultImage;

                        return '
                            <div class="d-flex justify-content-center">
                                <img src="' . $url . '" alt="Image" width="75" height="75" style="cursor:pointer;"
                                     data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                     onclick="showImagePreview(\'' . $url . '\');" />
                            </div>
                        ';
                    })
                    ->addColumn('status', function ($data) {
                        return '
                            <div class="d-flex justify-content-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('action', function ($data) {
                        return '
                            <div class="d-flex justify-content-center hstack gap-3 fs-base">
                                <a href="' . route('cms.service-type.edit', ['id' => $data->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDataDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewDataModal" title="View">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['description', 'image', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.cms.service-type.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function show(int $id) {
        try {
            $data = CMS::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function edit(int $id) {
        try {
            $data = CMS::findOrFail($id);
            return view('backend.layouts.cms.service-type.edit', compact('data'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, int $id) {
        try {
            $validator = Validator::make($request->all(), [
                'title'       => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data              = CMS::findOrFail($id);
            $data->title       = $request->title;
            $data->description = $request->description;
            $data->section     = 'user-type-container';

            // If a new image is uploaded, delete the old image and upload the new one.
            if ($request->hasFile('image')) {
                if ($data->image) {
                    Helper::fileDelete(public_path($data->image));
                }
                $uploadPath = Helper::fileUpload($request->file('image'), 'serviceTypes', $request->name);
                if ($uploadPath !== null) {
                    $data->image = $uploadPath;
                }
            }

            $data->save();

            return redirect()->route('cms.service-type.index')->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update testimonial')->withInput();
        }
    }

    public function status(int $id) {
        try {
            $data = CMS::findOrFail($id);

            if ($data->status === 'active') {
                $data->status = 'inactive';
                $data->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $data);
            } else {
                $data->status = 'active';
                $data->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $data);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
