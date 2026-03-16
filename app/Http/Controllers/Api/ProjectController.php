<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::with(['type', 'technologies'])->get();

        return response()->json([
            'success' => true,
            'results' => $projects,
        ]);
    }

    public function show(Project $project): JsonResponse
    {
        $project->load(['type', 'technologies']);

        return response()->json([
            'success' => true,
            'result' => $project,
        ]);
    }
}
