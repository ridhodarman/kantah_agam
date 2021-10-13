<?php

namespace App\Http\Controllers;

use App\Models\Lintor;
use Illuminate\Http\Request;

class LintorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lintor = Lintor::latest()->paginate(5);

        return view('lintor.index',compact('lintor'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('lintor.index', [
        //     'lintor' => Lintor::latest()->paginate(5)
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lintor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'nama' => 'required'
        ]);
        $nama_p = $request->nama;
        if(empty($nama_p[count($nama_p)-1])) {
            unset($nama_p[count($nama_p)-1]);
        }

        $request->merge([
            'nama_pemohon' => json_encode($nama_p),
        ]);

        Lintor::create($request->all());

        return redirect()->route('lintor.index')
                        ->with('success','berkas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lintor $lintor)
    {
        return view('lintor.show',compact('lintor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lintor $lintor)
    {
        return view('lintor.edit',compact('lintor'));
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
            'nama_pemohon' => 'required'
        ]);

        $lintor = Lintor::find($id);
        //return $request;
        //return $lintor->no_sk;

        $lintor->update($request->all());

        return redirect()->back()->with('success', 'Berkas lintor '.$lintor->no_berkas.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lintor = Lintor::find($id);
        $lintor->delete();

        //return redirect()->route('lintor.index')->with('success','berkas telah dihapus');
        return redirect()->back()->with('success','berkas telah dihapus');
    }

    public function cari_nama(Request $request){
        $nama_pemohon = strtolower($request->nama_pemohon);

        $sql = Lintor::whereRaw('lower(nama_pemohon) like (?)',["%{$nama_pemohon}%"])->paginate(5);
            return view ('lintor.index',[
                'nama_pemohon' => $nama_pemohon,
                'lintor' => $sql
            ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cari_nolintor(Request $request){
        $no_lintor = $request->no_lintor;

        $sql = Lintor::whereRaw('no_lintor like (?)',["%{$no_lintor}%"])->paginate(5);
            return view ('lintor.index',[
                'no_lintor' => $no_lintor,
                'lintor' => $sql
            ])->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
