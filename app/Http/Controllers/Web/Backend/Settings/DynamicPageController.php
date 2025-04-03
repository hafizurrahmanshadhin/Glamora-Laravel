<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class DynamicPageController extends Controller {
    /**
     * Display a listing of dynamic page content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = DynamicPage::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('page_content', function ($data) {
                        $page_content       = $data->page_content;
                        $short_page_content = strlen($page_content) > 40 ? substr($page_content, 0, 40) . '...' : $page_content;
                        return '<p>' . $short_page_content . '</p>';
                    })

                    ->addColumn('status', function ($data) {
                        $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">';
                        $status .= '</div>';

                        return $status;
                    })

                    ->addColumn('action', function ($data) {
                        return '
                                <div class="hstack gap-3 fs-base">
                                    <a href="' . route('settings.dynamic_page.edit', ['id' => $data->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                        <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                    </a>

                                    <a href="javascript:void(0);" onclick="showDynamicPageDetails(' . $data->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewDynamicPageModal">
                                        <i class="ri-eye-line" style="font-size: 24px;"></i>
                                    </a>

                                    <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                        <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                    </a>
                                </div>
                            ';
                    })

                    ->rawColumns(['page_content', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.settings.dynamic_page.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified report details.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $data = DynamicPage::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetch successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new dynamic page content.
     *
     * @return View | JsonResponse
     */
    public function create(): View | JsonResponse {
        try {
            return view('backend.layouts.settings.dynamic_page.create');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created dynamic page content in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'page_title'   => 'required|string|max:100',
                'page_content' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data               = new DynamicPage();
            $data->page_title   = $request->page_title;
            $data->page_slug    = Str::slug($request->page_title);
            $data->page_content = $request->page_content;
            $data->save();

            return redirect()->route('settings.dynamic_page.index')->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return redirect()->route('settings.dynamic_page.index')->with('t-success', 'Dynamic Page failed created.');
        }
    }

    /**
     * Show the form for editing the specified dynamic page content.
     *
     * @param int $id
     * @return View|JsonResponse
     */
    public function edit(int $id): View | JsonResponse {
        try {
            $data = DynamicPage::find($id);
            return view('backend.layouts.settings.dynamic_page.edit', compact('data'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified dynamic page content in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'page_title'   => 'required|string|max:100',
                'page_content' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data               = DynamicPage::findOrFail($id);
            $data->page_title   = $request->page_title;
            $data->page_slug    = Str::slug($request->page_title);
            $data->page_content = $request->page_content;
            $data->update();

            return redirect()->route('settings.dynamic_page.index')->with('t-success', 'Dynamic Page Updated Successfully.');

        } catch (Exception) {
            return redirect()->route('settings.dynamic_page.index')->with('t-success', 'Dynamic Page failed to update');
        }
    }

    /**
     * Change the status of the specified dynamic page content.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $data = DynamicPage::findOrFail($id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Unpublished Successfully.',
                    'data'    => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Published Successfully.',
                    'data'    => $data,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified dynamic page content from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = DynamicPage::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Dynamic Page deleted successfully.',
            ]);
        } catch (Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Dynamic Page.',
            ]);
        }
    }
}
