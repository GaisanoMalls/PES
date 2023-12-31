<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    // Define relationships if any
    public function departmentConfigurations()
    {
        return $this->hasMany(DepartmentConfiguration::class);
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
}
