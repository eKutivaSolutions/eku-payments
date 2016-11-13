<?php
/**
 * Criado por Maizer Aly de O. Gomes para iget.
 * Email: maizer.gomes@gmail.com / maizer.gomes@ekutivasolutions / maizer.gomes@outlook.com
 * Usuário: Maizer
 * Data: 13/09/2016
 * Hora: 12:18
 */

namespace eKutivaSolutions\Payments\Traits\Model;


use Carbon\Carbon;
use Speak\Number;
use Speak\Speller\BrazilianNumberSpeller;

trait Monetary
{
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getAmmountAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }

    public function setAmmountAttribute($value)
    {
        $this->attributes['ammount'] = str_replace(',', '', $value);
    }

    public function getDebtAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }

    public function scopeInSemester($query, $year, $semester = 1, $column = 'date')
    {
        if ($semester == 1) {
            $dates = [$year . '-01-01', $year . '-06-30'];
        } else {
            $dates = [$year . '-07-01', $year . '-12-31'];
        }

        return $query->whereBetween($column, $dates);
    }

    public function getAmmountWordsAttribute()
    {
        $words = (new Number(new BrazilianNumberSpeller()))->speak($this->ammount);

        return $words;
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = str_pad($value, 2, '0', STR_PAD_LEFT);
    }

}