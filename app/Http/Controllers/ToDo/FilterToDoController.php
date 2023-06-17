<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Http\Filters\ListFilter;
use App\Models\Tags;
use App\Models\TodoList;
use Illuminate\Http\Request;

class FilterToDoController extends Controller
{
    public function search(Request $request){
        $data = $request->validate(['search' => 'nullable']);
        if (empty($data)) return TodoList::all();

        $search = TodoList::query()->where('title', 'LIKE', "%".$data['search']."%")->get();
        $tags = Tags::all();

        return view('welcome', compact('search', 'tags'));
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function filter(Request $request){
//        $data = $request->validate(['tag_id' => 'nullable|array']);
        $list = TodoList::query();
        if ($request->has('tag_id')){
            $list->whereHas('tags', function ($query) use ($request){
                $query->whereIn('tag_id', $request->tag_id);
            });
        }
        $lists = $list->get();
        $tags = Tags::distinct()->get();
        return view('welcome', compact('lists', 'tags'));
//        $filter = app()->make(ListFilter::class, ['queryParams' => array_filter($data)]);
//        $lists = TodoList::filter($filter)->get();
        // я не смог через трейты и интерфейсы сделать я забыл как :(
    }
}
