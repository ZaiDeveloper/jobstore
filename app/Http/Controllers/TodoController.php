<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = session('todos', []);
        $todos = array_reverse($todos);
        return view('todo.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $todos = session('todos', []);
        $todos[] = [
            'id' => uniqid(),
            'task' => $request->task,
            'created_at' => now()->toDateTimeString(),
        ];

        session(['todos' => $todos]);

        $todos = array_reverse($todos);
        return response()->json([
            'status' => true,
            'message' => 'Task added successfully.',
            'html' => view('todo.partials._list', compact('todos'))->render(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $todos = session('todos', []);
        foreach ($todos as &$todo) {
            if ($todo['id'] === $id) {
                $todo['task'] = $request->task;
                break;
            }
        }

        session(['todos' => $todos]);
        $todos = array_reverse($todos);
        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully.',
            'html' => view('todo.partials._list', compact('todos'))->render(),
        ]);
    }

    public function destroy($id)
    {
        $todos = session('todos', []);
        $todos = array_filter($todos, fn($t) => $t['id'] !== $id);
        session(['todos' => array_values($todos)]);

        $todos = array_reverse($todos);
        return response()->json([
            'status' => true,
            'message' => 'Task deleted.',
            'html' => view('todo.partials._list', compact('todos'))->render(),
        ]);
    }
}
