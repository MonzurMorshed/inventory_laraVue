<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $tabls = 'logs';
    public $fillable = [
        'itemCode','type','increase','decrease','itemId'
    ];
    public $timestamp = false;
}
