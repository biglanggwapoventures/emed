<?php
    namespace App\Helpers;

    use App\Permissions;

    use Log;

    class EMedUtil
    {
        public static function isInvalid($value)
        {
            return is_null($value) || empty($value) || count($value) <= 0;
        }

        public static function extractRouteData($routeName)
        {
            if(self::isInvalid($routeName))
            {
                return null;
            }
            else
            {
                $length = strlen($routeName) - 1;
                $separatorPos = strrpos($routeName, '.');

                if($separatorPos == $length)
                {
                    return null;
                }
                else
                {                    
                    $target = substr($routeName, 0, $separatorPos);
                    $action = substr($routeName, $separatorPos+1, $length-$separatorPos);

                    return json_decode(json_encode(['target' => $target, 'action' => $action]));
                }
            }
        }

        public static function recreateRouteAction($action)
        {
            $originalAction = $action;
            $newAction = $action;
            
            if($action === 'store')
            {
                $newAction = 'create';
            }
            else if($action === 'update')
            {
                $newAction = 'edit';
            }

            return json_decode(json_encode(array('new' => $newAction, 'old' => $originalAction)));
        }

        public static function isUserPatient()
        {
            return session('user_type') === 'PATIENT';
        }

        public static function isUserDoctor()
        {
            return session('user_type') === 'DOCTOR';
        }

        public static function isUserPharma()
        {
            return session('user_type') === 'PHARMA';
        }

        public static function isUserAdmin()
        {
            return session('user_type') === 'ADMIN';
        }

        public static function isUserManager()
        {
            return session('user_type') === 'PMANAGER';
        }

        public static function formatManagerList($mgrList)
        {
            $formattedList = [];
            foreach ($mgrList as $mgr) 
            {
                $formattedList[$mgr->user_id] = $mgr->firstname.' '.$mgr->lastname;
            }

            return $formattedList;
        }
    }
?>

