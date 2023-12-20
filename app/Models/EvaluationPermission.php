<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationPermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'evaluator_id',
        'employee_id',
        'department_id',
        'branch_id'
    ]; // Add other fillable fields as needed
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
