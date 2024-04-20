<?= $this->extend('backend/admin-layouts'); ?>
<?= $this->section('content'); ?>

				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Employee Leave Details</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?= base_url().'admindashboard/'?>">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Employee Leave Details
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<div class="card">
                            <div class="card-body">
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-center">
                                            
                                            <tbody>

                                           
                                           

                                                <tr>

                                                <td ><b>Employee ID:</b></td>
                                              <td colspan="1">Sec12</td>
                                            <td> <b>Employee Name:</b></td>
                                              <td><?= $leave['name']?></td>

                                              <td ><b>Gender :</b></td>
                                              <td colspan="1">Male</td>
                                          </tr>

                                          <tr>
                                             <td ><b>Employee Email:</b></td>
                                            <td colspan="1">email.com</td>
                                             <td ><b>Employee Contact:</b></td>
                                            <td colspan="1">1234567890</td>

                                            <td ><b>Leave Type:</b></td>
                                            <td colspan="1"><?= $leave['leave_type']?></td>
                                            
                                        </tr>

                                    <tr>
                                             
                                             <td ><b>Leave From:</b></td>
                                            <td colspan="1"><?= date('l d M Y', strtotime($leave['start_date']))?></td>
                                            <td><b>Leave Upto:</b></td>
                                            <td colspan="1"><?= date('l d M Y', strtotime($leave['end_date']))?></td>
                                            
                                        </tr>

                                    

                                <tr>
                                <td ><b>Leave Applied:</b></td>
                                <td>2024/4/16</td>

                                <td ><b>Status:</b></td>
                                <td>
                                    <?php if($leave['status'] == 'pending...'): ?>
                                        <p class="text-info"><?= strtoupper($leave['status'])?></p>
                                    <?php elseif($leave['status'] == 'Approved'): ?>
                                        <p class="text-success">
                                            <?= strtoupper($leave['status'])?>
                                            <i class="icon-copy bi bi-check-square-fill"></i>
                                        </p>
                                    <?php else: ?>
                                        <p class="text-danger">
                                            <?= strtoupper($leave['status'])?>
                                            <i class="icon-copy bi bi-x-octagon-fill"></i>
                                        </p>
                                    <?php endif;?>
                                </td>

                                    
                                </tr>

                                <tr>
                                     <td ><b>Leave Conditions: </b></td>
                                     <td colspan="5"><?= $leave['reason']?></td>
                                          
                                </tr>

                                <tr>
                                    <td ><b>Admin Remark: </b></td>
                                    <td colspan="12">
                                        <?php if($leave['admin_remark'] == ""): ?>
                                            <p class="text-danger">
                                                <?= "Waiting for Admin's remarks"?>
                                            </p>
                                        <?php else:?>
                                            <?= $leave['admin_remark']?>
                                        <?php endif;?>

                                    </td>
                                </tr>

                                <tr>
                                <td ><b>Admin Action On: </b></td>
                                    <td>
                                        <?php if(empty($leave['remark_date'])): ?>
                                            <?= 'N/A'?>
                                        <?php else: ?>
                                            <?= $leave['remark_date']?>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                
                               
                            <?php if($leave['status'] == 'pending...'): ?>
                                <tr>
                                <td colspan="12">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">SET ACTION</button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">SET ACTION</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?= form_open() ?>

                                    <?php if(isset($validation)): ?>
                                        <div class="alert alert-danger">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    <?php endif;?>

                                    <div class="modal-body">
                                    
                                        <select class="custom-select" name="status" >
                                            <option value="">Choose...</option>
                                            <option value="Approved">Approve</option>
                                            <option value="Declined">Decline</option>
                                        </select></p>
                                        <br>
                                        <p><textarea id="textarea1" name="description" class="form-control" name="description" placeholder="Description" row="5" maxlength="500" required></textarea></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="update" id="submitModal">Apply</button>
                                        
                                    </div>
                                    </div>
                                </div>
                                </div>

                                </td>
                            </tr>
                            <?php endif;?>

                            
                
                            <?= form_close() ?>
                             </tr>
                                        
                                    </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
					


    
<?= $this->endSection(); ?>