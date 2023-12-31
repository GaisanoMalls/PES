<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact_no',
        'position',
        'is_active',
    ];


    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class, 'person_id');
    }
}
