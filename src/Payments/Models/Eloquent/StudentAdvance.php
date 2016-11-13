<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Traits\Model\ReadOnly;
use Illuminate\Database\Eloquent\Model;

class StudentAdvance extends Model
{
    use ReadOnly;
    
    public $timestamps = false;

    protected $primaryKey = 'student_id';

    protected $table = 'student_advances_view';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
