@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                  <div class="card-header">Tambah Buku</div>
                      <div class="card-body">
                        <form action="/master/buku/create" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Judul</label>
                                 <div class="col-md-6">
                                    <input type="text" name="judul" class="form-control">
                                    <div class="text-danger">
                                        @error('judul')
                                            {{$message}}
                                        @enderror
                                    </div>
                                 </div>
                           </div>

                           <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Kategori</label>
                                <div class="col-md-6">
                                    <select name="id_kategori" class="form-control">
                                        <option value="">Select Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                           </div>

                          <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Keterangan</label>
                                 <div class="col-md-6">
                                    <textarea type="text" name="keterangan" class="form-control"></textarea>
                                    <div class="text-danger">
                                        @error('keterangan')
                                            {{$message}}
                                        @enderror
                                    </div>
                                 </div>
                           </div>

                          <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Stok</label>
                                 <div class="col-md-6">
                                    <input type="number" name="stock" class="form-control">
                                    <div class="text-danger">
                                        @error('stock')
                                            {{$message}}
                                        @enderror
                                    </div>
                                 </div>
                           </div>

                          <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Penulis</label>
                                 <div class="col-md-6">
                                    <input type="text" name="penulis" class="form-control">
                                    <div class="text-danger">
                                        @error('penulis')
                                            {{$message}}
                                        @enderror
                                    </div>
                                 </div>
                           </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Gambar</label>
                                    <div class="col-md-6">
                                        <input type="file" name="gambar" class="form-control" accept="image/png/jpg">
                                        <div class="text-danger">
                                            @error('gambar')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-danger">Tambah data</button>
                                    <a href="/master/buku" class="btn btn-info">Kembali</a>
                                </div>
                            </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
