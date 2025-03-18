<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\UserGallery;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ImageApprovalRequestController extends Controller {
    /**
     * Display the image approval request view.
     *
     * @param Request $request The request object.
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = UserGallery::with('user')
                    ->where('status', 'inactive')
                    ->latest()
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user_name', function ($row) {
                        return $row->user
                        ? $row->user->first_name . ' ' . $row->user->last_name
                        : '-';
                    })
                    ->addColumn('email', function ($row) {
                        return $row->user ? $row->user->email : '-';
                    })
                    ->addColumn('image', function ($data) {
                        $defaultImage = asset('backend/images/default_images/user_1.jpg');
                        $url          = $data->image ? asset($data->image) : $defaultImage;

                        return '<a href="#" data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-image-src="' . $url . '">
                                    <img src="' . $url . '" alt="Image" width="100" height="100">
                                </a>';
                    })
                    ->addColumn('status', function ($user) {
                        $status = '<select class="form-select" onchange="changeStatus(' . $user->id . ', this.value)">';
                        $status .= '<option value="active"' . ($user->status == 'active' ? ' selected' : '') . '>Approved</option>';
                        $status .= '<option value="inactive"' . ($user->status == 'inactive' ? ' selected' : '') . '>Pending</option>';
                        $status .= '</select>';
                        return $status;
                    })
                    ->rawColumns(['user_name', 'email', 'image', 'status'])
                    ->make();
            }

            return view('backend.layouts.image-approval-request.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the status of the specified image approval request.
     *
     * @param Request $request The request object.
     * @param UserGallery $userGallery The user gallery object.
     * @return JsonResponse
     */
    public function status(Request $request, UserGallery $userGallery): JsonResponse {
        try {
            $newStatus = $request->input('status');
            if (in_array($newStatus, ['active', 'inactive'])) {
                $userGallery->status = $newStatus;
                $userGallery->save();

                return Helper::jsonResponse(true, 'Status updated successfully.', 200);
            }

            return Helper::jsonResponse(false, 'Invalid status value.', 400);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Could not update status.', 500);
        }
    }
}
