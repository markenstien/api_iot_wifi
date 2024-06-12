<?php 

    class WifiConnectController extends Controller
    {
        private $userModel, $wifiDeviceModel, $userWifiAccessModel;

        public function __construct()
        {
            parent::__construct();
            
            $this->userModel = model('UserModel');
            $this->wifiDeviceModel = model('WifiDeviceModel');
            $this->userWifiAccessModel = model('UserWifiAccessModel');
        }
        /**
         * pass the following
         * email, ssid
         */
        public function connect() {
            $req = request()->get();
            $message = '';
            $hasError = false;
            if(!empty($req['email']) && !empty($req['ssid'])) {
                //continue
                $email = trim($req['email']);
                $ssid = trim($req['ssid']);

                /**
                 * check if users email
                 * check for devices
                 * then if user has an account to device by using the userid and device_id
                 */

                $user = $this->userModel->get([
                    'email' => $email
                ]);

                $device = $this->wifiDeviceModel->get([
                    'wifi_ssid' => $ssid
                ]);

                if(!$user) {
                    $hasError = true;
                    $message .= "User with '{$email}' is not registered to our database";
                }

                if(!$device) {
                    $hasError = true;
                    $message .= "Network '{$ssid}' is not registered to our database";
                }

                /**
                 * first level check
                 * for account and device acccess
                 */
                if($hasError) {
                    echo $this->jsonResponse([
                        'message' => $message,
                        'requestStatus'  => 'FALSE'
                    ]);
                    return ;
                }
                

                /**
                 * second check user device access
                 * here we check if the user has access to the specific device
                 */

                $hasAccess = $this->userWifiAccessModel->get([
                    'wifi_id' => $device->id,
                    'user_id' => $user->id
                ]);
                
                if(!$hasAccess) {
                    $message = "User {$email} is not authorized to connect on device {$device->wifi_ssid}";
                    echo $this->jsonResponse([
                        'message' => $message,
                        'requestStatus'  => 'FALSE'
                    ]);
                    return ;
                }

                $message = "Access Granted";
                echo $this->jsonResponse([
                    'message' => $message,
                    'deviceData'  => $device,
                    'requestStatus'  => 'TRUE'
                ]);
                return ;
            } else {
                echo $this->jsonResponse([
                    'message' => 'INVALID REQUEST',
                    'requestStatus'  => 'FALSE'
                ]);
            }
        }

        private function jsonResponse($data, $attributes = []) {
            return json_encode([
                'data' => $data,
                'attributes' => $attributes
            ]);
        }
    }