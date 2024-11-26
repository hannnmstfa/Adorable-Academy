<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Kelas extends Model
{
    use HasFactory, Notifiable;
    protected $table = "kelas";
    protected $fillable = [
        "nama",
        "kodekelas",
        "foto",
        "deskripsi",
        "kategori",
        "harga",
        "fakeharga",
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'kelas_id', 'users_id')
                    ->withTimestamps();
    }
    public function kelas(){
        return $this->belongsToMany(Kelas::class);
    }
    public $timestamps = 'true';
}
