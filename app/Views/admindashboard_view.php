<?= $this->extend('backend/admin-layouts'); ?>
<?= $this->section('content'); ?>


   <div>
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="title pb-20">
					<h2 class="h3 mb-0">Leave System Overview</h2>
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= $total?></div>
									<div class="font-14 text-secondary weight-500">
										Active Employees
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
									<i class="icon-copy bi bi-people-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= $totalDept?></div>
									<div class="font-14 text-secondary weight-500">
										Available Departments
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
									<i class="icon-copy bi bi-bag-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?= $totalLeave?></div>
									<div class="font-14 text-secondary weight-500">
										Available Leave Types
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon text-info">
									<i class="icon-copy bi bi-door-closed-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
			
					

				</div>

				<!-- second row of info -->
				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
							<div class="card-box height-100-p widget-style3">
								<div class="d-flex flex-wrap">
									<div class="widget-data">
										<div class="weight-700 font-24 text-dark"><?= $totalRequests?></div>
										<div class="font-14 text-secondary weight-500">Pending Applications</div>
									</div>
									<div class="widget-icon">
										<div class="icon" data-color="#09cc06">
											<i class="icon-copy fa fa-money" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
							<div class="card-box height-100-p widget-style3">
								<div class="d-flex flex-wrap">
									<div class="widget-data">
										<div class="weight-700 font-24 text-dark"><?= $totalDeclined?></div>
										<div class="font-14 text-secondary weight-500">Declined Applications</div>
									</div>
									<div class="widget-icon">
										<div class="icon" data-color="#ff5b5b">
										<i class="icon-copy bi bi-x-octagon-fill"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
							<div class="card-box height-100-p widget-style3">
								<div class="d-flex flex-wrap">
									<div class="widget-data">
										<div class="weight-700 font-24 text-dark"><?= $totalApproved?></div>
										<div class="font-14 text-secondary weight-500">Approved</div>
									</div>
									<div class="widget-icon">
										<div class="icon" data-color="#09cc06">
										<i class="icon-copy bi bi-check-square-fill"></i>
										</div>
									</div>
								</div>
							</div>
						</div>


				</div>

				

				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Recent Leave Requests</h4>
						</div>
						<div class="pb-20">

							<?php if($requests > 0): ?>
								<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">#</th>
										<th>Employee Name</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Leave Type</th>
										<th>Reason</th>
										<th>Status</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($requests as $req):?>
										<tr>
										<td class="table-plus"><?= $req['id']?></td>
										<td><?= $req['name']?></td>
										<td><?= date('l d M Y', strtotime($req['start_date']))?></td>
										<td><?= date('l d M Y', strtotime($req['end_date']))?></td>
										<td><?= $req['leave_type']?></td>
										<td><?= $req['reason']?></td>
										<td>
										<?php if($req['status'] == 'pending...'): ?>
											<p class="text-info"><?= strtoupper($req['status'])?></p>
										<?php elseif($req['status'] == 'Approved'): ?>
											<p class="text-success">
												<?= strtoupper($req['status'])?>
												<i class="icon-copy bi bi-check-square-fill"></i>
											</p>
										<?php else: ?>
											<p class="text-danger">
												<?= strtoupper($req['status'])?>
												<i class="icon-copy bi bi-x-octagon-fill"></i>
											</p>
										<?php endif;?>
                                        </td>
						
										<!-- <td>
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
													<a class="dropdown-item text-success" href="#"
														><i class="icon-copy bi bi-check-square-fill"></i> Approve</a
													>
													<a class="dropdown-item text-danger" href="#"
														><i class="icon-copy bi bi-x-octagon-fill"></i> Decline</a
													>
													
												</div>
											</div>
										</td> -->
										<td>
											<a href="<?= base_url().'admindashboard/employeeleavedetails/' .$req['id']?>" class="btn btn-info">Action</a>
										</td>
									</tr>
									<?php endforeach;?>
									
						
								</tbody>
							</table>
							<?php endif;?>
						</div>
			</div>
					<!-- Simple Datatable End -->

<?= $this->endSection(); ?>