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
                                        <h4>Department Section</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/'?>">Home</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/departments'?>">Departments</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Update Department
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
								<h4 class="text-blue h4">Edit Department</h4>
								<p class="mb-30">Please fill the form below to update department</p>
							</div>
						</div>

                        <!-- Display invalid form errors -->
                       
                                <?php if(isset($validation)):?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= $validation->listErrors(); ?>
                                        <button class="btn-close" type="button" data-bs-dimiss="alert" role="Close"></button>
                                    </div>
                                <?php endif;?>
                            
                        <!-- Display invalid form errors -->


                        <?php if($page_session->has('deptupdate_success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $page_session->get('deptupdate_success') ?>
                                <button class="btn-close" type="button" data-bs-dimiss="alert" role="Close"></button>
                            </div>
                        <?php endif;?>

                        <?php if($page_session->has('deptupdate_error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $page_session->get('deptupdate_error') ?>
                                <button class="btn-close" type="button" data-bs-dimiss="alert" role="Close"></button>
                            </div>
                        <?php endif;?>

						<?= form_open();?>
                            
                                <div class="form-floating mb-3">
                                    <input type="text" name="department" class="form-control" id="floatingInput" placeholder="department" value="<?= $deptdata['department']?>">
                                    <label for="floatingInput">Department</label>
                                    
                                </div>
                          
                            
                                <div class="form-floating mb-3">
                                    <input type="text" name="shortform" class="form-control" id="floatingInput" placeholder="shortform" value="<?= $deptdata['shortform']?>">
                                    <label for="floatingInput">Shortform</label>
                                    
                                </div>
                            
                            
                                <div class="form-floating mb-3">
                                    <input type="text" name="HOD" class="form-control" id="floatingInput" placeholder="HOD" value="<?= $deptdata['HOD']?>">
                                    <label for="floatingInput">Head Of Department</label>
                                    
                                </div>
                          
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create New Department</button>
                                </div>
						
						<?= form_close();?>

                        

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
</section>

<?= $this->endSection(); ?>