<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserConversationController extends Controller {
    /**
     * Display a listing of the testimonials.
     *
     * @param Request $request
     * @return JsonResponse|View
     * @throws Exception
     */
    public function index(Request $request): JsonResponse | View {
        try {
            if ($request->ajax()) {
                $data = User::where('role', 'beauty_expert')
                    ->select('id', 'first_name', 'last_name', 'email')
                    ->orderBy('first_name')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->first_name . ' ' . $data->last_name;
                    })
                    ->addColumn('action', function ($data) {
                        return '
                            <div class="d-flex justify-content-center hstack gap-3 fs-base">
                              <a href="javascript:void(0);" class="link-primary text-decoration-none"
                                 title="View"
                                 onclick="viewConversations(' . $data->id . ')">
                                <i class="ri-eye-line" style="font-size: 24px;"></i>
                              </a>
                            </div>
                        ';
                    })
                    ->rawColumns(['name', 'action'])
                    ->make();
            }
            return view('backend.layouts.user-conversation.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the conversation page for a specific expert.
     *
     * @param User $expert
     * @return JsonResponse|View
     */
    public function partners(User $expert): JsonResponse {
        try {
            $partnerIds = Message::where(function ($q) use ($expert) {
                $q->where('sender_id', $expert->id)
                    ->orWhere('receiver_id', $expert->id);
            })
                ->selectRaw(
                    "CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END as partner_id",
                    [$expert->id]
                )
                ->groupBy('partner_id')
                ->pluck('partner_id');

            $partners = User::whereIn('id', $partnerIds)
                ->select('id', 'first_name', 'last_name', 'email')
                ->get();

            return response()->json($partners);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get messages between the expert and a specific partner.
     *
     * @param User $expert
     * @param User $partner
     * @return JsonResponse
     */
    public function messages(User $expert, User $partner): JsonResponse {
        try {
            $msgs = Message::where(function ($q) use ($expert, $partner) {
                $q->where('sender_id', $expert->id)
                    ->where('receiver_id', $partner->id);
            })
                ->orWhere(function ($q) use ($expert, $partner) {
                    $q->where('sender_id', $partner->id)
                        ->where('receiver_id', $expert->id);
                })
                ->with('sender:id,first_name,last_name', 'receiver:id,first_name,last_name')
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json($msgs);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
