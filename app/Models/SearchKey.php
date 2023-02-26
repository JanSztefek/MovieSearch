<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchKey extends Model
{
    use HasFactory;

    protected $table = 'search_keys';

    protected $fillable = [
        'count',
        'key',
    ];

}
