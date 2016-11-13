<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Contracts\Model\SearchableInterface;
use App\Traits\Model\HasCompany;
use App\Traits\Model\Listed;
use App\Traits\Model\Monetary;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model implements SearchableInterface
{
    use Monetary, Listed, HasCompany;

    protected $fillable = ['name', 'period_id', 'semester', 'code', 'register_date', 'due_date'];

    public function scopeSearch($query, $keyword)
    {
        // TODO: Implement scopeSearch() method.
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
