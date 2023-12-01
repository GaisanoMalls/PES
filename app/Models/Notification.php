<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'evaluation_id',
        'notif_title',
        'notif_desc',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
}
