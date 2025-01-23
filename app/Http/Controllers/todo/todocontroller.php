<?php

namespace App\Http\Controllers\todo;

use App\Http\Controllers\Controller;
use App\Models\todo;
use Illuminate\Http\Request;

class todocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 2;

        if (request('search')){
            $data = todo::where('task', 'like', '%' . request('search') . '%')->paginate($max_data)->withQueryString();
        }else {
            $data = todo::orderBy('task', 'asc')->paginate($max_data);    
        }
        return view('app', compact('data'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'task' => 'required|min:3|max:25'
       ],[
            'task.required'=>'isian task wajib diisikan',
            'task.min'=>'isian task min 3 karakter',
            'task.max'=>'isian task max 25 karakter',
       ]);


       $data = [
            'task' => $request->input('task'),
       ];


       todo::create($data);
       return redirect()->route('todo')->with('success', 'berhasil simpan data');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
       ],[
            'task.required'=>'isian task wajib diisikan',
            'task.min'=>'isian task min 3 karakter',
            'task.max'=>'isian task max 25 karakter',
       ]);

       $data = [
        'task' => $request->input('task'),
        'is_done' => $request->input('is_done')
    ];

    todo::where('id', $id)->update($data);
    return redirect()->route('todo')->with('success', 'berhasil menyimpan perbaikan data' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'berhasil menghapus data' );
    }
}
