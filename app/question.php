<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    //
    protected $table = 'questions';
    protected $primaryKey = 'id';


    public function scopeGeidrandomanswer($query,$id,$idTema)
    {
        return $query->select('id')->where([ 
            ['id','<>',$id],
            ['id_temas',$idTema],
            ])->inRandomOrder()->limit(4);
    }
   
}
