<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookingCancellationBeforeAppointment;
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

                ->addColumn('action', function ($report) {
                    return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                <a href="javascript:void(0);" onclick="showReportDetails(' . $report->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewReportModal">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['canceled_by_name', 'requested_by_name', 'action'])
                ->make();
        }
        return view('backend.layouts.booking-cancellation.before-payment.index');
    }
}
