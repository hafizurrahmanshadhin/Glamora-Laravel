<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ReportController extends Controller {
    /**
     * Display the list of all reports.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            // $data = Report::with('user')->latest()->get();
            $data = Report::with(['user', 'booking.userService.user'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('report_from', function ($data) {
                    return $data->user->first_name . ' ' . $data->user->last_name;
                })
                ->addColumn('report_to', function ($data) {
                    // The user who got reported
                    // Step 1: Check if there is a booking
                    // Step 2: booking has a userService
                    // Step 3: The userService has a user
                    if (
                        $data->booking &&
                        $data->booking->userService &&
                        $data->booking->userService->user
                    ) {
                        $reportedUser = $data->booking->userService->user;
                        return $reportedUser->first_name . ' ' . $reportedUser->last_name;
                    }
                    return 'N/A';
                })
                ->addColumn('message', function ($data) {
                    $message       = $data->message;
                    $short_message = strlen($message) > 100 ? substr($message, 0, 100) . '...' : $message;
                    return '<p>' . $short_message . '</p>';
                })
                ->addColumn('action', function ($report) {
                    return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                <a href="javascript:void(0);" onclick="showReportDetails(' . $report->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewReportModal">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['report_from', 'report_to', 'message', 'action'])
                ->make();
        }
        return view('backend.layouts.reports.index');
    }

    /**
     * Display the specified report details.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $report = Report::with(['user', 'booking.userService.user'])->findOrFail($id);

        // Report from
        $reportFrom = $report->user
        ? $report->user->first_name . ' ' . $report->user->last_name
        : 'N/A';

        // Report to
        $reportTo = 'N/A';
        if ($report->booking && $report->booking->userService && $report->booking->userService->user) {
            $reportTo = $report->booking->userService->user->first_name
            . ' '
            . $report->booking->userService->user->last_name;
        }

        return response()->json([
            'id'          => $report->id,
            'report_from' => $reportFrom,
            'report_to'   => $reportTo,
            'message'     => $report->message,
        ]);
    }
}
