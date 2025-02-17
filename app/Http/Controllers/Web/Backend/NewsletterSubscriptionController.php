<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class NewsletterSubscriptionController extends Controller {
    /**
     * Display the list of all newsletter subscriptions.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = NewsletterSubscription::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($newsletterSubscription) {
                    $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                    $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $newsletterSubscription->id . '" ' . ($newsletterSubscription->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $newsletterSubscription->id . ')">';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($newsletterSubscription) {
                    return '<div class="hstack gap-3 fs-base" style="justify-content: center; align-items: center;">
                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $newsletterSubscription->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }
        return view('backend.layouts.newsletter-subscription.index');
    }

    /**
     * Toggle the status of the specified newsletter subscription.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $newsletterSubscription = NewsletterSubscription::findOrFail($id);

        if ($newsletterSubscription->status == 'active') {
            $newsletterSubscription->status = 'inactive';
            $newsletterSubscription->save();

            return response()->json([
                'success' => false,
                'message' => 'Newsletter subscription unpublished successfully.',
                'data'    => $newsletterSubscription,
            ]);
        } else {
            $newsletterSubscription->status = 'active';
            $newsletterSubscription->save();
            return response()->json([
                'success' => true,
                'message' => 'Newsletter subscription published successfully.',
                'data'    => $newsletterSubscription,
            ]);
        }
    }

    /**
     * Remove the specified newsletter subscription from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $newsletterSubscription = NewsletterSubscription::findOrFail($id);
        $newsletterSubscription->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Newsletter subscription deleted successfully.',
        ]);
    }
}
