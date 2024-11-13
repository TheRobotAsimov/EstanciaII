<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cTipo extends Model
{
    //
    public function subtipos()
    {
        return $this->hasMany(cSubTipo::class, 'id_tipo');
    }
}
