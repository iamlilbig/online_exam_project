<?php $__env->startSection('pageName'); ?>
Search students
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php echo $__env->yieldContent('pageName'); ?></h3></div>
                    <div class="card-body">
                        <select class="form-select" aria-label="Default select example">
                          <option selected>Select one search method</option>
                          <option value="id">id</option>
                          <option value="name">name</option>
                          <option value="email">email</option>
                          <option value="phone">phone</option>
                        </select>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lilbig/Desktop/project/laravel/resources/views/dashboard/admins/students/search.blade.php ENDPATH**/ ?>