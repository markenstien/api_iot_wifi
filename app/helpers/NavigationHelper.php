<?php 

    class NavigationHelper{
        
        public $navs = [];

        public function __construct()
        {
            // $this->moduleRestrict();
            $this->loadNavs();
        }

        public function getNavsHTML() {
            $navs = $this->navs;
            $retValHTML = '';
            if(!empty($navs)) {
                foreach($navs as $navGroupName => $navGroups) {
                    $retValHTML .= "<div class='sidebar-heading'>{$navGroupName}</div>";
                    foreach($navGroups as $navItem) {
                        $attributes = $navItem['attributes'];
                        $icon = empty($attributes['icon']) ? 'fas fa-fw fa-tachometer-alt': $attributes['icon'];
                        $retValHTML .= "<li class='nav-item'>
                        <a class ='nav-link pb-0' href='{$navItem['url']}'>
                            <i class='{$icon}'></i>
                            <span>{$navItem['label']}</span>
                        </a>
                      </li>";
                    }

                    $retValHTML .= "<hr class='sidebar-divider mt-3'>";
                }
            }
            return $retValHTML;
        }
        

        public function loadNavs() {
            $whoIs = whoIs();

            if($whoIs) {
                $moduleGroup = $this->moduleGroup();
                foreach($moduleGroup as $modKey => $modRow) {
                    $modRowItems = $modRow['items'];
                    foreach($modRowItems as $itemKey => $itemVal) {
                        $regExp = explode('|', $itemVal);
                        $url = _route("{$regExp[0]}:{$regExp[1]}");
                        $icon = $regExp[3] ?? '';

                        $this->addNavigation($modKey, $regExp[2], $url, [
                            'icon' => $icon
                        ]);
                    }
                }
            }
        }

        private function moduleRestrict() {
            $whoIs = whoIs();

            if($whoIs) {
                $userTypeAccess = $this->userModuleAccess();
                $modelGroup = $this->moduleGroup();

                if($userAccess = $userTypeAccess[strtolower($whoIs['type'])]) {
                    foreach($userAccess as $key => $row) {
                        foreach($modelGroup as $modKey => $modRow) {
                            $modRowItems = $modRow['items'];
                            foreach($modRowItems as $itemKey => $itemVal) {
                                $regExp = explode('|', $itemVal);
                                $url = _route("{$regExp[0]}:{$regExp[1]}");
                                $icon = $regExp[3] ?? '';

                                if(isEqual($key, $regExp[0])) {
                                    $this->addNavigation($modKey, $regExp[2], $url, [
                                        'icon' => $icon
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }


        public function userModuleAccess() {
            $access = [
                'admin' => [
                    'dashboard' => '*',
                    'user' => '*',
                    'attendance' => '*',
                    'position' => '*',
                    'department' => '*',
                    'admin-shift' => '*',
                    'report' => '*'
                ],

                'super-admin' => [
                    'dashboard' => '*',
                    'user' => 'view',
                    'attendance' => '*',
                    'position' => 'view',
                    'department' => 'view',
                    'admin-shift' => 'view',
                    'report' => '*'
                ],
                
                
                'manager' => [
                    'dashboard' => '*',
                    'user' => 'view',
                    'attendance' => '*',
                    'position' => 'view',
                    'department' => 'view',
                    'admin-shift' => 'view',
                    'payroll' => 'view'
                ],

                'payroll' => [
                    'dashboard' => '*',
                    'payroll' => '*',
                    'deduction' => '*',
                ],

                'hr' => [
                    'dashboard' => '*',
                    'leave' => '*',
                    'leave-point' => '*',
                    'attendance' => '*',
                    'holiday'    => '*',
                    'recruitment' => '*',
                    'user' => '*',
                    'report' => '*'
                ],

                'regular_employee' => [
                    'dashboard' => '*',
                    'payslip' => '*',
                    'attendance' => '*',
                    'leave' => '*'
                ],
            ];

            return $access;
        }

        public function moduleGroup() {
            return [
                'main' => [
                    'label' => 'Main',
                    'items' => [
                        'user|index|User',
                        'wifi|index|WIFI Devices',
                        'user-wifi-access|index|Wifi Access'
                    ]
                ],
            ];
        }


        public function addNavigationBulk($menu, $navigations) {
            foreach($navigations as $key => $row) {
                $this->addNavigation($menu, $row[0], $row[1], $row[2] ?? []);
            }
        }

        public function addNavigation($menu, $label, $url, $attributes = []) {
            if(!isset($this->navs[$menu])) {
                $this->navs[$menu] = [];
            }
            $this->navs[$menu][]= $this->setNav($menu, $label, $url, $attributes);
        }

        public function setNav($menu, $label, $url, $attributes = []) {
            return [
                'label' => $label,
                'url'   => $url,
                'attributes' => $attributes,
                'menu'  => $menu
            ];
        }
    }