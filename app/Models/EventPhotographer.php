<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPhotographer extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'photographer_id',
        'offer',
        'status',
    ];

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
