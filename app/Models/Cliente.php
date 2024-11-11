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
}
