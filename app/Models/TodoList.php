<?php

namespace App\Models;

use App\Models\Traits\FilterAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory, FilterAble;
    protected $table = 'todo_lists';
    protected $guarded = false;

    public function tags(){
        return $this->belongsToMany(Tags::class, 'list_tags', 'list_id', 'tag_id');
    }
}
