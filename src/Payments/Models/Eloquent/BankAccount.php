<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Contracts\Model\SearchableInterface;
use App\Traits\Model\HasBranch;
use App\Traits\Model\HasRegistrar;
use App\Traits\Model\Listed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model implements SearchableInterface
{
    use SoftDeletes, HasRegistrar, Listed, HasBranch;

    protected $guarded = ['id', 'registrar_id', 'active'];

    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('account_number', 'ILIKE', "%$keyword%");
                $query->orWhere('nib', 'ILIKE', "%$keyword%");
                $query->orWhere('email', 'ILIKE', "%$keyword%");
                $query->orWhere('entity', 'ILIKE', "%$keyword%");
            });

            return $query->withTrashed();
        }

        return $query;
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function entities()
    {
        return $this->hasMany(BankEntity::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
