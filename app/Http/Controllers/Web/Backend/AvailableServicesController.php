<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AvailableServicesController extends Controller {
    /**
     * Display the available-services view.
     *
     * @param Request $request The request object.
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = UserService::with(['user', 'service'])->where('status', 'inactive')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row->user ? $row->user->first_name . ' ' . $row->user->last_name : '-';
                })
                ->addColumn('email', function ($row) {
                    return $row->user ? $row->user->email : '-';
                })
                ->addColumn('service_name', function ($row) {
                    return $row->service ? $row->service->services_name : '-';
                })
                ->addColumn('status', function ($user) {
                    $status = '<select class="form-select" onchange="changeStatus(' . $user->id . ', this.value)">';
                    $status .= '<option value="active"' . ($user->status == 'active' ? ' selected' : '') . '>Approved</option>';
                    $status .= '<option value="inactive"' . ($user->status == 'inactive' ? ' selected' : '') . '>Pending</option>';
                    $status .= '</select>';

                    return $status;
                })
                ->rawColumns(['user_name', 'email', 'service_name', 'status'])
                ->make(true);
        }

        return view('backend.layouts.available-services.index');
    }

    /**
     * Update the status of the specified service.
     *
     * @param Request $request The request object.
     * @param int $id The service id.
     * @return JsonResponse
     */
    public function status(Request $request, int $id): JsonResponse {
        try {
            $userService = UserService::findOrFail($id);
            $newStatus   = $request->input('status');

            if (in_array($newStatus, ['active', 'inactive'])) {
                $userService->status = $newStatus;
                $userService->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Service status updated successfully.',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid status value.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not update status.',
            ], 500);
        }
    }
}
