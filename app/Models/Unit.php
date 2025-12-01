<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';


    public function sops()
    {
        return $this->hasMany(Sop::class, 'id_unit', 'id_unit');
    }

}
