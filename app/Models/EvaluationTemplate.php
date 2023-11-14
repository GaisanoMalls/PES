<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationTemplate extends Model
{
    use HasFactory;
    protected $table = 'evaluation_templates';

    protected $fillable = ['name'];

    // Define any relationships here, for example:
    public function parts()
    {
        return $this->hasMany(Part::class, 'evaluation_template_id');
    }
    public function factors()
    {
        return $this->hasMany(Factor::class);
    }

    public function factorRatingScales()
    {
        return $this->hasMany(FactorRatingScale::class);
    }
}
