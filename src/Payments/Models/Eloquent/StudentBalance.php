<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Traits\Model\ReadOnly;
use Illuminate\Database\Eloquent\Model;

class StudentBalance extends Model
{
    use ReadOnly;
    
    public $timestamps = false;

    protected $primaryKey = 'student_id';

    protected $table = 'student_balance_view';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
