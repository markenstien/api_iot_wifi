<?php 
    
    class WifiDeviceModel extends Model {
        public $table = 'wifi_devices';
        public $_fillables = [
            'wifi_ssid',
            'wifi_password'
        ];

        public function add($wifiData) {
            $wifiDataFillables = parent::getFillablesOnly($wifiData);

            if($wifi = $this->getWifiBySSID($wifiDataFillables['wifi_ssid'])) {
                $this->addMessage("Unable to add new Wifi '{$wifi->wifi_ssid}' already exists.");
                return false;
            } else {
                if(!$this->validatePassword($wifiDataFillables['wifi_password'])) {
                    return false;
                }
                parent::store($wifiDataFillables);
                $this->addMessage("Wifi {$wifiDataFillables['wifi_ssid']} Created");
                return true;
            }
        }

        public function changeSSID($ssid, $id) {
            if($wifi = $this->getWifiBySSID($ssid)) {
                if($wifi->id != $id) {
                    $this->addMessage("Unable to update wifi ssid, ssid already exists");
                    return false;
                }
            }

            return parent::update([
                'wifi_ssid' => $ssid
            ], $id);
        }

        public function changePassword($password, $id) {
            if(!$this->validatePassword($password)) {
                return false;
            }

            return parent::update([
                'wifi_password' => $password
            ], $id);
        } 

        public function getWifiBySSID($ssid) {
            return parent::get([
                'wifi_ssid' => $ssid
            ]);
        }

        private function validatePassword($password) {
            if(strlen($password) < 4) {
                $this->addMessage("Password must atleast be 4 characters long.");
                return false;
            }
            return true;
        }
    }