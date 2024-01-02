<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'employee_id',
        'person_id',
        'role_id',
        'email',
        'password',
        'is_active',
        'remember_token'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // User model
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    // Define the relationship with the Approver model
    public function approver()
    {
        return $this->belongsTo(Approver::class, 'person_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class, 'person_id');
    }
    public function human_resource()
    {
        return $this->belongsTo(HumanResource::class, 'person_id');
    }
}
