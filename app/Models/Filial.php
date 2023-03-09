<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Filial extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function electronica($texnika_id)
    {
        return $this->hasMany(Electronica::class, "filial_id", "id")->where('texnika_id',$texnika_id)->count();
    }

    public static function getFilial(){
        return DB::table('filials')->select("region_id","filial_name")->get();
    }
}
