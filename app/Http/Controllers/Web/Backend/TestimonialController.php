<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller {
    /**
     * Display the list of all testimonials.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Review::with('user')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->user->first_name . ' ' . $data->user->last_name;
                })
                ->addColumn('review', function ($data) {
                    $review       = $data->review;
                    $short_review = strlen($review) > 100 ? substr($review, 0, 100) . '...' : $review;
                    return '<p>' . $short_review . '</p>';
                })
                ->addColumn('status', function ($testimonial) {
                    $status = '<select class="form-select" onchange="changeStatus(' . $testimonial->id . ', this.value)">';
                    $status .= '<option value="active"' . ($testimonial->status == 'active' ? ' selected' : '') . '>Approved</option>';
                    $status .= '<option value="inactive"' . ($testimonial->status == 'inactive' ? ' selected' : '') . '>Hold</option>';
                    $status .= '</select>';

                    return $status;
                })
                ->addColumn('action', function ($testimonial) {
                    return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                <a href="javascript:void(0);" onclick="showTestimonialDetails(' . $testimonial->id . ')" class="link-primary text-decoration-none" title="View" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name', 'review', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.testimonials.index');
    }

    /**
     * Display the specified testimonial details.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $testimonial = Review::findOrFail($id);
        return response()->json([
            'name'   => $testimonial->user->first_name . ' ' . $testimonial->user->last_name,
            'review' => $testimonial->review,
            'rating' => $testimonial->rating,
            'status' => $testimonial->status,
        ]);
    }

    /**
     * Toggle the status of the specified testimonials.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(Request $request, int $id): JsonResponse {
        $testimonial = Review::findOrFail($id);
        $status      = $request->input('status');

        if ($status === 'active' || $status === 'inactive') {
            $testimonial->status = $status;
            $testimonial->save();

            return response()->json([
                'success' => true,
                'message' => 'Status Updated Successfully',
                'data'    => $testimonial,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid status value.',
        ]);
    }
}
