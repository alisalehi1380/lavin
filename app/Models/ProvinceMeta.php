<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinceMeta extends Model
{
    protected $table = 'province_meta_data';

    protected $fillable = [
        'province_id',
        'offset-x',
        'offset-y',
        'd'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
