<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationApprovers extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'approver_id',
        'employee_id',
        'department_configuration_id',
        'approver_level'
    ]; // Add other fillable fields as needed
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }
}
