@extends('template')
@section('content')
<div class="content">
<div class="row">
          <div class="col-md-12">
                <h4 class="card-title"> Driver</h4>
                
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
                            <th scope="col">Driver</th>
                            <th scope="col">Option</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($driverr as $key => $item)
                        
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>
                                <form method="DELETE" action="{{route('driverr.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Delete this data permanently?')">
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
            <!-- add -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('driverr.store') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="nama">Name</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>   
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> 
                
            </div>
        </div>
    </div>
        @endsection