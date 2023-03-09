<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function electronica($texnika_id)
    {
        return $this->hasMany(Electronica::class, 'dep_id', 'id')->where('texnika_id',$texnika_id)->count();
    }
}
