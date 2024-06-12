<?php build('content') ?>
    <div class="container-fluid">
        <?php echo wControlButtonLeft('User Management', [
            $navigationHelper->setNav('', 'Back', _route('user:index'))
        ])?>
        <div class="card">
            <?php echo wCardHeader(wCardTitle('User View'))?>
            <div class="card-body">
                <?php Flash::show()?>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo $user->profile_url?>" alt="" style="width: 150px;">
                        <section class="mt-3">
                            <table class="table table-bordered table-sm">
                                <tr><td>Access : <?php echo $user->user_type?></tr>
                                <tr><td>Name : <?php echo $user->fullname?> <span>(<?php echo $user->user_key?>)</span> </td></tr>
                                <tr><td>Email : <?php echo $user->email?></td></tr>
                                <?php if(isEqual(whoIs('id'), $user->id)) :?>
                                    <tr>
                                        <td>Username : <?php echo $user->username?> </td>
                                    </tr>
                                <?php endif?>
                            </table>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo('tmp/admin_layout')?>