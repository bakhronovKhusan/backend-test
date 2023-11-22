<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant2 extends Model
{
    use HasFactory;
    const limit = 20000;
    protected $table = 'paymway2_merchant';
}
