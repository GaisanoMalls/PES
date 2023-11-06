<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingScale extends Model
{
    use HasFactory;
    protected $table = 'rating_scales';

    protected $fillable = [
        'acronym',
        'name',
        'description'
    ];
}
