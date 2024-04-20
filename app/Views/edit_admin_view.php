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
                                        <h4>Edit Admin</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/'?>">Home</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/admins'?>">HOD'S</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Edit HOD
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
								<h4 class="text-blue h4">Edit HOD </h4>
								<p class="mb-30">Please fill the form below to update HOD info</p>
							</div>
						</div>

                        <!-- Display invalid form errors -->
                           
                                <?php if(isset($validation)):?>
                                    <div class="alert alert-danger">
                                        <?= $validation->listErrors(); ?>
                                    </div>
                                <?php endif;?>
                            
                        <!-- Display invalid form errors -->

                        
                        <?php if($page_session->has('create_success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $page_session->get('create_success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif;?>

                        <?php if($page_session->has('create_error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $page_session->get('create_error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif;?>


						<?= form_open();?>
                        
                        <div class="form-floating mb-3">
                            <input type="text" name="full_name" class="form-control" id="floatingInput" placeholder="First Nam" value="<?= $editadmin['full_name']?>">
                            <label for="floatingInput">Full Name</label>
                                    
                        </div>
                        

                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput"  placeholder="name@email.com" value="<?= $editadmin['email']?>">
                                <label for="floatingInput">Email</label>
                                    
                        </div>
                       
                               
                        <div class="form-floating mb-3">
                            <input type="tel" name="phone" class="form-control" id="floatingInput"  placeholder="name@email.com" value="0740289746">
                            <label for="floatingInput">Phone Number</label>
                                    
                        </div>
                        
           
                        <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="department">
                                    <option selected>Department</option>
                                    <option value="IT">IT</option>
                                    <option value="Finance">Finance</option>
                                    
                                </select>
                                   
                                </div>
                                

                            <input type="submit" name="submit" value="Update Info" class="btn btn-lg btn-primary">  
						
						<?= form_close();?>

                       

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
</section>

<?= $this->endSection(); ?>