<?php

    use Form\UserForm;
    use Form\WifiDeviceForm;
    load(['UserForm', 'WifiDeviceForm'], FORMS);

    class UserWifiAccessController extends Controller
    {
        public $userForm, $wifiDeviceForm;
        public $model, $wifiDeviceModel;

        public function __construct()
        {
            parent::__construct();

            $this->model = model('UserWifiAccessModel');
            $this->wifiDeviceModel = model('WifiDeviceModel');
            $this->userForm = new UserForm();
            $this->wifiDeviceForm = new WifiDeviceForm();
            $this->data['userForm'] = $this->userForm;
            $this->data['wifiDeviceForm'] = $this->wifiDeviceForm;

        }

        public function index() {
            $this->data['user_wifi_access'] = $this->model->getAll();
            return $this->view('user_wifi_access/index', $this->data); 
        }

        public function create() {
            if(isSubmitted()) {
                $post = request()->post();
                $resp = $this->model->addAccess($post);

                $message = $this->model->getMessageString();

                if(!$resp) {
                    Flash::set($message, 'danger');
                    return request()->return();
                } else {
                    Flash::set($message);
                    return redirect(_route('user-wifi-access:index'));
                }
            }
            $this->addWifiDevicesField();
            return $this->view('user_wifi_access/create', $this->data);
        }

        public function show() {

        }

        public function edit() {

        }
        
        private function addWifiDevicesField() {
            $wifiSsidLabel = $this->wifiDeviceForm->getLabel('wifi_ssid');
            $wifiDevices = $this->wifiDeviceModel->all();

            $wifiDevicesArray = arr_layout_keypair($wifiDevices, ['id', 'wifi_ssid']);

            $this->wifiDeviceForm->add([
                'type' => 'select',
                'name' => 'wifi_ssid',
                'options' => [
                    'label' => $wifiSsidLabel,
                    'option_values' => $wifiDevicesArray,
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }
    }