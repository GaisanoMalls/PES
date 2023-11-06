<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;

    protected $table = 'factors';

    protected $fillable = [
        'evaluation_template_id',
        'part_id',
        'name',
        'description',
        'alloted'
    ];

    // Define any relationships here, for example:
    public function evaluationTemplate()
    {
        return $this->belongsTo(EvaluationTemplate::class, 'evaluation_template_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }
}
