<?php build('content') ?>
    <div class="container-fluid">
        <?php 
            echo wControlButtonRight('Device Access', [
                $navigationHelper->setNav('', 'Add Access', _route('user-wifi-access:create'))
            ])
        ?>
        <div class="card">
            <?php echo wCardHeader(wCardTitle('Access list'))?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <th>#</th>
                            <th>Wifi SSID</th>
                            <th>User</th>
                            <th>Access Given</th>
                        </thead>

                        <tbody>
                            <?php foreach($user_wifi_access as $key => $row) :?>
                                <tr>
                                    <td><?php echo ++$key?></td>
                                    <td><?php echo $row->wifi_ssid?></td>
                                    <td><?php echo $row->email?></td>
                                    <td><?php echo $row->access_date?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>