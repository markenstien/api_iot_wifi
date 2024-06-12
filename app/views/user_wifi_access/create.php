<?php build('content') ?>
    <div class="container-fluid">
        <?php 
            echo wControlButtonRight('Device Access', [
                $navigationHelper->setNav('', 'Access list', _route('user-wifi-access:index'))
            ])
        ?>
        <div class="col-md-5">
            <div class="card">
                <?php echo wCardHeader(wCardTitle('Add User Wifi Access'))?>
                <div class="card-body">
                    <form action="" method="post">
                        <?php Flash::show()?>
                        <div class="form-group">
                            <?php echo $userForm->getRow('email')?>
                            <?php echo $wifiDeviceForm->getRow('wifi_ssid')?>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-sm" value="Add User">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>