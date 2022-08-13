<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring_kendaraan extends Model
{
    protected $table = 'monitoring_kendaraan';
    protected $primarykey = 'id_monitoring_kendaraan';

    public $timestamps = false;

    protected $fillable =['name','jeniskendaraan','id_driverr','Bahanbakar','BBM','jadwalservice','pemakaian','pengembalian','persetujuan'];
    
    public function Driver(){
        return $this->belongsTo(Driver::class, 'id_driver');
    }
}
