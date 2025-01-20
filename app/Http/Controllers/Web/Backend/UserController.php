<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
                ->rawColumns(['name', 'status'])
                ->make();
        }
        return view('backend.layouts.users.index');
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
