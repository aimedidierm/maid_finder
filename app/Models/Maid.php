<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maid extends Model
{
    use HasFactory, SoftDeletes;

    public function requests()
    {
        return $this->hasMany(MaidRequest::class, 'maid_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'maid_id');
    }
}
