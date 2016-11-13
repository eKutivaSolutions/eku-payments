<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Student;
use eKutivaSolutions\Core\Contracts\Model\SearchableInterface;
use eKutivaSolutions\Core\Traits\Model\CodeSequenciable;
use eKutivaSolutions\Core\Traits\Model\HasRegistrar;
use eKutivaSolutions\Payments\Traits\Model\Monetary;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model implements SearchableInterface
{
    use HasRegistrar, Monetary, CodeSequenciable;
    protected $fillable = ['student_id', 'description', 'due_date', 'obs'];

    public function scopeSearch($query, $keyword)
    {
        // TODO: Implement scopeSearch() method.
    }

    public function scopeUnpaidDues($query)
    {
        return $query->where('paid', false)->where('due_date', '<', date('Y-m-d'));
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    //Invoice doesnt have charges!! Dont commit this error!!!
    //Maybe it can have through debit()
//    public function charges()
//    {
//        return $this->hasMany(Charge::class, 'charge_id')->where('payment_type', '<>', 'invoice');
//    }

    /**
     * Invoice has debit where payment_type is invoice (stupid comment)
     *
     * @return mixed
     */
    public function debit()
    {
        return $this->hasOne(Charge::class, 'charge_id')->where('payment_type', 'invoice');
    }

    public function createInvoiceCode()
    {
        $code = $this->generateFakeCode();

        return $this->setAttribute('description', 'Factura #' . $code);
    }
}
