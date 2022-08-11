<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class envoice extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "envoice";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer',
        'amount',
        'bollo',
        'cassa',
        'pay',
        'team',
        'note',
        'envoice_created_at',
        'envoice_pay',
    ];
}
