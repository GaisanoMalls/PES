<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentConfiguration extends Model
{

    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'number_of_approvers',
        'department_id',
        'branch_id'
    ]; // Add other fillable fields as needed

    // Define relationships if any
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    public function evaluationApprovers()
    {
        return $this->hasMany(EvaluationApprovers::class);
    }
}
