<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlpcmDetail extends Model
{
    use HasFactory;

    protected $table = 'klpcm_detail';

    protected $guarded = ['id'];

    public function klpcm()
    {
        return $this->belongsTo(Klpcm::class, "klpcm_id");
    }
}
