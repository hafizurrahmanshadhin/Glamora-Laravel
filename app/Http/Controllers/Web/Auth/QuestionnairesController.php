<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class QuestionnairesController extends Controller {
    /**
     * Display the questionnaires view.
     */
    public function index(): View {
        return view('auth.layouts.questionnaires');
    }
}
