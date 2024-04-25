<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>

<?= $this->extend('backend/admin-layouts'); ?>
<?= $this->section('content'); ?>

				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Employee Section</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?= base_url().'admindashboard/'?>">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Employees
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<?php if($page_session->has('delete_success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $page_session->get('delete_success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif;?>


					<!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">All Employees</h4>
							<div>
                                <a href="<?= base_url().'admindashboard/new-employee'?>" class="btn btn-lg btn-primary">
                                <i class="icon-copy bi bi-plus-lg"></i>
                                Add Employee
                                </a>
                            </div>
						</div>

						<div class="pb-20">

							<?php if(count($employees)): ?>
								<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">#</th>
										<th>Full Name</th>
										<th>Email</th>
										<th>Employee ID</th>
										<th>Gender</th>
										<th>Phone Number</th>
										<th>DOB</th>
										<th>Department</th>
										<th>Created On</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php foreach($employees as $emp): ?>
									<tr>
										<td class="table-plus"><?= $emp['id']?></td>
										<td><?= $emp['first_name'] ." ". $emp['last_name'] ?></td>
										<td><?= $emp['email']?></td>
										<td><?= $emp['employee_id']?></td>
										<td><?= $emp['gender']?></td>
										<td><?= $emp['phone']?></td>
										<td><?= $emp['dob']?></td>
										<td><?= $emp['department']?></td>
										<td><?= date('l d M Y h:i:s', strtotime($emp['created_at']))?></td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
												
													<a class="dropdown-item" href="<?= base_url().'admindashboard/edit-employee/' . $emp['id'] ?>"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="<?= base_url().'admindashboard/delete-employee/' . $emp['id']?>"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td> 
									</tr>
								<?php endforeach; ?>

								</tbody>
							</table>
							<?php endif;?>

							<!-- pager links -->
							<div class="d-flex">
								<?= $pager->links();?>
							</div>



						</div>
					</div>
					<!-- Simple Datatable End -->
					


    
<?= $this->endSection(); ?>