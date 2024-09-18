<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class TodoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // search data
    if (request()->has('search')) {
      $data = Todo::where('task', 'like', '%' . request('search') . '%')->get();
    } else {
      $data = Todo::orderBy('task', 'asc')->get();
    }

    // kirim data ke view todo.app
    return view('todo.app', ['datatabel' => $data]);
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
    // dd mengeluarkan data dari form
    // dd($request);
    // buat validasi inputan
    $request->validate([
      'task' => 'required|min:5|max:30',
    ], [
      'task.required' => 'Task tidak boleh kosong',
      'task.min' => 'Task minimal 5 karakter',
      'task.max' => 'Task maksimal 30 karakter',
    ]);

    // buat variabel untuk menampung data
    $data = [
      'task' => $request->input('task')
    ];
    // simpan data ke database
    Todo::create($data);
    // kembalikan ke halaman todo dengan pesan sukses
    return redirect()->route('todo')->with('success', 'Data berhasil ditambahkan');
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
    // buat validasi inputan
    $request->validate([
      'task' => 'required|min:5|max:30',
    ], [
      'task.required' => 'Task tidak boleh kosong',
      'task.min' => 'Task minimal 5 karakter',
      'task.max' => 'Task maksimal 30 karakter',
    ]);

    // buat variabel untuk menampung data
    $data = [
      'task' => $request->input('task'),
      'is_done' => $request->input('is_done')
    ];

    // update data ke database
    Todo::where('id', $id)->update($data);
    // kembalikan ke halaman todo dengan
    return redirect()->route('todo')->with('success', 'Data berhasil diupdate');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    // panggil model Todo berdasarkan id
    Todo::where('id', $id)->delete();
    // kembalikan ke halaman todo dengan
    return redirect()->route('todo')->with('success', 'Data berhasil dihapus');
  }
}
