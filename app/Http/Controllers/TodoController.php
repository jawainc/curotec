<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodoController extends Controller
{
    public function index() {
        return inertia("Todo/Index", [
            "todos" => Todo::all()
        ]);
    }

    public  function store(Request $request) {

        $todo = new Todo();

        $todo->name = $request->name;
        $todo->done = $request->done;

        $todo->save();

        return Redirect::route("todos.index");
    }

    public  function create() {

    }

    public  function destroy(Todo $todo) {
        $todo->delete();
        return Redirect::route("todos.index");
    }

    public function toggle($id) {

        $todo = Todo::find($id);
        $todo->done = !$todo->done;
        $todo->save();

        return Redirect::route("todos.index");
    }

}
