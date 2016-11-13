<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = ['ammount', 'description', 'invoice_type', 'invoice_id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
