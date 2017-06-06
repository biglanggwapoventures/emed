<?php
    namespace App\Helpers;

    use App\Permissions;
    use App\UserRoles;
    use App\Common;
    use App\TransactionLine;

    use Log;

    class EMedHelper
    {
        public static function hasRoutePermission($route)
        {
            $data = Permissions::retrieveByRoute($route);
            return count($data) > 0;
        }

        public static function showListOfTarget($target)
        {
            // Log::info('Checking if user has permissions to any action that gives the list of ' . $target);

            $data = Permissions::getListAndActionsOfTarget($target);
            $permissionCount = count($data); 
            $flag = $permissionCount > 0;

            if($permissionCount === 1)
            {
                // Log::info('Permission count is only 1. Verifying if it\'s an edit permission of it\'s own user type');
                $permission = $data{0};

                if(strtoupper(session('user_type_name')) === strtoupper($permission->target))
                {
                    // Log::info('Verified - It\'s a self-user type edit permission. This permission is for user profile update only. Updating flag to FALSE.');
                    $flag = false;
                }
                else
                {
                    // Log::info('Verified - It\'s not a self-user type edit permission. ');
                }
            }

            // Log::info(($flag ? 'GRANTED' : 'DENIED') . '. Permission count = ' . $permissionCount);

            return $flag;
        }

        public static function hasTargetActionPermission($target, $action)
        {
            $data = Permissions::retriveByTargetAndAction($target, $action);
            return count($data) > 0;
        }

        public static function getCustomRoles()
        {
            $data = UserRoles::getCustomRoles();
            return $data;
        }        

        public static function hasPermissionId($id, $roleId = null)
        {
            $data = Permissions::retrieveRoleOnPermissionId($id, $roleId);
            return is_null($data) ? false : true;
        }

        public static function retrieveRoleIdByName($rawAddName)
        {
            $name = substr($rawAddName, 16, (strlen($rawAddName) - 16));
            return UserRoles::getRoleByName($name)->id;
        }

        public static function hasDoctorAttachment($patientId)
        {
            $data = Common::getDoctorAttachments($patientId);
            return count($data) > 0;
        }

        public static function retrieveAffiliation($affiliationId)
        {
            return Common::getAffiliation($affiliationId);
        }

        public static function retrieveAffiliationBranch($branchId)
        {
            return Common::getAffiliationBranch($branchId);
        }

        public static function retrievePharmacy($pharmacyId)
        {
            return Common::getPharmacy($pharmacyId);
        }

        public static function retrievePharmacyBranch($branchId)
        {
            return Common::getPharmacyBranch($branchId);
        }


        public static function handlePatientPrescriptionsDisplay($patients, $doctors, $patientDoctor, $prescriptions)
        {
            $formattedData = [];

            $formattedDoctors = [];
            foreach ($doctors as $doctor) 
            {
                $formattedDoctors[$doctor->doctor_id]['user_id'] = $doctor->id;
                $formattedDoctors[$doctor->doctor_id]['id'] = $doctor->doctor_id;
                $formattedDoctors[$doctor->doctor_id]['firstname'] = $doctor->firstname;
                $formattedDoctors[$doctor->doctor_id]['lastname'] = $doctor->lastname;
            }

            foreach ($patients as $patient) 
            {
                $patientId = $patient->patient_id;
                $patientData = 
                [   
                    'patient_id'    => $patientId,
                    'id'            => $patient->id,
                    'firstname'     => $patient->firstname,
                    'lastname'      => $patient->lastname
                ];

                $doctorsOfPatient = [];
                $doctorCount = 0;
                foreach ($patientDoctor as $item) 
                {
                    $doctorId = $item->doctor_id;
                    if($item->patient_id == $patientId)
                    {
                        $doctorCount++;
                        $doctorOfPatient = $formattedDoctors[$doctorId];
                        $prescriptionCount = 0;
                        
                        foreach ($prescriptions as $prescription) 
                        {
                            if($prescription->patient_id == $patientId && $prescription->doctor_id == $doctorId)
                            {
                                $prescriptionCount++;
                            }
                        }

                        $doctorOfPatient['prescriptionCount'] = $prescriptionCount;
                        array_push($doctorsOfPatient, $doctorOfPatient);
                    }
                }

                $patientData['doctorCount'] = $doctorCount;
                $patientData['doctors'] = $doctorsOfPatient;
                $formattedData[$patientId] = $patientData;
            }

            return $formattedData;
        }

        public static function handlePatientPrescriptions($patientId)
        {
            $formattedData = [];
            $patientDoctors = Common::getPatientDoctorLink($patientId);

            foreach ($patientDoctors as $doctor) 
            {

                $doctorData = Common::getDoctorUserData($doctor->doctor_id);
                $doctorData2 = Common::getDoctorData($doctor->doctor_id);
                $data['doctor_name'] = "Dr. " . $doctorData->firstname . " " . $doctorData->lastname;
                $data['ptr'] = $doctorData2->ptr;
                $data['prc'] = $doctorData2->prc;
                $data['s2'] = $doctorData2->s2;
                $data['prescriptions'] = json_decode(json_encode(Common::getActivePrescriptions($patientId, $doctor->doctor_id)), true);

                for ($i = 0; $i < count($data['prescriptions']); $i++) 
                { 
                    $prescriptionId = $data['prescriptions'][$i]['id'];
                    $purcQty = TransactionLine::getPurcQtyOfPrescription($prescriptionId);
                    
                    $data['prescriptions'][$i]['purchased'] = $purcQty;
                }

                // Log::info($data['prescriptions']);
                array_push($formattedData, $data);
            }

            // Log::info($formattedData);

            return $formattedData;
        }

        public static function getPatientId($patientUserId)
        {
            return Common::getPatientId($patientUserId);
        }

        public static function isCurrentPassword($rawPassword, $userId = null)
        {
            return Common::doPasswordsMatch((is_null($userId) ? session('user_id') : $userId), $rawPassword);
        }

        public static function requirePasswordChange()
        {
            return Common::requireChange();
        }

        public static function retrievePatientName($patientId)
        {
            return Common::getPatientName($patientId);
        }

        public static function retrieveDoctorName($doctorId)
        {
            return Common::getDoctorName($doctorId);
        }
    }
?>