<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AdminComment;
use App\Models\BookingCancellationAfterAppointment;
use App\Models\BusinessInformation;
use App\Models\TravelRadius;
use App\Models\User;
use App\Models\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AfterPaymentController extends Controller {
    /**
     * Display the list of all booking cancellation after payment.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $grouped = BookingCancellationAfterAppointment::with(['canceledBy', 'requestedBy'])
                    ->latest()
                    ->get()
                    ->groupBy('canceled_by');

                $data    = [];
                $counter = 1;
                foreach ($grouped as $canceledById => $items) {
                    if (!$items->first() || !$items->first()->canceledBy) {
                        continue;
                    }

                    $canceledUser = $items->first()->canceledBy;
                    $canceledName = $canceledUser->first_name . ' ' . $canceledUser->last_name;
                    $email        = $canceledUser->email ?? 'N/A';
                    $phoneNumber  = $canceledUser->phone_number ?? 'N/A';

                    $requestedNames = [];
                    foreach ($items as $item) {
                        if ($item->requestedBy) {
                            $requestedNames[] = $item->requestedBy->first_name . ' ' . $item->requestedBy->last_name;
                        }
                    }
                    $requestedByAll = !empty($requestedNames)
                    ? implode(', ', array_unique($requestedNames))
                    : 'N/A';

                    // Show ban status
                    $banStatus = '<span class="badge bg-success">Not Banned</span>';
                    if ($canceledUser->banned_until && now()->lt($canceledUser->banned_until)) {
                        $banStatus = '<span class="badge bg-danger">Banned until '
                        . $canceledUser->banned_until->format('Y-m-d H:i') . '</span>';
                    }

                    $comment = AdminComment::where('user_id', $canceledUser->id)
                        ->latest()
                        ->value('comment');

                    $fullComment = $comment ?? 'N/A';
                    $truncated   = $comment && strlen($comment) > 25 ? substr($comment, 0, 25) . '...' : ($comment ?: 'N/A');

                    $action = '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                <a href="javascript:void(0);" onclick="showBanModal(' . $canceledById . ')"
                                   class="link-danger text-decoration-none" title="Ban User">
                                    <i class="ri-forbid-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showCommentModal(' . $canceledById . ')" class="link-primary text-decoration-none" title="Comment">
                                    <i class="ri-chat-3-line" style="font-size: 24px;"></i>
                                </a>
                               </div>';

                    $data[] = [
                        'DT_RowIndex'       => $counter++,
                        'id'                => $canceledById,
                        'canceled_by_name'  => $canceledName,
                        'email'             => $email,
                        'phone_number'      => $phoneNumber,
                        'requested_by_name' => $requestedByAll,
                        'ban_status'        => $banStatus,
                        'admin_comment'     => $truncated,
                        'full_comment'      => $fullComment,
                        'action'            => $action,
                    ];
                }

                return DataTables::of(collect($data))
                    ->rawColumns(['canceled_by_name', 'requested_by_name', 'ban_status', 'action'])
                    ->make(true);
            }

            return view('backend.layouts.booking-cancellation.after-payment.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Ban a user for a specific duration.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function banUser(Request $request) {
        $request->validate([
            'user_id'  => 'required|exists:users,id',
            'duration' => 'required|in:1,3,5,7,10,15,30',
        ]);

        DB::beginTransaction();
        try {
            $user     = User::findOrFail($request->user_id);
            $duration = (int) $request->duration;

            // Calculate banned_until (current time + duration days)
            $banDuration = now()->addDays($duration);

            // Update user ban status
            $user->banned_until = $banDuration;
            $user->save();

            // Determine new status
            $status = $request->input('status') === 'available' ? 'active' : 'inactive';

            // Update related tables
            BusinessInformation::where('user_id', $user->id)->update(['status' => $status]);
            TravelRadius::where('user_id', $user->id)->update(['status' => $status]);
            UserService::where('user_id', $user->id)->update(['status' => $status]);

            DB::commit();
            return Helper::jsonResponse(true, "User has been banned successfully for {$request->duration} day(s).", 200);
        } catch (Exception $e) {
            DB::rollBack();

            return Helper::jsonResponse(false, 'An error occurred while banning the user.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a comment for a user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeComment(Request $request): JsonResponse {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'comment' => 'required|string',
            ]);

            AdminComment::updateOrCreate(
                ['user_id' => $request->user_id],
                ['comment' => $request->comment]
            );

            return Helper::jsonResponse(true, 'Comment saved successfully!', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
