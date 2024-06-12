<?php
    namespace Form;
    
    use Core\Form;
    
    load(['Form'], CORE);

    class WifiDeviceForm extends Form {

        public function __construct()
        {
            parent::__construct();

            $this->addSSID();
            $this->addPassword();
        }
        public function addSSID() {
            $this->add([
                'type' => 'text',
                'name' => 'wifi_ssid',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'WIFI SSID'
                ]
            ]);
        }

        public function addPassword() {
            $this->add([
                'type' => 'text',
                'name' => 'wifi_password',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'WIFI Password'
                ]
            ]);
        }
    }