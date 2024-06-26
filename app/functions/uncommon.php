<?php
    
    function __($data)
    {
        if( is_array($data) )
        {
            foreach($data as $d)
                echo $d;
        }else
        {
            echo $data;
        }
    }

    function authRequired()
    {
        return true;
        if(empty(Auth::get()))
            return redirect(BASECONTROLLER);
    }

    function isSubmitted()
    {
        $request = $_SERVER['REQUEST_METHOD'];
        if( strtolower($request) === 'post')
            return true;
        return false;
    }  

    //temporary
    function authSet($data)
    {
        Session::set('auth' , $data);
        return Session::get('auth');
    }

    function whoIs($prop = null)
	{
        $user = Session::get('auth');

        if(!is_null($prop)){
            if(is_array($prop)) 
            {
                $str = '';
                foreach($prop as $key => $row) {
                    if($key >= 0)
                        $str .= " "; 
                    if(is_array($user)) {
                        $str.= $user[$row];
                    } else {
                        $str .= $user->$row;
                    }
                }
                return trim($str);
            } else {
                if(is_array($user))
                    return $user[$prop];
                if(is_object($user))
                    return $user->$prop;  
            }

                      
        } 

        return $user ?? '';
	}


    function getApi($url)
    {
        $apiDatas = file_get_contents($url);

        if(is_null($apiDatas))
            return false;

        return json_decode($apiDatas);
    }
    /*MOVE TO CORE FUNCTIONS*/

    function view($view , $data = [])
    {
        $GLOBALS['data'] = $data;

        $view = convertDotToDS($view);

        extract($data);

        if(file_exists(VIEWS.DS.$view.'.php'))
        {
            require_once VIEWS.DS.$view.'.php';
        }else{
            die("View {$view} does not exists");
        }
    }


    function ee($data)
    {
        echo json_encode($data);
    }

    function api_response($data , $status = true)
    {
        return [
            'data' => $data,
            'status' => $status
        ];
    }


    function convertDotToDS($path)
    {
        return str_replace('.' , DS , $path);
    }

    function require_multiple($PATH , array $files)
    {
        foreach($files as $file) {
            require_once($PATH.DS.$file.'.php');
        }
    }

    function return_require($PATH , $file)
    {
        $source = $PATH.DS.$file.'.php';
        if(file_exists($source))
            return require_once $source;
    }


    function amountHTML($amount)
	{
		$amountHTML = number_format($amount , 2);

		if($amount < 0) {
            $amountHTML = number_format(abs($amount), 2);
			return "<span>( {$amountHTML} )</span>";
		}else{
			return "<span> {$amountHTML}</span>";
		}
    }

    function api_call($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }


        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        return $result;
        curl_close($curl);
    }

    function base_url($args = '')
    {
      return URL.DS.$args;
    }

    function load(array $pathOrClass , $path = null)
    {
      if(is_null($path)) {
        foreach($pathOrClass as $key => $row) {
          require_once $row.'.php';
        }
      }else{
        foreach($pathOrClass as $key => $row) {
          require_once $path.DS.$row.'.php';
        }
      }
    }

    function model($model)
    {
        $model = ucfirst($model);

        if(file_exists(MODELS.DS.$model.'.php')){

            require_once MODELS.DS.$model.'.php';

            return new $model;
        }
        else{

            die($model . 'MODEL NOT FOUND');
        }
    }

    function modelInstance($model)
    {
        $model = ucfirst($model);

        if(file_exists(MODELS.DS.$model.'.php')){

            require_once MODELS.DS.$model.'.php';

            return new $model->getInstance();
        }
        else{

            die($model . 'MODEL NOT FOUND');
        }
    }

    function auth($key = null)
    {
        $auth = Session::get('auth');
        if(!$auth)
            return false;

        return is_null($key) ? $auth : $auth->$key;
    }

    function getRowObject($arrayObject , $property)
	{
		$arrayOfObjects = array();

		foreach($arrayObject as $key => $object)
		{
			$objectInstance = new stdClass();
			foreach($property as $prop)
			{
				$objectInstance->$prop = $object->$prop;
			}

			array_push($arrayOfObjects, $objectInstance);
		}

		return $arrayOfObjects;
	}

    function G_PickDataFromArray($datas , $collectTheseKeysOnly = [] , $returnType = 'object')
    {
        $retVal = [];

        foreach($datas as $data) {
            $retVal [] = G_FormatData($data, $collectTheseKeysOnly , $returnType);
        }

        return $retVal;
    }
    function G_FormatData( $data , $collectTheseKeysOnly = [] , $returnType = 'object' )
    {
        $retVal = [];
        $collectOnly = array_values($collectTheseKeysOnly);

        $isObject = is_object($data);

        foreach( $collectOnly as $key )
        {
            if( $isObject )
            {
                $retVal[$key] = $data->$key;
                
            }elseif(is_array($data)) {
                $retVal[$key] = $data[$key];
            }
        }

        if( isEqual($returnType , 'object') )
            return json_decode(json_encode($retVal));

        return $retVal;
    }


    function stringHourAndMinsToMinutes($hourString)
    {
        $hourAndMin = explode(':' , $hourString);

        return hoursMinsToMinutes(current($hourAndMin) , end($hourAndMin));
    }

    function logger($type, $message, $category, $userId) {
        $systemLogModel = model('SystemLogModel');
        return $systemLogModel->store([
            'log_type' => $type,
            'log_text' => $message,
            'user_id ' => $userId,
            'updated_by' => whoIs()['id'],
            'log_category' => $category
        ]);
    }

    function sumNumbers($numbers = []) {
        $retVal = 0;

        foreach($numbers as $row) {
            $retVal += $numbers;
        }

        return $retVal;
    }