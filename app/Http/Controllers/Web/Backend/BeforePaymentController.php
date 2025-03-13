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
            $data = BookingCancellationBeforeAppointment::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($report) {
                    return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                <a href="javascript:void(0);" onclick="showReportDetails(' . $report->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewReportModal">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('backend.layouts.booking-cancellation.before-payment.index');
    }
}
