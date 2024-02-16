<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;

    protected $table = 'days';
    protected $primaryKey='id';
    protected $fillable = [
        'name',
        'color',
        'day',
        'month',
        'year',
        'recurrent'
    ];
}
