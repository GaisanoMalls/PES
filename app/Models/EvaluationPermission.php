<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationPermission extends Model
{
    public $timestamps = false;

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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }



    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
