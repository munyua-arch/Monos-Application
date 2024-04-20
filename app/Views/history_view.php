<?= $this->extend('backend/page-layouts'); ?>
<?= $this->section('content'); ?>
    
					<div class="min-height-200px">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="title">
                                        <h4>My Leave History</h4>
                                    </div>
                                    <nav aria-label="breadcrumb" role="navigation">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url().'dashboard/'?>">Home</a>
                                            </li>
                                           
                                            <li class="breadcrumb-item active" aria-current="page">
                                                History
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
					</div>

<!-- multiple select row Datatable start -->
<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">My Leave History</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table hover multiple-select-row nowrap">
								<thead>
									<tr>
                                        <th>#</th>
										<th>Type</th>
										<th>Condition</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Applied</th>
                                        <th>Admin's Remark</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Sick</td>
										<td>Sherehe</td>
										<td>29-03-2018</td>
                                        <td>29-03-2018</td>
										<td>29-03-2018</td>
                                        <td>Pending...</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Sick</td>
										<td>Sherehe</td>
										<td>29-03-2018</td>
                                        <td>29-03-2018</td>
										<td>29-03-2018</td>
                                        <td>Pending...</td>
									</tr>
                                    <tr>
										<td>3</td>
										<td>Sick</td>
										<td>Sherehe</td>
										<td>29-03-2018</td>
                                        <td>29-03-2018</td>
										<td>29-03-2018</td>
                                        <td>Pending...</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- multiple select row Datatable End -->

					

<?= $this->endSection(); ?>