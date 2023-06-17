<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToDoRequest;
use App\Http\Requests\ToDoUpdateRequest;
use App\Models\ListTags;
use App\Models\Tags;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ToDoController extends Controller
{
    public function store(ToDoRequest $request){
        $data = $request->validated();
        $data['image'] = Storage::disk('local')->put('/images', $data['image']);

        $tags = explode(',', $data['tags']);

        $list = TodoList::create([
            'title' => $data['title'],
            'image' => $data['image'],
            'user_id' => $data['user_id']
        ]);
        foreach ($tags as $tag){
            if (!Tags::query()->where('name', $tag)->exists()){
                $newTag = Tags::create([
                    'name' => $tag
                ]);
                ListTags::create([
                    'list_id' => $list->id,
                    'tag_id' => $newTag->id
                ]);
            }
        }

        $lists = TodoList::query()->where('user_id', $data['user_id'])->get();

        return response()->json($lists);
    }

    public function show($id){
        $list = TodoList::query()->where('id', $id)->first();

        return view('list', compact('list'));
    }

    public function deleteImage($id){
        $list = TodoList::query()->where('id', $id)->first();
        $list->image = "";
        $list->save();
        return view('list', compact('list'));
    }

    public function update(ToDoUpdateRequest $request, $id){
        $list = TodoList::query()->where('id', $id)->first();
        if ($request->title !== $list->title){
            $list->title = $request->title;
            $list->save();
        }
        if (isset($request->image)){
            $request->image = Storage::disk('local')->put('/images', $request->image);
            $list->image = $request->image;
            $list->save();
        }
        if (isset($request->tags)) {
            $tags = $list->tags->pluck('name')->toArray();
            $tagNames = explode(',', $request->tags);
            $newTags = [];

            foreach ($tagNames as $tagName) {
                $tag = Tags::where('name', $tagName)->first();
                if (!$tag) {
                    $tag = Tags::create(['name' => $tagName]);
                }
                $newTags[] = $tag->id;

            }
            $oldTags = array_diff($tags, $newTags);
            ListTags::whereIn('tag_id', $oldTags)->where('list_id', $list->id)->delete();
            $newTags = array_diff($newTags, $tags);
            foreach ($newTags as $tagId) {
                ListTags::updateOrCreate([
                    'list_id' => $list->id,
                    'tag_id' => $tagId
                ]);
            }
        }else {
            ListTags::where('list_id', $list->id)->delete();
        }

        $list = TodoList::query()->where('id', $id)->first();

        return view('list', compact('list'));
    }

    public function delete($id){
        $list = TodoList::query()->where('id', $id)->first();
        $list->delete();

        return redirect('/home');
    }
}
