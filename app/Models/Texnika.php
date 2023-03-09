<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Texnika extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function electronica($texnika_id)
    {
        $filial = Filial::where('region_id',(Auth::user()->region_id))->get();
        
            for($i=0;$i<count($filial);$i++){
                $a[$i] = $filial[$i]->id;
            }
        
        if(!(Auth::user()->region_id)){
            return $this->hasMany(Electronica::class,'texnika_id','id')->where('texnika_id',$texnika_id)->count();   
        }
        else{
            // Filialdan region_id orqali filialni id larini olib whereIn ga berib yuborish kerak
         return $this->hasMany(Electronica::class,'texnika_id','id')->whereIn('filial_id',$a)->where('texnika_id',$texnika_id)->count();   
        }
        
    }
    public function soni($texnika_id)
    {
        return $this->hasMany(Electronica::class,)->where('texnika_id',$texnika_id)->where('filial_id',1)->count();
    }


}
