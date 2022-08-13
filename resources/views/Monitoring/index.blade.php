@extends('template')
@section('content')

<div class="content">
    <div class="row">
          <div class="col-md-12">
                <h4 class="card-title"> Monitoring Kendaraan</h4>
                
            <div class="table-responsive">
                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#addModal">
                +Tambah Data
                </button>
                <a href="/monitor/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
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
                            <th scope="col">Persetujuan</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->jeniskendaraan}}</td>
                                <td>{{ $item->id_driver}}</td>
                                <td>{{ $item->Bahanbakar }}</td>
                                <td>{{ $item->BBM }}</td>
                                <td>{{ $item->jadwalservice }}</td>
                                <td>{{ $item->pemakaian }}</td>
                                <td>{{ $item->pengembalian }}</td>
                                <td>{{ $item->persetujuan }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{route('monitoring_kendaraan.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Delete this data permanently?')">
                                    @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('monitoring_kendaraan.update', $item->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="jeniskendaraan">jenis kendaraan</label>
                                                    <select class="form-control @error('jeniskendaraan') is-invalid @enderror" name="jeniskendaraan" id="jeniskendaraan" placeholder="jenisskendaraan" autocomplete="off" value="{{ old('jeniskendaraan') }}">
                                                    <option value="">-Pilih-</option>
                                                    <option value="angkutan orang">Angkutan Orang</option>
                                                    <option value="angkutan barang">Angkutan Barang</option>
                                                    </select>
                                                   
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="monitoring">Driver:</label>
                                                                <select name="id_driver" id="id_driver" class="form-control selectpicker" data-style="btn-success">
                                                                    <option data-hidden="true">--Pilih Driver--</option>
                                                                    @foreach($data as $key => $value)
                                                                    <option value="{{ $value->id }}" {{ @$driverr['id_driver'] == $value ? 'selected' : null }}>{{ $value->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                 <div class="form-group">
                                                    <label for="Bahanbakar">Bahan Bakar</label>
                                                    <select class="form-control @error('Bahanbakar') is-invalid @enderror" name="Bahanbakar" id="Bahanbakar" placeholder="Bahanbakar" autocomplete="off" value="{{ old('Bahanbakar') }}">
                                                    <option value="">-Pilih-</option>
                                                    <option value="Bensin">Bensin</option>
                                                    <option value="Solar">Solar</option>
                                                    <option value="Pertalite">Pertalite</option>
                                                    <option value="Pertamax">Pertamax</option>
                                                    <option value="Pertamax Dex">Pertamax Dex</option>
                                                   
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="BBM">BBM</label>
                                                    <input type="text" name="BBM" class="form-control" id="BBM" value="{{ $item->BBM }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="jadwalservice">Jadwal Service</label>
                                                    <input type="date" name="jadwalservice" class="form-control" id="jadwalservice" value="{{ $item->jadwalservice }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemakaian ">Jadwal Pemakaian</label>
                                                    <input type="date" name="pemakaian " class="form-control" id="pemakaian " value="{{ $item->pemakaian  }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="pengembalian">Jadwal Pengembalian</label>
                                                    <input type="date" name="pengembalian" class="form-control" id="pengembalian" value="{{ $item->pengembalian }}" required>   
                                                </div>
                                                <div class="form-group">
                                                    <label for="persetujuan">Persetujuan</label>
                                                    <select class="form-control @error('persetujuan') is-invalid @enderror" name="persetujuan" id="persetujuan" placeholder="persetujuan" autocomplete="off" value="{{ old('persetujuan') }}">
                                                    <option value="">-Pilih-</option>
                                                    <option value="setuju">Setuju</option>
                                                    <option value="tidak setuju">Tidak Setuju</option>
                                                    
                                                   
                                                    </select>
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
                        <select class="form-control @error('jeniskendaraan') is-invalid @enderror" name="jeniskendaraan" id="jeniskendaraan" placeholder="jenisskendaraan" autocomplete="off" value="{{ old('jeniskendaraan') }}">
                        <option value="">-Pilih-</option>
                        <option value="angkutan orang">Angkutan Orang</option>
                        <option value="angkutan barang">Angkutan Barang</option>
                        </select>
                       
                        </div>
                         <div class="form-group">
                        <label for="driver" class="form-label">Driver</label>
                        <select name="driver" class="form-control input-sm">
                        <option value="0">== SEMUA ==</option>
                        @foreach (@$data as $key => $value)
                        <option value="{{ $value->id }}" {{ old('id_driver', $value->id_driver) == $value->driver->id ? 'selected' : '' }}> {{ $value->driver->nama }} </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                     <label for="Bahanbakar">Bahan Bakar</label>
                     <select class="form-control @error('Bahanbakar') is-invalid @enderror" name="Bahanbakar" id="Bahanbakar" placeholder="Bahanbakar" autocomplete="off" value="{{ old('Bahanbakar') }}">
                     <option value="">-Pilih-</option>
                     <option value="Bensin">Bensin</option>
                     <option value="Solar">Solar</option>
                     <option value="Pertalite">Pertalite</option>
                     <option value="Pertamax">Pertamax</option>
                     <option value="Pertamax Dex">Pertamax Dex</option>
                    
                     </select>
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
                        <div class="form-group">
                     <label for="persetujuan">Persetujuan</label>
                     <select class="form-control @error('persetujuan') is-invalid @enderror" name="persetujuan" id="persetujuan" placeholder="persetujuan" autocomplete="off" value="{{ old('persetujuan') }}">
                     <option value="">-Pilih-</option>
                     <option value="setuju">Setuju</option>
                     <option value="tidak setuju">Tidak Setuju</option>
                    
                     </select>
                 </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    @endsection