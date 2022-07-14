<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usersteps extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'steps', 'user_id', 'start_date', 'end_date'
    ];
    // protected $connection = 'mongodb';
    // protected $collection = 'cars';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
