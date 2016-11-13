<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Contracts\Model\SearchableInterface;
use App\Traits\Model\Listed;
use App\Traits\Model\Monetary;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model implements SearchableInterface
{
    use Monetary, Listed;

    protected $fillable = ['name', 'fee_id', 'code', 'due_date', 'active', 'percentage', 'register_date'];

    public function scopeSearch($query, $keyword)
    {
        // TODO: Implement scopeSearch() method.
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
