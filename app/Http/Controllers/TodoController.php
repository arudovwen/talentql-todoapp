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
        // list all todos
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // view specific todo
       
        return Todo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update existing todo title
        $findTodo = Todo::find($id);
        $findTodo->title = $request->title;
        $findTodo->save();
        return $findTodo;
    }
    public function markTodoDone(Request $request, $id)
    {
        // Mark todo done
        $findTodo = Todo::find($id);
        $findTodo->status = true;
        $findTodo->save();
        return $findTodo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete  todo
        $findTodo = Todo::find($id);
        if (!is_null($findTodo)) {
            $findTodo->delete();
            return response()->json([
                 'message'=>'Todo deleted'
             ]);
        }
        return response()->json([
            'message'=>'Todo already deleted'
        ]);
    }

   
    public function multiDestroy(Request $request)
    {
        // multiple todo deletion
      
        foreach (\json_decode($request['ids']) as $id) {
            $findTodo = Todo::find($id);
            $findTodo->delete();
        }
      
         
        return response()->json([
             'message'=>'Todos deleted'
         ]);
    }
}
