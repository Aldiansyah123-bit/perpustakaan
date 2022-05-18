@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                  <div class="card-header">Edit Kategori</div>
                      <div class="card-body">
                        <form action="/master/kategori/update/{{$kategori->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nama kategori</label>
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control" value="{{$kategori->nama}}">
                                    <div class="text-danger">
                                        @error('nama')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="/master/kategori" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
