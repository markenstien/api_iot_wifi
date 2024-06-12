<?php build('content') ?>
    <div class="container-fluid">
        <?php echo wControlButtonRight('', [
            $navigationHelper->setNav('', 'Wifi Devices', _route('wifi:index'), [
                'icon' => 'fa fa-list'
            ])
        ])?>
        <div class="col-md-4">
            <div class="card">
                <?php echo wCardHeader('Add New Wifi Device')?>
                <div class="card-body">
                    <?php Flash::show()?>
                    <?php echo $wifiDeviceForm->start()?>
                        <?php echo $wifiDeviceForm->getRow('wifi_ssid')?>
                        <?php echo $wifiDeviceForm->getRow('wifi_password')?>

                        <input type="submit" class="btn btn-primary btn-sm" value="Add Device">
                    <?php echo $wifiDeviceForm->end()?>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/admin_layout')?>