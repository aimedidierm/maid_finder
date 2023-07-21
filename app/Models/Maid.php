<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maid extends Model
{
    use HasFactory;

    public function requests()
    {
        return $this->hasMany(MaidRequest::class, 'maid_id');
    }
}
