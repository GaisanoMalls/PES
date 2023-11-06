<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $table = 'parts';

    protected $fillable = [
        'evaluation_template_id',
        'name',
        'criteria_allocation'
    ];

    // Define any relationships here, for example:
    public function evaluationTemplate()
    {
        return $this->belongsTo(EvaluationTemplate::class, 'evaluation_template_id');
    }
}
