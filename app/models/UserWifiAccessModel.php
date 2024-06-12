<?php 

    class UserWifiAccessModel extends Model {
        public $table = 'user_wifi_access';
        public $_fillables = [
            'wifi_id',
            'user_id',
            'access_date'
        ];

        /**
         * wifi_ssid
         * email
         */
        public function addAccess($wifiAccessData) {
            if(!isset($wifiAccessData['wifi_ssid'], $wifiAccessData['email'])) {
                $this->addMessage("Invalid data entries");
                return false;
            }

            if(!isset($this->userModel)) {
                $this->userModel = model('UserModel');
            }

            if(!isset($this->wifiDeviceModel)) {
                $this->wifiDeviceModel = model('WifiDeviceModel');
            }

            $user = $this->userModel->single([
                'email' => trim($wifiAccessData['email'])
            ]);

            if(!$user) {
                $this->addMessage("Email not found");
                return false;
            }

            if($this->validateDuplicate($wifiAccessData['wifi_ssid'], $user->id)) {
                return false;
            }
            $this->addMessage("User added to the device");
            return parent::store([
                'wifi_id' => $wifiAccessData['wifi_ssid'],
                'user_id' => $user->id,
                'access_date' => now()
            ]);
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE " . parent::convertWhere($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']}";
            }

            if(!empty($params['limit'])) {
                $limit = " limit {$params['limit']}";
            }

            $this->db->query(
                "SELECT user_access.*,
                    wifi_device.wifi_ssid,
                    user.email as email,
                    user.fullname as fullname FROM 
                    {$this->table} as user_access
                        LEFT JOIN users as user 
                            ON user.id = user_access.user_id
                        LEFT JOIN wifi_devices as wifi_device
                            ON wifi_device.id = user_access.wifi_id
                        
                {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }

        private function validateDuplicate($wifiId, $userId) {
            if($instance = parent::single([
                'wifi_id' => $wifiId,
                'user_id' => $userId
            ])) {
                parent::addMessage("User already has accessed to the device");
                return true;
            } else {
                return false;
            }
        }
    }