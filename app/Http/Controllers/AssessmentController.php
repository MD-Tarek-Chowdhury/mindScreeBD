<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentRequest;
use App\Models\Assessment;
use App\Services\AssessmentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssessmentController extends Controller
{
    protected $assessmentService;

    public function __construct(AssessmentService $service)
    {
        $this->assessmentService = $service;
    }
    public function create()
    {
        return Inertia::render('Assessment/Form');
    }

    public function store(StoreAssessmentRequest $request)
    {
        // 1. Validation -> Ensure all 21 questions are present
        $validated = $request->validated();

        // 2. Process logic via Service
        $results = $this->assessmentService->calculateResults($validated['answers']);
        Assessment::create([
            'user_id' => auth()->id(),
            'depression_score' => $results['depression']['score'],
            'anxiety_score' => $results['anxiety']['score'],
            'stress_score' => $results['stress']['score'],
        ]);

        // 3. Return to Inertia with the results
        return Inertia::render('Assessment/Results', [
            'results' => $results
        ]);
    }
}
