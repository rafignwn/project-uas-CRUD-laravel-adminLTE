<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('mahasiswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|size:8|unique:students'
        ]);
        $array = $request->only([
            'name','nim'
        ]);
        $student = Student::create($array);
        return redirect()->route('mahasiswa.index')->with('success_message', 'Berhasil menambahkan mahasiswa baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        if (!$student){
            return redirect()->route('users.index')->with('error_message', 'User id dengan id '.$id.' tidak ditemukan'); 
        }

        return view('mahasiswa.edit', compact('student'));
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
        $request->validate([
            'name' => 'required',
            'nim' => 'required|size:8'
        ]);

        $update = Student::where('id', $id)->update([
            'name' => $request->name,
            'nim' => $request->nim
        ]);

        return redirect()->route('mahasiswa.index')->with('success_message', 'Berhasil mengubah mahasiswa'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        
        if ( $student->delete() ){
            return redirect()->route('mahasiswa.index')->with('success_message', 'Berhasil menghapus mahasiswa');
        }else{
            return redirect()->route('mahasiswa.index')->with('error_message', 'Gagal menghapus mahasiswa');
        }
    }
}
