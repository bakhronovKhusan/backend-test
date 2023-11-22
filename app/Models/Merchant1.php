<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant1 extends Model
{
    use HasFactory;
    const limit = 10000;
    protected $table = 'paymway1_merchant';
}
