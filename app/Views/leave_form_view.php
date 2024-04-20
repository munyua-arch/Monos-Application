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
                        <div class="alert alert-danger">
                                <?php if(isset($validation)):?>
                                    <?= $validation->listErrors(); ?>
                                <?php endif;?>
                            </div>
                        <!-- Display invalid form errors -->
                                    
                    <?php if($page_session->setTempdata('request_success')):?>
                        <div class="alert alert-success">
                        <?= $page_session->getTempdata('request_success')?>
                        </div>
                    <?php endif;?>

                    <?php if($page_session->setTempdata('request_error')):?>
                        <div class="alert alert-danger">
                        <?= $page_session->getTempdata('request_error')?>
                        </div>
                    <?php endif;?>

						<?= form_open() ?>
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" name="name" value="<?= set_value('name')?>">
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