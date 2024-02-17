<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name','description',
    ];

    public function user_info()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
