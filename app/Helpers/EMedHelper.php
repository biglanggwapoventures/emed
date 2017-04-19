<?php
    namespace App\Helpers;

    use App\Permissions;

    use Log;

    class EMedHelper
    {
        public static function hasUrlPermission($url)
        {
            $data = Permissions::hasUrlPermission($url);
            return is_null($data) ? false : true;
        }

        public static function hasAddUserPermission()
        {
            $data = Permissions::hasAddUserPermission();
            return is_null($data) ? false : true;
        }
    }
?>