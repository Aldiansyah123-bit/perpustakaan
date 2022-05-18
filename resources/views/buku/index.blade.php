@extends('layouts.base')

@section('judul1')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0">BUKU</h1>
        </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Data Buku</h3>
                    <div class="card-tools">
                        <button class="btn btn-flat btn-sm btn-warning btn-refresh"><i class="fa fa-refresh"></i>Refesh</button>
                        <a href="/master/buku/add" type="button" class="btn btn-primary btn-sm btn-flat">
                            <i class="fa fa-plus"></i>Add
                        </a>
                        <a href="/master/buku" type="button" class="btn btn-warning btn-sm btn-flat">
                            <i class=""></i>All Buku
                        </a>
                        <a href="/master/buku/kosong" type="button" class="btn btn-danger btn-sm btn-flat">
                            <i class=""></i>Buku Kosong
                        </a>
                        <a href="/master/buku/nonaktif" type="button" class="btn btn-info btn-sm btn-flat">
                            <i class=""></i>Buku Non-Aktif
                        </a>
                      </div>
                <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="30px" class="text-center">No</th>
                                    <th>Status</th>
                                    <th>Pinjam</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach ($buku as $item)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <a href="/master/buku/status/{{$item->id}}" class="btn btn-sm btn-danger">non-Aktifkan</a>
                                            @else
                                                <a href="/master/buku/status/{{$item->id}}" class="btn btn-sm btn-success">Aktifkan</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary">Pinjam Buku</a>
                                        </td>
                                        <td class="text-center"><img src="{{ asset('buku') }}/{{ $item->gambar }}" width="300px"></td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->kategori->nama }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td><label class="btn {{ ($item->status == 1)? 'btn-success' : 'btn-danger' }}">{{ ($item->status == 1)? 'Aktif' : 'Tidak Aktif' }}</label></td>
                                        <td class="text-center">
                                            <a href="/master/buku/edit/{{ $item->id}}" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="/master/buku/detail/{{ $item->id}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></a>
                                            <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{ $item->id}}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.card-body -->
            </div>
         <!-- /.card -->
        </div>

        @foreach ($buku as $item)
        <div class="modal fade" id="delete{{ $item->id}}">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $item->judul}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Akan Menghapus Data ini ???</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                        <a href="/master/buku/delete/{{ $item->id}}" type="button" class="btn btn-outline-light">Yes</a>
                    </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @endforeach

<script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var flash = "{{ Session::has('sukses') }}";
        if (flash) {
            var pesan = "{{ Session::get('sukses')}} "
            alert(pesan);
        }
        var gagal = "{{ Session::has('gagal') }}";
        if (gagal) {
            var pesan = "{{ Session::get('sukses')}} "
            swal("Error" ,pesan, "error");
        }
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            location.reload();
        })
    })
</script>

@endsection
