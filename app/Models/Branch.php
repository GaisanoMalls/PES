<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
}
