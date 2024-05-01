<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>

<?= $this->extend('backend\admin-layouts'); ?>
<?= $this->section('content'); ?>

<section>

                    <div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>HOD Section</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/'?>">Home</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/admins'?>">Head Of Departments</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                New HOD
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
					</div>

    <!-- horizontal Basic Forms Start -->
    <div class="pd-20 card-box mb-30">
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Create New HOD </h4>
								<p class="mb-30">Please fill the form below to add a new HOD</p>
							</div>
						</div>

                        <!-- Display invalid form errors -->
                            
                                <?php if(isset($validation)):?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= $validation->listErrors(); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif;?>
                        <!-- Display invalid form errors -->

                        
                        <?php if($page_session->has('admin_success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $page_session->get('admin_success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif;?>

                        <?php if($page_session->has('admin_error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $page_session->get('admin_error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif;?>


						<?= form_open();?>
                            <div class="form-floating mb-3">
                                <input type="text" name="full_name" class="form-control" id="floatingInput" placeholder="Full Name" value="<?= set_value('full_name')?>">
                                <label for="floatingInput">Full Name</label>
                                    
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email" value="<?= set_value('email')?>">
                                <label for="floatingInput">Email</label>     
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" name="phone" class="form-control" id="floatingInput" placeholder="Phone" value="<?= set_value('phone')?>">
                                <label for="floatingInput">Phone</label>     
                            </div>

                            <h4 class="lead fw-bold mb-3">Setting Passwords</h4>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="******">
                                <label for="floatingInput">Password</label>
                                    
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="confirm_password" class="form-control" id="floatingInput" placeholder="******">
                                <label for="floatingInput">Confirm Password</label>
                                    
                            </div>
                                
                        
                                

                            <input type="submit" name="submit" value="Create New HOD" class="btn btn-lg btn-primary">  
						
						<?= form_close();?>

                       

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
</section>

<?= $this->endSection(); ?>