<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function product()
{
    return $this->belongsTo(Product::class);
}

public function region()
{
    return $this->belongsTo(Region::class);
}

public function salesperson()
{
    return $this->belongsTo(Salesperson::class);
}
}
