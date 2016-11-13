<?php

namespace eKutivaSolutions\Payments\Models\Eloquent;

use App\Traits\Model\HasBranch;
use App\Traits\Model\Listed;
use App\Traits\Model\Monetary;
use Illuminate\Database\Eloquent\Model;

class FeeCost extends Model
{
    use HasBranch, Monetary, Listed;

    protected $fillable = ['branch_id', 'course_id', 'curriculum_id', 'ammount'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function ScopeCostAmmount($query, $courseId, $curriculumId, $branchId)
    {
        return $query->where(function ($query) use ($courseId, $curriculumId, $branchId) {
            $query->where('branch_id', $branchId);
            $query->where('curriculum_id', $curriculumId);
            $query->where('course_id', $courseId);
        });
    }
}
