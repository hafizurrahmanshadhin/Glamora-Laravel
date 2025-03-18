<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\StatusUpdateMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ClientController extends Controller {
    /**
     * Display the list of all client users.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = User::where('role', 'client')->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->first_name . ' ' . $data->last_name;
                    })
                    ->addColumn('status', function ($user) {
                        $status = '<select class="form-select" onchange="changeStatus(' . $user->id . ', this.value)">';
                        $status .= '<option value="active"' . ($user->status == 'active' ? ' selected' : '') . '>Approved</option>';
                        $status .= '<option value="inactive"' . ($user->status == 'inactive' ? ' selected' : '') . '>Pending</option>';
                        $status .= '</select>';

                        return $status;
                    })
                    ->addColumn('action', function ($user) {
                        return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                    <a href="javascript:void(0);" onclick="showUserDetails(' . $user->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                        <i class="ri-eye-line" style="font-size: 24px;"></i>
                                    </a>

                                    <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $user->id . ')" class="link-danger text-decoration-none" title="Delete">
                                        <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['name', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.users.client.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified client user details.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'name'         => $user->first_name . ' ' . $user->last_name,
                'email'        => $user->email,
                'phone_number' => $user->phone_number,
                'role'         => $user->role,
                'status'       => $user->status,
                'avatar'       => $user->avatar ? asset($user->avatar) : asset('backend/images/default_images/user_1.jpg'),
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Toggle the status of the specified client users.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(Request $request, int $id): JsonResponse {
        try {
            $user   = User::findOrFail($id);
            $status = $request->input('status');

            if ($status === 'active' || $status === 'inactive') {
                $user->status = $status;
                $user->save();

                // Queue the status update email
                Mail::to($user->email)->queue(new StatusUpdateMail($user));

                // Send the status update email directly
                // Mail::to($user->email)->send(new StatusUpdateMail($user));

                return response()->json([
                    'success' => true,
                    'message' => 'Status Updated Successfully',
                    'data'    => $user,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid status value.',
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified client users from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            // Delete related bookings and reviews
            $user->bookings()->delete();
            $user->reviews()->delete();
            $user->reports()->delete();
            $user->orders()->delete();
            $user->payments()->delete();

            // Delete the user
            $user->forceDelete();

            DB::commit();

            return response()->json([
                't-success' => true,
                'message'   => 'User and related information deleted successfully.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                't-success' => false,
                'message'   => 'An error occurred. Please try again.',
            ]);
        }
    }
}
