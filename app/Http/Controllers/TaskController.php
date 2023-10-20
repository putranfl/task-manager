<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   public function index(Request $request)
{
    $userId = Auth::user()->id;

    $query = Task::where('user_id', $userId);

    // Search by name
    $search = $request->input('search');
    if (!empty($search)) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    $tasks = $query->paginate(10); // 10 tasks per page

    return view('task.index', compact('tasks', 'search'));
}


    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diinput
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Simpan data tugas ke database
        $task = new Task;
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->status = 'pending';
        $task->user_id = auth()->user()->id;
    
        // Handle pengunggahan gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $task->image = $imageName;
        }
    
        $task->save();
    
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }
    
    public function markComplete(Request $request, $id) {
        $task = Task::find($id);
    
        if ($task) {
            $task->status = 'completed';
            $task->save();
            return redirect()->back()->with('status', 'success');
        }
    
        return redirect()->back()->with('status', 'error');
    }    
         
}
