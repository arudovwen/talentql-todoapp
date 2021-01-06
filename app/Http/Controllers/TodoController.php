<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all todos
        return Todo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create a new todo
        return Todo::create([
            'title'=>$request->title,
            'status' => false
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        // Get a specific todo
        return $todo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        // Update existing todo title
        $todo->title = $request->title;
        $todo->save();
        return $todo;
    }
    public function markTodoDone(Request $request, Todo $todo)
    {
        // Mark todo as done
        $todo->status = true;
        $todo->save();
        return response()->json([
            'message'=>'Todo completed'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        // Delete a todo
     
        if (!is_null($todo)) {
            $todo->delete();
            return response()->json([
                 'message'=>'Todo deleted'
             ]);
        }
        return response()->json([
            'message'=>'Todo already deleted'
        ]);
    }

   
    public function multiTodoDestroy(Request $request)
    {
        // multiple todo deletion
      
        foreach ($request->todos as $todo) {
            $findTodo = Todo::find($todo);
            if (!is_null($findTodo)) {
                $findTodo->delete();
            }
        }
      
         
        return response()->json([
             'message'=>'Todos deleted'
         ]);
    }
}
