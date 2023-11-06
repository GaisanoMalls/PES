<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';

    protected $fillable = [
        'approver_id',
        'evaluator_id',
        'employee_id',
        'evaluation_template_id',
        'recommendation_note',
        'ratees_comment',
        'status',
        'created_at',
        'updated_at',
    ];


    public function approver()
    {
        return $this->belongsTo(Approver::class, 'approver_id', 'id');
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

    public function evaluationPoints()
    {
        return $this->hasMany(EvaluationPoint::class, 'evaluation_id', 'id');
    }
}
