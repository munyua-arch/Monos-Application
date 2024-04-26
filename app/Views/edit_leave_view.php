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
                                        <h4>Leave Section</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/'?>">Home</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/leave-types'?>">Leaves</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Update Leave Info
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
								<h4 class="text-blue h4">Update Leave Info</h4>
								<p class="mb-30">Please fill the form below to update leave type</p>
							</div>
						</div>

                        <!-- Display invalid form errors -->
                        
                                <?php if(isset($validation)):?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <?= $validation->listErrors(); ?>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" role="Close"></button>
                                    </div>
                                <?php endif;?>
                            
                        <!-- Display invalid form errors -->


                        <?php if($page_session->has('leaveupdate_success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $page_session->get('leaveupdate_success') ?>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" role="Close"></button>
                            </div>
                        <?php endif;?>

                        <?php if($page_session->has('leaveupdate_error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $page_session->get('leaveupdate_error') ?>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" role="Close"></button>
                            </div>
                        <?php endif;?>

						<?= form_open();?>
                            
                                <div class="form-floating mb-3">
                                    <input type="text" name="leave_type" class="form-control" id="floatingInput" placeholder="Leave Type" value="<?= $leaveinfo['leave_type']?>">
                                    <label for="floatingInput">Leave Type</label>
                                    
                                </div>
                          
                            
                                <div class="form-group">
								<label>Description</label>
								<textarea class="form-control" name="description" placeholder="e.g Sick leave offers staff member chance to recover their health" value="<?= $leaveinfo['description'] ?>"></textarea>
							</div>
                          
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Leave Type</button>
                            </div>
						
						<?= form_close();?>

                        

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
</section>

<?= $this->endSection(); ?>