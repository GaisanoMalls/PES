<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'branch_id',
        'employee_id',
        'first_name',
        'last_name',
        'contact_no',
        'date_hired',
        'position',
        'employment_status',
        'level',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'integer',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'person_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    // Define the inverse relationship with the Recommendation model
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'employee_id', 'employee_id');
    }
    // Employee model
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'employee_id', 'employee_id');
    }

    public function evaluation_permissions()
    {
        return $this->hasMany(EvaluationPermission::class, 'employee_id', 'employee_id');
    }
}
