<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'district_id', 'name'];

    public $incrementing = false;
    protected $keyType = 'char';

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
