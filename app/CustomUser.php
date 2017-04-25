<?php

namespace App;

use DB;

class CustomUser
{
    public static function retrieveData($id)
    {
        return DB::table('users')
               ->join('custom_users', 'users.id', '=', 'custom_users.user_id')
               ->select('users.*', 'custom_users.bloodtype', 'custom_users.econtact', 'custom_users.enumber', 'custom_users.nationality',
                        'custom_users.civilstatus', 'custom_users.erelationship', 'custom_users.occupation', 'custom_users.uid')
               ->where('users.id', $id)->first();
    }

    public static function storeData($customData)
    {
        DB::table('custom_users')->insert($customData);
    }
}
