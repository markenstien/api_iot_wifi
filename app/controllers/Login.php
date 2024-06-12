<?php

    class Login extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->user = model('UserModel');
        }

        public function index()
        {
            $req = request()->inputs();
            return $this->view('login/index', $this->data);
        }

        public function punchLogin()
        {
            $post = request()->posts();
            $user = $this->user->get([
                'email' => trim($post['email'])
            ]);

            $password = trim($post['password']);
            
            if($user)
            {
                Flash::set("Welcome");
                if(isEqual($password , $user->password) ) 
                {
                    Flash::set("Welcome");
                    $loginStatus = $this->user->startSession($user->id);

                    if(!$loginStatus) {
                        Flash::set($this->user->getMessageString(), 'danger');
                        return request()->return();
                    } else {
                        Flash::set($this->user->getMessageString());
                        return redirect(_route('user:profile'));
                    }
                }else{
                    Flash::set("Incorrect password" , 'danger');
                    return request()->return();
                }
                
                return redirect('Dashboard');
            }else{
                Flash::set("Not logged in " , 'danger');
                return redirect('login');
            }
        }


        // public function randomizeUsername()
        // {
        //     $db = Database::getInstance();

        //     $db->query("SELECT * FROM users");
        //     $users = $db->resultSet();

        //     foreach($users as $key => $row) 
        //     {
        //         $username = strtoupper(get_token_random_char(5));

        //         $db->query(
        //             "UPDATE users set username = '{$username}' ,
        //                 password = '12345'
        //                 where id = '$row->id' "
        //         );

        //         $db->update();
        //     }
        // }
    }