<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>


<?= $this->extend('layouts/base')?>
<?= $this->section('content')?>

    <div class="d-flex justify-content-center mt-3">
        <div class="col-md-6 col-lg-5">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
					<h2 class="text-center text-primary">Admin Password Reset</h2>
					<h4 class="text-center text-primary mt-3">Enter email </h4>
				</div>

                <?php if(isset($validation)):?>
                    <div class="alert alert-danger alert-dismissble fade show" role="alert">
                        <?= $validation->listErrors()?>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" role="Close "></button>
                    </div>
                <?php endif;?>

                <?php if(isset($error)):?>
                    <div class="alert alert-danger alert-dismissble fade show" role="alert">
                        <?= $error?>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" role="Close "></button>
                    </div>
                <?php endif;?>

                <?php if($page_session->getTempdata('admin_reset_success')):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $page_session->getTempdata('admin_reset_success')?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif;?>

                <?php if($page_session->getTempdata('admin_reset_error')):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $page_session->getTempdata('admin_reset_error')?>
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
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
                    </div>

                   
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<input type="submit" value="Sign In" class="btn btn-primary btn-block">
										</div>
                                    </div>
                                </div>
										
                <?= form_close()?>
            </div>
        </div>
    </div>
<?= $this->endSection()?>