<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cSubTipo extends Model
{
    //
    public function cTipo()
    {
        return $this->belongsTo(cTipo::class, 'id');
    }
}
