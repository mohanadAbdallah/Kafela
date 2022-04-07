<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function orphan()
    {
        return $this->belongsTo('App\User','orphan_id');
    }
    public function sponsor()
    {
        return $this->belongsTo('App\User','sponsor_id');
    }
    public function sponsor_pay()
    {
        return $this->belongsTo('App\User','paid_by_sponsor_id');
    }

    public function getStatusTextAttribute()
    {
        if($this->status == 0){
            return 'جديد';
        }else if($this->status == 1){
            return 'تم نشره';
        }else if($this->status == 2){
            return 'تم حجزه';
        }else if($this->status == 3){
            return 'تم شراءه';
        }else if($this->status == 4){
            return 'ملغي';
        }
    }
}
