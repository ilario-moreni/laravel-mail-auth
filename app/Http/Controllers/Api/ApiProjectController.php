<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;

class ApiProjectController extends Controller
{
    public function index(){

        $projects = Project::all();

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}