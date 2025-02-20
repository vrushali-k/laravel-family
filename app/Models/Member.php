<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sirname',
        'dob',
        'mobile_no',
        'address',
        'state_id',
        'city_id',
        'pin_code',
        'marital_status',
        'wedding_date',
        'photo',
        'photo_dir',
    ];

    /**
     * A member has many member details.
     */
    public function memberDetails()
    {
        return $this->hasMany(MemberDetail::class);
    }
	
	public function hobbies()
    {
        return $this->hasMany(Hobby::class);
    }
}
