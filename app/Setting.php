<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = ['message_monthly_pay','message_yearly_pay',
        'message_by_month_pay','message_thanks_sponsor',
        'message_orphan_received','name_characters_count',
        'date_send_messages','message_user_name','message_password','message_sender_name','logo','website_name','is_website_on'
        ];
}
