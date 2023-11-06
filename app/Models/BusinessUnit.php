<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;
    protected $table = 'business_units';

    protected $fillable = [
        'name',
    ];

    public function approvers()
    {
        return $this->hasMany(Approver::class, 'bu_id');
    }
    public function evaluators()
    {
        return $this->hasMany(Evaluator::class, 'bu_id');
    }
}
