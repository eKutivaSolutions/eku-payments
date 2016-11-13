<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Scopes\ChargeScope;

class Charge extends Payment
{
    protected static $applyPaymentScope = false;
    protected static $defaultOperation  = 'debit';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ChargeScope());
    }

    public function scopeActive($query)
    {
        return $query->where('charge', true);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'charge_id');
    }

    public function invoicer()
    {
        return $this->belongsTo(Charge::class, 'charge_id');
    }

    //Carefull! When a debit's charge id matches a invoice, it can make the wrong relation!
    //Only call if the charge is an invoice
    //TODO: FIX THIS WITH MORPHING!
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'charge_id');
    }

    public function debits()
    {
        return $this->hasMany(Charge::class, 'charge_id');
    }

    public function debit()
    {
        return $this->belongsTo(Charge::class, 'charge_id');
    }

    public function scopeEnrollmentCharged($query)
    {
        return $query->where('payment_type', 'enrollment')->select(['ammount']);
    }
}
