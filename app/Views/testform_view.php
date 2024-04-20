<?php 

$page_session = \CodeIgniter\Config\Services::session();
?>

<?= $this->extend('backend\admin-layouts'); ?>
<?= $this->section('content'); ?>

<section>

    <?php if(isset($validation)):?>
        <?= $validation->listErrors(); ?>
    <?php endif;?>


    <?= form_open() ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
        </div>

        <input type="submit" value="Submit" class="btn btn-lg btn-primary">
    <?= form_close() ?>
</section>

<?= $this->endSection(); ?>