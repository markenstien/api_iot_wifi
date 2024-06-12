<?php build('content') ?>
    <div style="height:75px"></div>
        <div class="container">
            <div class="col-md-5 mx-auto mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1>IOT WIFI ADMIN</h1>
                            <h4>Welcome back!</h4>
                        </div>

                        <?php Flash::show() ?>
                        <?php
                            Form::open([
                                'method' => 'post',
                                'action' => _route('auth:submit-login')
                            ]); 
                        ?>
                            <div class="form-group">
                                <?php
                                    Form::label('Email');
                                    Form::text('email' , '' , [
                                        'class' => 'form-control',
                                        'required' => '',
                                    ]);
                                ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    Form::label('Password');
                                    Form::password('password' , '' , [
                                        'class' => 'form-control',
                                        'required' => '',
                                        'placeholder' => ''
                                    ]);
                                ?>
                            </div>
                            
                            <div class="form-group">
                                <?php
                                    Form::submit('' , 'Login' , [
                                        'class' => 'btn btn-primary'
                                    ]);
                                ?>
                            </div>

                        <?php Form::close()?>
                    </div>
                </div>
            </div>
        </div>

    <div id="stetch" style="height:300px;"></div>
<?php endbuild()?>

<?php build('scripts') ?>
    <script>
        setInterval(function(){
            window.location.reload(true); 
        }, (1000 * 3600) * 4);
    </script>
<?php endbuild()?>


<?php build('styles')?>
<style>
    span.highlight{
        background-color: #2f387b;
        padding-left: 2px;
        padding-right: 2px;
    }
    span.highlight a,
    span.highlight {
        color: #fff;
    }
</style>
<?php endbuild()?>
<?php loadTo('tmp/public_layout')?>