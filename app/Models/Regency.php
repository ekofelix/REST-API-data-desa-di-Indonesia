<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'province_id', 'name'];

    public $incrementing = false;
    protected $keyType = 'char';

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
