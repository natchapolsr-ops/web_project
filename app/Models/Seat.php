<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['theater_id','row','number','type','price_delta'];

    public function theater(): BelongsTo
    {
        return $this->belongsTo(Theater::class);
    }
}
