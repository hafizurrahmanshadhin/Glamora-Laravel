<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller {
    /**
     * Display the contact page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $systemSettings = SystemSetting::first();

            return view('frontend.layouts.contact.index', compact('systemSettings'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        try {
            $validatedData = $request->validate([
                'name'         => 'required|string|max:255',
                'email'        => 'required|string|email|max:255',
                'phone_number' => 'required|string|max:25|regex:/^([0-9\s\-\+\(\)]*)$/',
                'message'      => 'required|string',
            ]);

            Contact::create($validatedData);

            return response()->json(['success' => 'Your message has been sent successfully!']);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
