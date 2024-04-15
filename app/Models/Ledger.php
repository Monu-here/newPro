<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'amount',
        'item_id',
        'rate',
        'user_id',
        'decive_id',
        'type',
        'remote_id',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function parties()
    {
        return $this->belongsTo(Parties::class);
    }
}
