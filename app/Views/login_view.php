<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>


<?= $this->extend('layouts/base')?>
<?= $this->section('content')?>

    <div class="d-flex justify-content-center mt-3">
        <div class="col-md-6 col-lg-5">
            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
					<h2 class="text-center text-primary">MONOS APPLICATION</h2>
					<h4 class="text-center text-primary mt-3">Customer Login</h4>
				</div>

            <?php if(isset($validation)):?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors()?>
                </div>
            <?php endif;?>

			<?php if($page_session->getTempdata('login_error')):?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $page_session->getTempdata('login_error')?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif;?>

                <?= form_open()?>
                    <div class="input-group custom">
                        <input type="email" name="email" placeholder="Email" class="form-control" value="<?= set_value('email')?>">
                        <div class="input-group-append custom">
							<span class="input-group-text"><i class="icon-copy dw dw-email-1"></i></span>
						</div>
                    </div>
                    <div class="input-group custom">
                        <input type="password" name="password" placeholder="*****" class="form-control">
                        <div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
                    </div>

                    <div class="row pb-30">
									<div class="col-6">
										
									</div>
									<div class="col-6">
										<div class="forgot-password">
											<a href="<?= base_url().'login/forgot-password'?>">Forgot Password</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<input type="submit" value="Sign In" class="btn btn-primary btn-block">
										</div>
										<div
											class="font-16 weight-600 pt-10 pb-10 text-center"
											data-color="#707373"
										>
											OR
										</div>
										<div class="select-role">
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
										<label class="btn active">
											<input type="radio" name="options" id="admin" />
											<div class="icon">
												<img
													src="public/backend/vendors/images/briefcase.svg"
													class="svg"
													alt=""
												/>
											</div>
											<a href="<?= base_url(). 'admin-login'?>">
												
												<span class="text-primary fw-bold">MONOS ADMIN</span>
											</a>
										</label>
									</div>
								</div>	
                <?= form_close()?>
            </div>
        </div>
    </div>
<?= $this->endSection()?>