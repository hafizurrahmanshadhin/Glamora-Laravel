<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BookingCancellationBeforeAppointment;
use App\Models\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class BeforePaymentController extends Controller {
    /**
     * Display the list of all booking cancellation before payment.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = BookingCancellationBeforeAppointment::with(['canceledBy', 'requestedBy'])->latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()

                // New column to display the user who canceled
                    ->addColumn('canceled_by_name', function ($user) {
                        if ($user->canceledBy) {
                            return $user->canceledBy->first_name . ' ' . $user->canceledBy->last_name;
                        }
                        return 'N/A';
                    })

                // New column to display the user who requested the booking
                    ->addColumn('requested_by_name', function ($user) {
                        if ($user->requestedBy) {
                            return $user->requestedBy->first_name . ' ' . $user->requestedBy->last_name;
                        }
                        return 'N/A';
                    })

                    ->addColumn('action', function ($user) {
                        return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                    <a href="javascript:void(0);" onclick="showUserDetails(' . $user->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                        <i class="ri-eye-line" style="font-size: 24px;"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['canceled_by_name', 'requested_by_name', 'action'])
                    ->make();
            }
            return view('backend.layouts.booking-cancellation.before-payment.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the booking cancellation before payment details.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $cancelInfo = BookingCancellationBeforeAppointment::with(['canceledBy', 'requestedBy', 'booking'])->findOrFail($id);

            // Gather info for canceledBy
            $canceledByName = $cancelInfo->canceledBy
            ? $cancelInfo->canceledBy->first_name . ' ' . $cancelInfo->canceledBy->last_name
            : 'N/A';

            $canceledByEmail = $cancelInfo->canceledBy
            ? $cancelInfo->canceledBy->email
            : 'N/A';

            // Gather info for requestedBy
            $requestedByName = $cancelInfo->requestedBy
            ? $cancelInfo->requestedBy->first_name . ' ' . $cancelInfo->requestedBy->last_name
            : 'N/A';

            $requestedByEmail = $cancelInfo->requestedBy
            ? $cancelInfo->requestedBy->email
            : 'N/A';

            // Extract service names from booking->service_ids (comma-separated)
            $serviceNames = [];
            if ($cancelInfo->booking && $cancelInfo->booking->service_ids) {
                $serviceIds   = explode(',', $cancelInfo->booking->service_ids);
                $serviceNames = Service::whereIn('id', $serviceIds)
                    ->pluck('services_name')
                    ->toArray();
            }
            $services = $serviceNames ? implode(', ', $serviceNames) : 'N/A';

            return Helper::jsonResponse(true, 'Booking cancellation details fetched successfully.', 200,
                [
                    'id'                 => $cancelInfo->id,
                    'canceled_by_name'   => $canceledByName,
                    'canceled_by_email'  => $canceledByEmail,
                    'requested_by_name'  => $requestedByName,
                    'requested_by_email' => $requestedByEmail,
                    'services'           => $services,
                ]
            );
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
