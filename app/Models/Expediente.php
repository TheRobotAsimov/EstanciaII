<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    //
    protected $fillable = [
        'id_cliente',
        'id_c_categoria',
        'valor',
        'notas',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function categoria()
    {
        return $this->belongsTo(cCategoria::class, 'id_c_categoria');
    }
}
