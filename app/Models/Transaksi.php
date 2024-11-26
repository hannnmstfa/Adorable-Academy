<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $fillable = [
        "kelas_id",
        "users_id",
        "reference",
        "method",
        "merchant_ref",
        "harga",
        "fee",
        "urlpayment",
        "status",
    ];
    public $timestamps = 'true';

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
