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

    public function edit($templateId)
    {
        return view('templates.edit', ['templateId' => $templateId]);
    }
    public function destroy(EvaluationTemplate $template)
    {
        // Delete associated records (parts, factors, and factorRatingScales)
        $template->parts()->delete();
        $template->factors()->delete();
        $template->factorRatingScales()->delete();

        // Delete the template itself
        $template->delete();

        // Optionally, you can redirect or return a response here
        return redirect()->route('templates.index')->with('message', 'Template and associated records deleted successfully');
    }
}
