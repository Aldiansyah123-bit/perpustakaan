<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'judul'         => 'required',
            'id_kategori'   => 'required',
            'keterangan'    => 'required',
            'stock'         => 'required',
            'penulis'       => 'required',
            'gambar'        => 'required',
        ]);

        $file       = Request()->gambar;
        $filegambar = $file->getClientOriginalName();
        $file       ->move(public_path('buku'),$filegambar);

        Buku::create([
            'judul'         => $request->judul,
            'id_kategori'   => $request->id_kategori,
            'keterangan'    => $request->keterangan,
            'stock'         => $request->stock,
            'penulis'       => $request->penulis,
            'gambar'        => $filegambar,
        ]);

        $request->session()->flash('sukses', 'Data Berhasil Di Tambah');
        return redirect('master/buku');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $kategori = Kategori::all();
        return view('buku.add',compact('kategori'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $buku = Buku::where('stock','<', 1)->get();
        return view('buku.index',compact('buku'));
    }

    public function nonaktif()
    {
        $buku = Buku::where('status','!=', 1)->get();
        return view('buku.index',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $buku     = Buku::where('id',$id)->first();
        return view('buku.edit',compact('buku','kategori'));
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
            'judul'         => 'required',
            'id_kategori'   => 'required',
            'keterangan'    => 'required',
            'stock'         => 'required',
            'penulis'       => 'required',
            'gambar'        => 'required',
        ]);
        if (Request()->gambar <> "") {
            //Hapus gambar Lama
            $buku = Buku::where('id',$id)->first();
            if ($buku->gambar <> "") {
                unlink(public_path('buku'). '/' .$buku->gambar);
            }

            //jika ingin ganti gambar
            $file       = Request()->gambar;
            $filebuku   = $file->getClientOriginalName();
            $file       ->move(public_path('buku'),$filebuku);

            Buku::findOrFail($id)->update([
                'judul'         => $request->judul,
                'id_kategori'   => $request->id_kategori,
                'keterangan'    => $request->keterangan,
                'stock'         => $request->stock,
                'penulis'       => $request->penulis,
                'gambar'        => $filebuku,
            ]);

        } else {

            //Jika tidak ingin mengganti icon
            Buku::findOrFail($id)->update([
                'judul'         => $request->judul,
                'id_kategori'   => $request->id_kategori,
                'keterangan'    => $request->keterangan,
                'stock'         => $request->stock,
                'penulis'       => $request->penulis,
            ]);
        }

        $request->session()->flash('sukses', 'Data Berhasil Di Update');
        return redirect('master/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $buku = Buku::where('id',$id)->first();

        if ($buku->gambar <> "") {
            unlink(public_path('buku'). '/' .$buku->gambar);
        }

        Buku::destroy($id);
        $request->session()->flash('sukses', 'Data Berhasil Di Hapus');
        return redirect('master/buku');
    }

    public function status(Request $request, $id)
    {
        $data = Buku::where('id',$id)->first();

        $status_sekarang = $data->status;

        if ($status_sekarang == 1) {
            Buku::where('id',$id)->update([
                'status' => 0
            ]);
        }else{
            Buku::where('id',$id)->update([
                'status' => 1
            ]);
        }
        $request->session()->flash('sukses', 'Status Berhasil Di Ubah');
        return redirect('master/buku');
    }
}
