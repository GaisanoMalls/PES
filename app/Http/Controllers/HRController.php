<?php

namespace App\Http\Controllers;

use App\Models\EvaluationTemplate;
use Illuminate\Http\Request;

class HRController extends Controller
{
    public function index()
    {
        $evaluationTemplates = EvaluationTemplate::all(); // Fetch all records from the EvaluationTemplate model
        return view('templates.index', ['evaluationTemplates' => $evaluationTemplates]);
    }
    public function create()
    {
        return view('templates.create');
    }
}
