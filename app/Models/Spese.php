<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Spese extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "spese";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'account',
        'amount',
        'pay',
        'note',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
