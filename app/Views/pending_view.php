<?= $this->extend('backend/admin-layouts'); ?>
<?= $this->section('content'); ?>
    
					<div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Pending Leaves</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/'?>">Home</a>
                                            </li>
                                           
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Pending List
                                            </li>
                                        </ol>
                                    </nav>
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
										<td><?= date('l d M Y h:i:s', strtotime($req['start_date']))?></td>
										<td><?= date('l d M Y h:i:s', strtotime($req['end_date']))?></td>
										<td><?= $req['leave_type']?></td>
										<td><?= $req['reason']?></td>
										<td class="text-info">
                                            <?= $req['status']?>
                                            <i class="icon-copy bi bi-x-octagon-fill"></i>
                                        </td>
						
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
													<a class="dropdown-item text-success" href="#"
														><i class="icon-copy bi bi-check-square-fill"></i> Approve</a
													>
													<a class="dropdown-item text-danger" href="#"
														><i class="icon-copy bi bi-x-octagon-fill"></i> Decline</a
													>
													
												</div>
											</div>
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