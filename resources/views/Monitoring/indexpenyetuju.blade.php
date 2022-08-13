@extends('templatepenyetuju')
@section('contentpenyetuju')

<div class="content">
    <div class="row">
          <div class="col-md-12">
                <h4 class="card-title"> Monitoring Kendaraan</h4>
                
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
                            <th scope="col">Name</th>
                            <th scope="col">Jenis Kendaraan</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Bahan Bakar</th>
                            <th scope="col">BBM</th>
                            <th scope="col">jadwal service</th>
                            <th scope="col">Jadwal pemakaian</th>
                            <th scope="col">Jadwal pengembalian</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->id_jenisskendaraan }}</td>
                                <td>{{ $item->id_driverr }}</td>
                                <td>{{ $item->Bahanbakar }}</td>
                                <td>{{ $item->BBM }}</td>
                                <td>{{ $item->jadwalservice }}</td>
                                <td>{{ $item->pemakaian }}</td>
                                <td>{{ $item->pengembalian }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id_monitoring_kendaraan }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{route('monitoring_kendaraan.destroy', [$item->id_monitoring_kendaraan])}}" class="d-inline" onsubmit="return confirm('Delete this data permanently?')">
                                    @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{ $item->id_monitoring_kendaraan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('monitoring_kendaraan.update', $item->id_monitoring_kendaraan) }}" method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_jenisskendaraan">jenis kendaraan</label>
                                                    <select class="form-control @error('id_jenisskendaraan') is-invalid @enderror" name="id_jenisskendaraan" id="id_jenisskendaraan" placeholder="jenisskendaraan" autocomplete="off" value="{{ old('id_jenisskendaraan') }}">
                                                    <option value="">-Pilih-</option>
                                                    <option value="Cuci setrika">Angkutan barang</option>
                                                    <option value="Cuci kering">Angkutan Orang</option> 
                                                    </select>
                                                   
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="driver" class="form-label">Driver</label>
                                                    <select name="driver" class="form-control input-sm">
                                                    <option value="0">== SEMUA ==</option>
                                                    @foreach (@$data as $key => $value)
                                                    <option value="{{ $value->id_driverr }}" {{ $value->id_driverr == @$request['driver'] ? 'selected' : NULL }}>{{ $value->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Bahanbakar">Bahan Bakar</label>
                                                    <input type="text" name="Bahanbakar" class="form-control" id="Bahanbakar" value="{{ $item->Bahanbakar }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="BBM">BBM</label>
                                                    <input type="text" name="BBM" class="form-control" id="BBM" value="{{ $item->BBM }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="jadwalservice">Jadwal Service</label>
                                                    <input type="text" name="jadwalservice" class="form-control" id="jadwalservice" value="{{ $item->jadwalservice }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemakaian ">Jadwal Pemakaian</label>
                                                    <input type="text" name="pemakaian " class="form-control" id="pemakaian " value="{{ $item->pemakaian  }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="pengembalian">Jadwal Pengembalian</label>
                                                    <input type="text" name="pengembalian" class="form-control" id="pengembalian" value="{{ $item->pengembalian }}" required>   
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
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
                    <form action="{{ route('monitoring_kendaraan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>   
                        </div>
                        
                        <div class="form-group">
                         <label for="jeniskendaraan">jenis kendaraan</label>
                         <select class="form-control @error('jeniskendaraan') is-invalid @enderror" name="jeniskendaraan" id="jeniskendaraan" placeholder="Jenis Kendaraan" autocomplete="off" value="{{ old('jeniskendaraan') }}">
                         <option value="">-Pilih-</option>
                         <option value="Cuci setrika">Angkutan barang</option>
                         <option value="Cuci kering">Angkutan Orang</option> 
                         </select>
                       
                         </div>
                         <div class="form-group">
                        <label for="driver" class="form-label">Driver</label>
                        <select name="driver" class="form-control input-sm">
                        <option value="0">== PILIH ==</option>
                         @foreach (@$data as $key => $value)
                        <option value="{{ $value->id_driverr }}" {{ $value->id_driverr == @$request['driver'] ? 'selected' : NULL }}>{{ $value->name }}</option>
                        @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="Bahanbakar">Bahan Bakar</label>
                            <input type="text" name="Bahanbakar" class="form-control" id="Bahanbakar" required>   
                        </div>
                        <div class="form-group">
                            <label for="BBM">BBM</label>
                            <input type="text" name="BBM" class="form-control" id="BBM" required>   
                        </div>
                        <div class="form-group">
                            <label for="jadwalservice ">Jadwal Service </label>
                            <input type="date" name="jadwalservice " class="form-control" id="jadwalservice " required>   
                        </div>
                        <div class="form-group">
                            <label for="pemakaian">Jadwal Pemakaian</label>
                            <input type="date" name="pemakaian" class="form-control" id="pemakaian" required>   
                        </div>
                        <div class="form-group">
                            <label for="pengembalian">Jadwal Pengembalian</label>
                            <input type="date" name="pengembalian" class="form-control" id="pengembalian" required>   
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    @endsection