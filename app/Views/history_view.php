<?= $this->extend('backend/page-layouts'); ?>
<?= $this->section('content'); ?>

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Leave History Section</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url().'dashboard/'?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Leave History
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Simple Datatable start -->
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">My Leave History</h4>
    </div>
    <div class="pb-20">
        <?php if(count($approved) || count($declined) || count($pending)): ?>
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th>Leave Type</th>
                        <th>Applied On</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($approved as $app): ?>
                        <tr>
                            <td><?= $app['name']?></td>
                            <td><?= $app['leave_type']?></td>
                            <td><?= $app['applied_on']?></td>
                            <td><?= $app['start_date']?></td>
                            <td><?= $app['end_date']?></td>
                            <td class="text-success">
                                <?= ucfirst($app['status'])?>
                                <i class="icon-copy bi bi-check-square-fill"></i>
                            </td>
                        </tr> 
                    <?php endforeach; ?> 

                    <?php foreach($declined as $dec): ?>
                        <tr>
                            <td><?= $dec['name']?></td>
                            <td><?= $dec['leave_type']?></td>
                            <td><?= $dec['applied_on']?></td>
                            <td><?= $dec['start_date']?></td>
                            <td><?= $dec['end_date']?></td>
                            <td class="text-danger">
                                <?= ucfirst($dec['status'])?>
                                <i class="icon-copy bi bi-x-octagon-fill"></i>
                            </td>
                        </tr> 
                    <?php endforeach; ?> 

                    <?php foreach($pending as $pend): ?>
                        <tr>
                            <td><?= $pend['name']?></td>
                            <td><?= $pend['leave_type']?></td>
                            <td><?= $pend['applied_on']?></td>
                            <td><?= $pend['start_date']?></td>
                            <td><?= $pend['end_date']?></td>
                            <td class="text-info">
                                <?= ucfirst($pend['status'])?>
                            </td>
                        </tr> 
                    <?php endforeach; ?> 
                </tbody>
            </table>
        <?php else: ?>
            <p class="d-flex justify-content-center text-danger">No leave history available.</p>
        <?php endif; ?>
    </div>
</div>
<!-- Simple Datatable End -->

<?= $this->endSection(); ?>
