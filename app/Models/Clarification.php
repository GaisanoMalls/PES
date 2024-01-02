<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clarification extends Model
{
    use HasFactory;
    protected $table = 'clarifications';

    protected $fillable = [
        'evaluation_id',
        'evaluator_id',
        'commentor_id',
        'description',
        'status',
    ];

    // Define the relationship with the Evaluation model
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
    public function commentorName()
    {
        return $this->belongsTo(Employee::class, 'commentor_id', 'employee_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    // Define the relationship with the Employee model (assuming it's the User model)
    public function commentor()
    {
        return $this->belongsTo(User::class, 'commentor_id', 'employee_id');
    }
}
