<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lists = TodoList::query()->where('user_id', auth()->user()->id)->get();
        $tags = DB::table('tags')->distinct()->get();

        return view('welcome', compact('lists', 'tags'));
    }
}
