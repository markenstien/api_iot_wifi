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
                    <?php echo $wifiDeviceForm->start()?>
                        <?php echo $wifiDeviceForm->getId()?>
                        <?php echo $wifiDeviceForm->getRow('wifi_ssid')?>
                        <input type="submit" class="btn btn-primary btn-sm" value="Change SSID" name="change_ssid">
                    <?php echo $wifiDeviceForm->end()?>
                    <?php echo wDivider(50)?>
                    <?php echo $wifiDeviceForm->start()?>
                        <?php echo $wifiDeviceForm->getId()?>
                        <?php echo $wifiDeviceForm->getRow('wifi_password')?>
                        <input type="submit" class="btn btn-primary btn-sm" value="Change Password" name="change_password">
                    <?php echo $wifiDeviceForm->end()?>

                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/admin_layout')?>