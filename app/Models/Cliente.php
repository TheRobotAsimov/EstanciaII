<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id'; // Misma clave primaria que 'users'

    protected $fillable = [
        'saldo',
        'estado',
        'CURP',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function expedientes()
    {
        return $this->hasMany(Expediente::class, 'id_cliente');
    }

    public function envios()
    {
        return $this->hasMany(Envio::class, 'id_cliente');
    }
}
