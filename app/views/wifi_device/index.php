<?php build('content') ?>
    <div class="container-fluid">
        <?php echo wControlButtonRight('', [
            $navigationHelper->setNav('', 'Add', _route('wifi:create'))
        ])?>
        <div class="col-md-8">
            <div class="card">
                <?php echo wCardHeader('Add New Wifi Device')?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>#</th>
                                <th>WIFI SSID</th>
                                <th>WIFI PASSWORD</th>
                                <th>IS ACTIVE</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                <?php foreach($wifi_devices as $key => $row) :?>
                                    <tr>
                                        <td><?php echo ++$key?></td>
                                        <td><?php echo $row->wifi_ssid?></td>
                                        <td><span class="badge badge-primary show-password" 
                                            style="cursor: pointer;"
                                            data-text="<?php echo $row->wifi_password?>"
                                            data-target="<?php echo $row->wifi_ssid?>"> show </span> 
                                            <span class="password" id="<?php echo $row->wifi_ssid?>"></span>
                                        </td>
                                        <td><?php echo $row->is_active?></td>
                                        <td><?php echo wLinkDefault(_route('wifi:edit', $row->id))?></td>
                                    </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts') ?>
    <script>
        $(document).ready(function(){
            $('.show-password').click(function(event){
                let target = $(this).data('target');
                let passwordText = $(this).data('text');

                $('#' + target).text(passwordText);
            });
        });
    </script>
<?php endbuild()?>
<?php loadTo('tmp/admin_layout')?>