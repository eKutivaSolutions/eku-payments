<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Contracts\Model\SearchableInterface;
use App\Traits\Model\CodeSequenciable;
use App\Traits\Model\HasRegistrar;
use App\Traits\Model\Monetary;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model implements SearchableInterface
{
    use HasRegistrar, Monetary, CodeSequenciable;

    protected $fillable = ['bank_account_id', 'payment_method_id', 'payment_code', 'ammount', 'payment_date', 'obs'];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function details()
    {
        return $this->hasMany(ReceiptDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('payment_code', $keyword);
                $query->orWhere('obs', 'ILIKE', "%$keyword%");
            });
        }
    }
}
