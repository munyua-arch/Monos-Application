<?= $this->extend('layouts/base.php'); ?>
<?= $this->section('content'); ?>

<div class="text-center m-3">
    <h3>Business Directory | Affordable Subscriptions</h3>
</div>

<div class="text-center">
    <h5>Select a subscription plan and enter your M-Pesa phone number</h5>
    <h6 class="mt-3">
        Already Subscribed?
        <a href="#">Login </a>
    </h6>
</div>

<?php if (isset($validation)): ?>
    <div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 1050;">
        <div class="toast-container position-absolute top-0 end-0 p-1">
            <!-- Display validation errors as toasts -->
            <?php foreach ($validation->getErrors() as $error): ?>
                <div class="toast align-items-center text-white bg-danger border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?= esc($error); ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Monthly Subscription Form -->
<?= form_open('/subscriptions/monthly'); ?>
    <div class="card text-center mt-5 shadow" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            Subscribe to Our Business Directory
        </div>
        <div class="card-body">
            <h5 class="card-title">Monthly Plan - KES 500</h5>
            <p class="card-text">Get full access to all directory features for 30 days.</p>
            <input type="tel" class="form-control mt-3" placeholder="Enter your phone number" name="monthly_sub">
            <button type="submit" class="btn btn-primary mt-3 w-100">
                Subscribe
            </button>
        </div>
    </div>
<?= form_close(); ?>

<!-- Quarterly Subscription Form -->
<?= form_open('/subscriptions/quarterly'); ?>
    <div class="card text-center mt-5 shadow" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            Subscribe to Our Business Directory
        </div>
        <div class="card-body">
            <h5 class="card-title">Quarterly Plan - KES 1,200</h5>
            <p class="card-text">Enjoy unlimited access for 90 days.</p>
            <input type="tel" class="form-control mt-3" placeholder="Enter your phone number" name="quarterly_sub">
            <button type="submit" class="btn btn-primary mt-3 w-100">
                Subscribe
            </button>
        </div>
    </div>
<?= form_close(); ?>

<!-- Annual Subscription Form -->
<?= form_open('/subscriptions/annual'); ?>
    <div class="card text-center mt-5 shadow" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            Subscribe to Our Business Directory
        </div>
        <div class="card-body">
            <h5 class="card-title">Annual Plan - KES 4,000</h5>
            <p class="card-text">Full access for an entire year at a discounted rate.</p>
            <input type="tel" class="form-control mt-3" placeholder="Enter your phone number" name="annual_sub">
            <button type="submit" class="btn btn-primary mt-3 w-100">
                Subscribe
            </button>
        </div>
    </div>
<?= form_close(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastElements = document.querySelectorAll('.toast');
        toastElements.forEach(function (toastElement) {
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        });
    });
</script>

<?= $this->endSection(); ?>
