<?php

    class UserModel extends Model
    {
        public $table = 'users';
        public $_fillables = [
            'fullname',
            'username',
            'password',
            'email',
            'user_key',
            'user_type',
            'is_email_verified'
        ];

        public function startSession($id) {
            $user = parent::get([
                'id' => $id
            ]);

            if($user) {
                Session::set('auth', $user);
                $this->addMessage("Session Started");
                return true;
            } else {
                $this->addMessage("Unable to start session no user found.");
                return false;
            }
        }

        public function add($userData)  {
            $_fillables = parent::getFillablesOnly($userData);
            $_fillables['user_key'] = $this->generateUserKey();
            $_fillables['user_type'] = 'client'; //default

            $userId = parent::store($_fillables);
            parent::_addRetval('userId', $userId);
            
            return $userId;
        }

        private function generateUserKey() {
            return strtoupper(get_token_random_char(5));
        }
    }