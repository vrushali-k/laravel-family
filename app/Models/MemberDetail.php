<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', // Foreign key reference
        'name',
        'dob',
        'marital_status',
        'wedding_date',
        'education',
        'photo',
        'photo_dir',
    ];

    /**
     * A member detail belongs to a member.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
