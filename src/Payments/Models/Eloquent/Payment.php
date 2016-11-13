<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Contracts\Model\SearchableInterface;
use App\Scopes\PaymentScope;
use App\Traits\Model\HasRegistrar;
use App\Traits\Model\Listed;
use App\Traits\Model\Monetary;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model implements SearchableInterface
{
    use HasRegistrar, Listed, Monetary;

    protected static $applyPaymentScope = true;
    protected static $defaultOperation  = 'credit';
    protected        $table             = 'payments';
    protected        $guarded           = ['id', 'registrar_id'];

    protected static function boot()
    {
        parent::boot();

        if (static::$applyPaymentScope) static::addGlobalScope(new PaymentScope());
    }

    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                if (is_numeric($keyword)) $query->where('entity', $keyword);
                $query->orWhere('payment_code', 'ILIKE', "%$keyword%");
                $query->orWhere('description', 'ILIKE', "%$keyword%");
            });
        }
    }

    public function scopeInsideTerm($query)
    {
        $query->where('date', '<=', date('Y-m-d'));

        return $query;
    }

    public function scopeEnrollmentPaid($query)
    {
        return $query->where('payment_type', 'enrollment')->select(['ammount']);
    }

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function debit()
    {
        return $this->belongsTo(Charge::class, 'charge_id');
    }

    public function setOperationAttribute()
    {
        $this->attributes['operation'] = static::$defaultOperation;
    }

    public function scopeTotalAdvance($query)
    {
        $query->where(function ($q) {
            $q->where('payment_type', 'advance');
            $q->orWhere('advanced', true);
        });

        return $query;
    }
}
