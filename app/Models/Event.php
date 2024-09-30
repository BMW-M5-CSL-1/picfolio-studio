<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doc_no',
        'type',
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'required_photographers',
        'arieal_view',
        'status',
        'user_id',
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventPhotographers()
    {
        return $this->hasMany(EventPhotographer::class);
    }
}
