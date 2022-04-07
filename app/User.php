<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'orphan_file_no','gender','orphan_birth_date',
        'orphan_old_year','orphan_country','orphan_identity',
        'orphan_age_range','orphan_study_range','orphan_school_name',
        'orphan_study_year','orphan_health_state','orphan_disease_name',
        'orphan_disease_type','mother_file_no','mother_name',
        'mother_phone','mother_identity','mother_iban',
        'mother_salary','sponsor_file_no','ensure_type',
        'orphans_count','role','phone','ensure_type_text',
        'sponsor_pay_value','sponsor_pay_start','sponsor_pay_end','bank_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    protected $appends = ['ensure_type_text'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//    protected $appends = ['mother_repeat'];

    public function orphans()
    {
        return $this->belongsToMany('App\User','orphan_sponsor','sponsor_id','orphan_id');
    }
    public function sponsors()
    {
        return $this->belongsToMany('App\User','orphan_sponsor','orphan_id','sponsor_id');
    }

//    public function getMotherRepeatAttribute()
//    {
//        return User::where('mother_identity',$this->mother_identity)->count();
//    }
    public function getEnsureTypeTextAttribute($value)
    {
        if ($value == 1) {
            return 'شهري';
        } else if ($value == 2) {
            return 'سنة واحدة';

        } else if ($value == 15) {
            return 'سنتين';

        } else if ($value == 16) {
            return 'ثلاث سنوات';

        } else if ($value == 3) {
            return 'مقدم لعدد 1 شهر';
        } else if ($value == 4) {
            return 'مقدم لعدد 2 شهر';
        } else if ($value == 5) {
            return 'مقدم لعدد 3 شهر';
        } else if ($value == 6) {
            return 'مقدم لعدد 4 شهر';
        } else if ($value == 7) {
            return 'مقدم لعدد 5 شهر';
        } else if ($value == 8) {
            return 'مقدم لعدد 6 شهر';
        } else if ($value == 9) {
            return 'مقدم لعدد 7 شهر';
        } else if ($value == 10) {
            return 'مقدم لعدد 8 شهر';
        } else if ($value == 11) {
            return 'مقدم لعدد 9 شهر';
        } else if ($value == 12) {
            return 'مقدم لعدد 10 شهر';
        } else if ($value == 13) {
            return 'مقدم لعدد 11 شهر';
        } else if ($value == 14) {
            return 'مقدم لعدد 12 شهر';
        } else {
            return '--';
        }
    }

}
