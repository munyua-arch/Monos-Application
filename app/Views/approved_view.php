<?= $this->extend('backend/admin-layouts'); ?>
<?= $this->section('content'); ?>
    
					<div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>Approved Leaves</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'admindashboard/'?>">Home</a>
                                            </li>
                                           
                                            <li class="breadcrumb-item active" aria-current="page">
                                                Approved List
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
					</div>

<!-- multiple select row Datatable start -->
<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Approved History</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table hover multiple-select-row nowrap">
								<thead>
									<tr>
                                        <th>#</th>
										<th>EmployeeID</th>
										<th>FullName</th>
										<th>Leave type</th>
										<th>Applied On</th>
										<th>Current Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>IT6u8</td>
										<td>Dennis Murimi</td>
										<td>Study</td>
                                        <td>29-03-2018</td>
                                        <td class="text-success">
											Approved
											<i class="icon-copy bi bi-check-square-fill"></i> 
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
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>

                                    <tr>
										<td>1</td>
										<td>IT6u8</td>
										<td>Dennis Murimi</td>
										<td>Study</td>
                                        <td>29-03-2018</td>
										<td class="text-success">
											Approved
											<i class="icon-copy bi bi-check-square-fill"></i> 
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
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
								
								</tbody>
							</table>
						</div>
					</div>
					<!-- multiple select row Datatable End -->

					

<?= $this->endSection(); ?>