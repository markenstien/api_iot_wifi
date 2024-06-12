<?php build('content') ?>
    <div class="container-fluid">
        <?php echo wControlButtonLeft('User Management', [
            $navigationHelper->setnav('', 'Back', _route('user:index'))
        ])?>
        <div class="col-md-4 mx-auto">
            <div class="card">
                <?php echo wCardHeader(wCardTitle('Add User'))?>
                <div class="card-body">
                    <?php Flash::show()?>
                    <?php echo $form->start()?>
                    <div class="form-group">
                        <?php echo $form->getCol('user_type')?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getCol('fullname')?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getCol('email')?>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-sm" value="Save Employee">
                    </div>
                    <?php echo $form->end()?>
                </div>
            </div>
        </div>
    </div>

<?php endbuild()?>

<?php loadTo('tmp/admin_layout')?>
