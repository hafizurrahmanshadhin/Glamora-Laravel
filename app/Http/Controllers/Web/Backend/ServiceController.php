<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller {
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = Service::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('platform_fee', function ($service) {
                        // Return with "%" appended for display
                        return $service->platform_fee . '%';
                    })
                    ->addColumn('status', function ($service) {
                        $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $service->id . '" ' . ($service->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $service->id . ')">';
                        $status .= '</div>';
                        return $status;
                    })
                    ->addColumn('action', function ($service) {
                        return '
                            <div class="hstack gap-3 fs-base">
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-service" data-id="' . $service->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $service->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size:24px;"></i>
                                </a>
                            </div>';
                    })
                    ->rawColumns(['platform_fee', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.service.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'services_name' => 'required|string|max:255|unique:services,services_name',
            'platform_fee'  => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            Service::create([
                'services_name' => $request->input('services_name'),
                'platform_fee'  => $request->input('platform_fee'),
            ]);

            return response()->json(['success' => true, 'message' => 'Service package created successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while creating the service package: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, int $id): JsonResponse {
        $validator = Validator::make($request->all(), [
            'services_name' => 'required|string|max:255|unique:services,services_name,' . $id,
            'platform_fee'  => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $service = Service::findOrFail($id);

        try {
            $service->update([
                'services_name' => $request->input('services_name'),
                'platform_fee'  => $request->input('platform_fee'),
            ]);

            return response()->json(['success' => true, 'message' => 'Service package updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the service package: ' . $e->getMessage()]);
        }
    }

    public function status(int $id): JsonResponse {
        try {
            $service = Service::findOrFail($id);

            if ($service->status == 'active') {
                $service->status = 'inactive';
                $service->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Service package unpublished successfully.',
                    'data'    => $service,
                ]);
            } else {
                $service->status = 'active';
                $service->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Service package published successfully.',
                    'data'    => $service,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            $service = Service::findOrFail($id);
            $service->delete();

            return response()->json([
                't-success' => true,
                'message'   => 'Service package deleted successfully.',
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
