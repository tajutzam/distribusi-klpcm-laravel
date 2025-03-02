<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klpcm extends Model
{
    use HasFactory;

    protected $table = 'klpcm';

    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(KlpcmDetail::class, "klpcm_id");
    }
}
