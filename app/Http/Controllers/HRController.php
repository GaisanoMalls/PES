<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationPoint;
use App\Models\EvaluationTemplate;
use App\Models\Factor;
use App\Models\FactorRatingScale;
use App\Models\Part;
use App\Models\RatingScale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

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

    public function generatePDFTemplate($templateId)
    {
        // Load the template data using the method
        $templateData = $this->loadTemplateData($templateId);
        $template = EvaluationTemplate::find($templateId);
        $templateName = $template->name;
        // Check if the template data is not found
        if (!$templateData) {
            // Handle the case where the template does not exist
            // You can redirect or show an error message
        }

        // Load the template data into the PDF view
        $pdf = PDF::loadView('templates.template-pdf', $templateData);

        return $pdf->download($templateName . '_PES.pdf');
    }

    private function loadTemplateData($templateId)
    {
        // // Fetch the evaluation by ID
        // $evaluation = Evaluation::find($evaluationId);

        // // Check if the evaluation is not found
        // if (!$evaluation) {
        //     return null;
        // }

        // // Load additional data as needed (similar to the Livewire mount method)
        // $employee = $evaluation->employee;
        // $departmentName = $employee->department->name;
        // $employeeIdCompany = $employee->employee_id;
        // $name = $employee->first_name . ' ' . $employee->last_name;
        // $position = $employee->position;
        // $dateHired = $employee->date_hired;
        // $createdAt = Carbon::parse($evaluation->created_at)->toDateTimeString();

        $ratingScales = RatingScale::all();

        // Load other data as needed...

        $template = EvaluationTemplate::find($templateId);

        $parts = Part::where('evaluation_template_id', $templateId)->get();
        $partsWithFactors = [];

        foreach ($parts as $part) {
            $factors = Factor::where('part_id', $part->id)->get();
            $factorsData = [];

            foreach ($factors as $factor) {
                // Load factor data as needed...
                $factorData = [
                    'factor' => $factor,
                    'rating_scales' => FactorRatingScale::where([
                        'evaluation_template_id' => $templateId,
                        'part_id' => $part->id,
                        'factor_id' => $factor->id,
                    ])->get()->map(function ($scale) {
                        $ratingScale = RatingScale::find($scale->rating_scale_id);
                        $scale->acronym = $ratingScale->acronym;
                        $scale->name = $ratingScale->name; // Include the rating scale name
                        return $scale;
                    })
                ];

                // Add other factor data as needed...

                $factorsData[] = $factorData;
            }

            $partsWithFactors[] = [
                'part' => $part,
                'factors' => $factorsData,
                // Add other part data as needed...
            ];
        }

        // Return an associative array with the loaded template data
        return [

            'ratingScales' => $ratingScales,
            'template' => $template, // Include the template data
            'partsWithFactors' => $partsWithFactors,
            // Add other data as needed...
        ];
    }
    public function updateStatus($id)
    {
        $template = EvaluationTemplate::findOrFail($id);

        // Validate and update the status
        request()->validate([
            'status' => 'required|in:1,2',
        ]);

        $template->status = request('status');
        $template->save();

        return redirect()->back(); // Redirect back to the previous page or wherever you prefer
    }
}
