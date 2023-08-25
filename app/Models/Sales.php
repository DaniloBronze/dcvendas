<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'product', 'amount', 'quantity', 'payment', 'plots'];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
}
