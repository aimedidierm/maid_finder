<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaidRequest extends Model
{
    use HasFactory;

    public function maids()
    {
        return $this->belongsTo(Maid::class, 'maid_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
