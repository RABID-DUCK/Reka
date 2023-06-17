<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListAccess extends Model
{
    use HasFactory;
    protected $table = 'list_access';
    protected $guarded = false;
}
