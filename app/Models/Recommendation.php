<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $table = 'recommendations';
    protected $fillable = [
        'evaluation_id',
        'employee_id',
        'current_salary',
        'recommended_position',
        'level',
        'employment_status',
        'recommended_salary',
        'percentage_increase',
        'remarks',
        'effectivity',
    ];

    // Define the relationship with the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    // Define the relationship with the Evaluation model
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id', 'id');
    }
}
