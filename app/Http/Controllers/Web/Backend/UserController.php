<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Mail\StatusUpdateMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    /**
     * Display the list of all users.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = User::where('role', 'beauty_expert')->latest()->get();
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
                            </div>';
                })
                ->rawColumns(['name', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.users.index');
    }

    /**
     * Display the specified user details.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $user = User::findOrFail($id);
        return response()->json([
            'name'   => $user->first_name . ' ' . $user->last_name,
            'email'  => $user->email,
            'role'   => $user->role,
            'status' => $user->status,
        ]);
    }

    /**
     * Toggle the status of the specified users.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(Request $request, int $id): JsonResponse {
        $user   = User::findOrFail($id);
        $status = $request->input('status');

        if ($status === 'active' || $status === 'inactive') {
            $user->status = $status;
            $user->save();

            // Queue the status update email
            Mail::to($user->email)->queue(new StatusUpdateMail($user));

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
    }
}
