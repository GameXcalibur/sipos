<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'TestHistory';

    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'dateString' => 'datetime:Y-m-d',
    ];
}
