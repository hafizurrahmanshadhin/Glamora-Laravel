<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ReportsView;
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
        try {
            if ($request->ajax()) {
                $data = ReportsView::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('message', function ($data) {
                        $message       = $data->message;
                        $short_message = strlen($message) > 100 ? substr($message, 0, 100) . '...' : $message;
                        return '<p>' . $short_message . '</p>';
                    })
                    ->addColumn('action', function ($report) {
                        return '<div class="d-flex justify-content-center hstack gap-3 fs-base">
                                    <a href="javascript:void(0);" onclick="showReportDetails(' . $report->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewReportModal">
                                        <i class="ri-eye-line" style="font-size: 24px;"></i>
                                    </a>
                                </div>';
                    })
                    ->rawColumns(['message', 'action'])
                    ->make();
            }
            return view('backend.layouts.reports.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified report details.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $data = ReportsView::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetch successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
