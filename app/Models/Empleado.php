<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id'; // Misma clave primaria que 'users'

    protected $fillable = [
        'puesto',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
