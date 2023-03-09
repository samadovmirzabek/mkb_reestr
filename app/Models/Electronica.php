<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electronica extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function dep()
    {
        return $this->belongsTo(Departament::class);
    }
    public function texnika()
    {
        return $this->belongsTo(Texnika::class);
    }
    public function bolim()
    {
        return $this->belongsTo(Bolim::class);
    }
    
}
