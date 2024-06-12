<?php build('content') ?>
    <div class="container-fluid">
        <?php echo wControlButtonRight('User Management', [
            $navigationHelper->setNav('', 'Add', _route('user:create'))
        ])?>
        <div class="card">
            <?php echo wCardHeader(wCardTitle('Users'))?>
            <div class="card-body">
                <?php Flash::show()?>
                <div class='table-responsive'>
                    <table class='table table-bordered' id="dataTable">
                        <thead>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php $counter = 0?>
                            <?php foreach($users as $key => $user) :?> 
                                <tr>
                                    <td><?php echo ++$counter?></td>
                                    <td><?php echo $user->user_key?></td>
                                    <td><?php echo $user->fullname?></td>
                                    <td><?php echo $user->email?></td>
                                    <td><?php echo $user->user_type?></td>
                                    <td>
                                        <a href="<?php echo _route('user:show', $user->id)?>">Show</a>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/admin_layout')?>