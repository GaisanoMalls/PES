<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationPoint extends Model
{
    use HasFactory;

    protected $table = 'evaluation_points';

    protected $fillable = [
        'evaluation_id',
        'evaluator_id',
        'employee_id',
        'evaluation_template_id',
        'part_id',
        'factor_id',
        'rating_scale_id',
        'factor_rating_scale_id',
        'points',
        'note',
    ];

    // Define any relationships here, for example:
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class, 'evaluator_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function evaluationTemplate()
    {
        return $this->belongsTo(EvaluationTemplate::class, 'evaluation_template_id');
    }
}
