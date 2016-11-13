<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model
{

    protected $fillable = ['charge_type','description','ammount'];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

}
