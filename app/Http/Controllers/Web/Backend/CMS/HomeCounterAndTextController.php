<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class HomeCounterAndTextController extends Controller {
    /**
     * Display the home counter and text management page.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        try {
            if ($request->ajax()) {
                $data = CMS::where('section', 'home-counter')
                    ->latest()
                    ->select(['id', 'title', 'sub_title', 'status'])
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
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
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-home-counter" data-id="' . $data->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['description', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.cms.home-counter-and-text.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the home counter and text data.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): JsonResponse {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:255',
            'sub_title' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $data = CMS::findOrFail($id);
        if ($data->section !== 'home-counter') {
            return response()->json(['success' => false, 'message' => 'Invalid section for this operation.']);
        }

        try {
            $data->update([
                'title'     => $request->input('title'),
                'sub_title' => $request->input('sub_title'),
            ]);

            return response()->json(['success' => true, 'message' => 'Data updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating data' . $e->getMessage()]);
        }
    }

    /**
     * Toggle the status of the home counter and text data.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function status(int $id): JsonResponse {
        try {
            $data = CMS::findOrFail($id);

            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Data unpublished successfully.',
                    'data'    => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Data published successfully.',
                    'data'    => $data,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
