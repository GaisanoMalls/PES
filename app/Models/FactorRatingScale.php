<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorRatingScale extends Model
{
    use HasFactory;
    protected $table = 'factor_rating_scales';

    protected $fillable = [
        'evaluation_template_id',
        'part_id',
        'factor_id',
        'rating_scale_id',
        'equivalent_points',
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return RatingScale::find($this->rating_scale_id)->name;
    }

    // Define any relationships here, for example:
    public function evaluationTemplate()
    {
        return $this->belongsTo(EvaluationTemplate::class, 'evaluation_template_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    public function factor()
    {
        return $this->belongsTo(Factor::class, 'factor_id');
    }

    public function ratingScale()
    {
        return $this->belongsTo(RatingScale::class, 'rating_scale_id');
    }
}
