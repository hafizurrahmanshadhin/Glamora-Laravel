<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterSubscriptionController extends Controller {
    /**
     * Store a newly created newsletter subscription.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:newsletter_subscriptions,email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            NewsletterSubscription::create([
                'email' => $request->input('email'),
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Subscription successful.',
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
