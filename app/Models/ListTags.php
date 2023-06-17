<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTags extends Model
{
    use HasFactory;
    protected $table = 'list_tags';
    protected $guarded = false;
}
