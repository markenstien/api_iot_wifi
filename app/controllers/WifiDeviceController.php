<?php
    use Form\WifiDeviceForm;
    load(['WifiDeviceForm'], FORMS);

    class WifiDeviceController extends Controller
    {
        public $wifiDeviceForm;
        public $wifiDeviceModel;
        public function __construct()
        {
            parent::__construct();
            $this->wifiDeviceModel = model('WifiDeviceModel');
            $this->wifiDeviceForm = new WifiDeviceForm();
            $this->data['wifiDeviceForm'] = $this->wifiDeviceForm;
        }

        public function index() {
            $this->data['wifi_devices'] = $this->wifiDeviceModel->all();
            return $this->view('wifi_device/index', $this->data);
        }

        public function create() {
            if(isSubmitted()) {
                $post = request()->post();
                $resp = $this->wifiDeviceModel->add($post);
                $message = $this->wifiDeviceModel->getMessageString();

                if(!$resp) {
                    Flash::set($message, 'danger');
                    return request()->return();
                } else {
                    Flash::set($message);
                    return redirect(_route('wifi:index'));
                }
            }
            return $this->view('wifi_device/create', $this->data);
        }

        public function edit($id) {
            if(isSubmitted()) {
                $post = request()->post();

                if(isset($post['change_ssid'])) {
                    $resp = $this->wifiDeviceModel->changeSSID($post['wifi_ssid'], $post['id']);
                }

                if(isset($post['change_password'])) {
                    $resp = $this->wifiDeviceModel->changePassword($post['wifi_password'], $post['id']);
                }
                
                $message = $this->wifiDeviceModel->getMessageString();

                if(!$resp) {
                    Flash::set($message, 'danger');
                    return request()->return();
                } else {
                    Flash::set("Device updated");
                    return redirect(_route('wifi:index'));
                }
            }

            $wifiDevice = $this->wifiDeviceModel->get([
                'id' => $id
            ]); 

            $this->data['wifi_device'] = $wifiDevice;

            $this->wifiDeviceForm->setValue('wifi_ssid', $wifiDevice->wifi_ssid);
            $this->wifiDeviceForm->addId($wifiDevice->id);

            $this->data['wifiDeviceForm'] = $this->wifiDeviceForm;

            return $this->view('wifi_device/edit', $this->data);
        }
    }