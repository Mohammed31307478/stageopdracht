<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteTodolistRequest;
use App\Models\Todolist;
use App\Http\Requests\StoreTodolistRequest;
use App\Http\Requests\UpdateTodolistRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Auth;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome')->with(['todolists' => Todolist::all()->where('user_id', '=', Auth::id())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTodolistRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodolistRequest $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'image' => 'required',
                'informatie' => 'required'
            ]);

        $todolist = new Todolist();
        $todolist->name = $request->name;
        $path = $request->file('image')->store('public/uploads');
        $todolist->image = str_replace('public/', 'storage/', $path);
        $todolist->informatie = $request->informatie;
        $todolist->user_id = Auth::user()->id;
        $todolist->saveOrFail();
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todolist $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todo)
    {
        return view('update')->with(['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Todolist $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todo)
    {
        return view('update')->with(['todo' => $todo]);

//        $todolist = Todolist::find($request->id);
//        $todolist->name = $request->name;
//        $todolist->image = $request->image;
//        $todolist->informatie = $request->informatie;
//        $todolist->saveOrFail();
//        return view('welcome');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTodolistRequest $request
     * @param \App\Models\Todolist $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodolistRequest $request)
    {
        $todo = Todolist::find($request->id);

        if (!$todo) return back();

        if (isset($request->voltooid_update)) {
            $todo->voltooid = $request->voltooid == 'on';
            $todo->saveOrFail();
        } else {
            $todo->name = $request->name;
            if(isset($request->image)){
                $path = $request->file('image')->store('public/uploads');
                $todo->image = str_replace('public/', 'storage/', $path);
            }
            $todo->informatie = $request->informatie;
            $todo->saveOrFail();
        }
        return redirect('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\DeleteTodolistRequest $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteTodolistRequest $request)
    {
        Todolist::destroy($request->id);
        return redirect('/todo');
    }
}
