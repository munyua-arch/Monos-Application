<?php

$page_session = \Config\Services::session();
?>

<?= $this->extend('backend/admin-layouts'); ?>
<?= $this->section('content'); ?>

				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Leave Types</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?= base_url().'admindashboard/'?>">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Leave types
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<?php if($page_session->getTempdata('leave_delete')):?>
						<div class="alert alert-success alert-dismiss fade show" role="alert">
							<?= $page_session->getTempdata('leave_delete')?>
							<button class="btn-close" type="button" data-bs-dismiss="alert" role="Close"></button>
						</div>
					<?php endif;?>

					<!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Leave Types</h4>
							<div>
                                <a href="<?= base_url().'admindashboard/new-leave'?>" class="btn btn-lg btn-primary">
                                <i class="icon-copy bi bi-plus-lg"></i>
                                Add Leave Type
                                </a>
                            </div>
						</div>
						<div class="pb-20">
							<?php if($leaves > 0): ?>
								<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">#</th>
										<th>Leave Type</th>
										<th>Description</th>
										<th>Created On</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									
									<?php foreach($leaves as $lev): ?>
										<tr>
										<td><?= $lev['id']?></td>
										<td class="table-plus"><?= $lev['leave_type']?></td>
										<td><?= $lev['description']?></td>
										<td><?= date('l d M Y h:i:s', strtotime($lev['created_at']))?></td>
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
													
													<a class="dropdown-item" href="<?= base_url().'admindashboard/edit-leave/'. $lev['id']?>"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="<?= base_url().'admindashboard/delete-leave/'. $lev['id']?>"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<?php endforeach;?>

								</tbody>
							</table>
							<?php endif; ?>
						</div>
					</div>
					<!-- Simple Datatable End -->
					


    
<?= $this->endSection(); ?>