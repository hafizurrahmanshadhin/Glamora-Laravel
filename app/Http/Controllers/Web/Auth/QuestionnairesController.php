<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\RegisterQuestionSurvey;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class QuestionnairesController extends Controller {
    /**
     * Display the questionnaires view.
     */
    public function index(): View | JsonResponse {
        try {
            $questionnaires  = CMS::where('section', 'questionnaires')->first();
            $surveyQuestions = RegisterQuestionSurvey::where('status', 'active')->get();

            return view('auth.layouts.questionnaires', compact('questionnaires', 'surveyQuestions'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
