<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>

<?= $this->extend('backend\page-layouts'); ?>
<?= $this->section('content'); ?>

<section>

					<div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Leave Form</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'dashboard/'?>">Home</a>
                                            </li>
                                           
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Leave Form
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
								<h4 class="text-blue h4">Employee Leave Form</h4>
								<p class="mb-30">Please fill the form below</p>
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
                                    
                    <?php if($page_session->has('request_success')):?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $page_session->get('request_success')?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif;?>

                    <?php if($page_session->has('request_error')):?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $page_session->get('request_error')?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif;?>

						<?= form_open() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= set_value('name')?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= set_value('email')?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Employee ID</label>
                                    <input type="text" class="form-control" name="employee_id" value="<?= set_value('employee_id')?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone NO</label>
                                    <input type="telephone" class="form-control" name="phone" value="<?= set_value('phone')?>">
                                </div>
                            </div>
                        </div>
                            
                        <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="gender">
                                    <option selected>Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                   
                                </div>
                            
                            
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="<?= set_value('start_date')?>">
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="end_date" value="<?= set_value('end_date')?>">
                            </div>

                            <div class="form-group">
                                <label>Choose Leave Type</label>
                            <select class="form-select" aria-label="Default select example" name="leave_type" value="<?= set_value('leave_type')?>">
                                    <option selected>Leave Type</option>
                                    <option value="Sick">Sick</option>
                                    <option value="Study">Study</option>
                                    <option value="Casual leave">Casual Leave</option>
                                    <option value="Medical Leave">Medical Leave</option>
                                    <option value="Paternity Leave">Paternity Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                    <option value="Religious Holiday">Religious Holiday</option>
                                    <option value="Personal Time Off">Personal Time Off</option>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Reason</label>
                                <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <input type="submit" value="Request Leave" class="btn btn-primary btn-lg">

                        <?= form_close() ?>

                       

							</div>
						</div>
					</div>
					<!-- horizontal Basic Forms End -->
</section>

<?= $this->endSection(); ?>