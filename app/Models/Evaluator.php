<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    use HasFactory;
    protected $fillable = [
        'bu_id',
        'department_id',
        'first_name',
        'last_name',
        'contact_no',
        'position',
        'is_active',
    ];

    public function businessUnit()
    {
        return $this->belongsTo(BusinessUnit::class, 'bu_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class, 'person_id');
    }
}
