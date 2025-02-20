<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', // Foreign key reference
        'hobby'
    ];

    /**
     * A member detail belongs to a member.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
