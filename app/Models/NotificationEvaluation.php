<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationEvaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'notifiable_id',
        'type',
        'person_id',
        'notif_title',
        'notif_desc',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
}
