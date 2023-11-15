<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisapprovalReason extends Model
{
    use HasFactory;
    protected $table = 'disapproval_reasons';

    protected $fillable = [
        'evaluation_id',
        'approver_id',
        'evaluator_id',
        'description',
        'status',
    ];

    // Define relationships
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
