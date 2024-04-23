<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>

<?= $this->extend('backend/page-layouts'); ?>
<?= $this->section('content'); ?>

<section>

<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Employee Change Password</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?= base_url().'dashboard/'?>">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Change Password
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

   

        <?php if($page_session->getTempdata('password_success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $page_session->getTempdata('password_success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>


        <?php if($page_session->getTempdata('password_error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $page_session->getTempdata('password_error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        

         <!-- horizontal Basic Forms Start -->
    <div class="pd-20 card-box mb-30">
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Change Password</h4>
								<p class="mb-30">Please fill the form below to update your password</p>
							</div>
						</div>

                       
                <?php if(isset($validation)):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $validation->listErrors()?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
			    <?php endif;?>

            <?= form_open(); ?>

                <div class="form-floating mb-3">
                    <input type="password" name="old_password" class="form-control" id="floatingInput" placeholder="old password" value="<?= set_value('old_password')?>">
                    <label for="floatingInput">Old password</label>
                
                
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="new_password" class="form-control" id="floatingInput" placeholder="new password" value="<?= set_value('new_password')?>">
                    <label for="floatingInput">New password</label>    
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="confirm_password" class="form-control" id="floatingInput" placeholder="Confirm password" value="<?= set_value('confirm_password')?>">
                    <label for="floatingInput">Confirm password</label>    
                </div>

                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block mt-3">
            <?= form_close(); ?>

                       

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
    </div>
</section>

<?= $this->endSection(); ?>