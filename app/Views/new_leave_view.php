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
                                                New Leave
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
								<h4 class="text-blue h4">New Leave Type</h4>
								<p class="mb-30">Please fill the form below to add a new leave type</p>
							</div>
						</div>

                        <!-- Display invalid form errors -->
                        <div class="alert alert-danger">
                                <?php if(isset($validation)):?>
                                    <?= $validation->listErrors(); ?>
                                <?php endif;?>
                            </div>
                        <!-- Display invalid form errors -->


                        <?php if($page_session->has('leave_success')): ?>
                            <div class="alert alert-success">
                                <?= $page_session->get('leave_success') ?>
                            </div>
                        <?php endif;?>

                        <?php if($page_session->has('leave_error')): ?>
                            <div class="alert alert-danger">
                                <?= $page_session->get('leave_error') ?>
                            </div>
                        <?php endif;?>

						<?= form_open();?>
                            
                                <div class="form-floating mb-3">
                                    <input type="text" name="leave_type" class="form-control" id="floatingInput" placeholder="department" value="<?= set_value('leave')?>">
                                    <label for="floatingInput">Leave Type</label>
                                    
                                </div>
                          
                            
                                <div class="form-group">
								<label>Description</label>
								<textarea class="form-control" name="description" placeholder="e.g Sick leave offers staff member chance to recover their health" value="<?= set_value('description') ?>"></textarea>
							</div>
                          
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Create New Leave Type</button>
                            </div>
						
						<?= form_close();?>

                        

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
</section>

<?= $this->endSection(); ?>