<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "customer";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'denominazione',
        'var',
        'fiscal_code',
        'paese',
        'cap',
        'province',
        'comune',
        'address',
        'email',
        'pec',
        'cell',
        'cod_sdi',
    ];
}
