<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'inventory_id',
        'quantity'
    ];
}
