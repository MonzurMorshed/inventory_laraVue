<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemCode','itemName','brand','production',
        'packedQuantity','bulkQuantity','material1Quantity',
        'material2Quantity','material3Quantity'
    ];
}
