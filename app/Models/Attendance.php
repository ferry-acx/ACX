<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Attendance extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'id',
        'user_id',
        'username',
        'time_in',
        'attendance_date',
        'task',
        'project',
        'location',
        'supervisor_ass',
        'total_time'


    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
