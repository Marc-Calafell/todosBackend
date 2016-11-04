<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name','done','priority'];


    /**
     * @return array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

