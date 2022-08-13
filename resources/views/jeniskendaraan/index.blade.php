@extends('template')
@section('content')
<div class="content">
<div class="row">
          <div class="col-md-12">
                <h4 class="card-title"> Jenis kendaraan</h4>
                
            <div class="table-responsive">
                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#addModal">
                +Tambah Data
                </button>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Merek kendaraan</th>
                            <th scope="col">Jenis Kendaraan</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->merek }}</td>
                                <td>{{ $item->jenis }}</td>
                            
                                <td>
                                <form method="POST" action="{{route('jenisskendaraan.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Delete this data permanently?')">
                                    @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                     
                                </td>
                            </tr>
                            @endforeach   
                    </tbody>
                </table>
            </div>
                            
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @csrf
                <div class="modal-body">
                
                    <form action="{{ route('jenisskendaraan.store') }}" method="POST">
                      @csrf
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" name="merek" class="form-control" id="merek" required>   
                        </div>
                        <div class="form-group">
                        
                        <label for="jenis">Jenis Kendaraan</label>
                        <select class="form-control" name="jenis" id="jenis" placeholder="jenisskendaraan" autocomplete="off" value="{{ old('jenis') }}">
                        <option value="">-Pilih-</option>   
                        <option value="angkutan orang">Angkutan Orang</option>
                        <option value="angkutan barang">Angkutan Barang</option>
                        </select>
                        
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
        @endsection