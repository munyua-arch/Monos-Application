<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>

<?= $this->extend('layouts\base'); ?>
<?= $this->section('content'); ?>

<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>


<?= $this->extend('layouts/base')?>
<?= $this->section('content')?>

    <div class="d-flex justify-content-center mt-3">
        <div class="col-md-6 col-lg-5">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
					<h2 class="text-center text-primary">Enter your new password and submit</h2>
				</div>

            <?php if(isset($validation)):?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors()?>
                </div>
            <?php endif;?>

            <?php if($page_session->getTempdata('adminreset_success')):?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?= $page_session->getTempdata('adminreset_success')?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif;?>

			<?php if($page_session->getTempdata('adminreset_error')):?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $page_session->getTempdata('adminreset_error')?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif;?>

                <?= form_open()?>

                    <div class="input-group custom">
                        <input type="password" name="password" placeholder="New Password" class="form-control">
                        <div class="input-group-append custom">
							<span class="input-group-text"><i class="icon-copy dw dw-padlock1"></i></span>
						</div>
                    </div>

                    <div class="input-group custom">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                        <div class="input-group-append custom">
							<span class="input-group-text"><i class="icon-copy dw dw-checked"></i></span>
						</div>
                    </div>
                   
                    <input type="submit" class="btn btn-block btn-primary" value="Submit">
                <?= form_close()?>
            </div>
        </div>
    </div>
<?= $this->endSection()?>

<?= $this->endSection(); ?>