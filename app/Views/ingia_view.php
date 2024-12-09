<?= $this->extend('layouts/base')?>
<?= $this->section('content')?>

<div class="d-flex justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
				<h2 class="text-center text-primary">MONOS SYSTEM</h2>
				<h4 class="text-center text-primary mt-3">
                    <a href="<?= base_url().'login'?>" class="btn btn-primary btn-block">
                        Go to Login
                        <i class="icon-copy bi bi-arrow-right p-2"></i>
                    </a>
                </h4>
			</div>
        </div>
    </div>
</div>

<?= $this->endSection()?>