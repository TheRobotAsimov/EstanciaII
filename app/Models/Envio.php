<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $table = 'envios';
    protected $primaryKey = 'guia';

    protected $fillable = [
        'id_cliente',
        'precio',
        'dimensiones',
        'peso',
    ];

    //
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'guia');
    }
}
