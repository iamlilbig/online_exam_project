<?php $__env->startSection('pageName'); ?>
New students
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">phone</th>
        <th scope="col">accept</th>
        <th scope="col">reject</th>
    </tr>
</thead>
<tbody>
<?php if(isset($students)): ?>
    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(route('admin.new.students.confirm',$student->id)); ?>">
    <?php echo method_field('patch'); ?>
    <?php echo csrf_field(); ?>
    <tr>
        <th scope="row"><?php echo e($student->id); ?></th>
        <td><?php echo e($student->name); ?></td>
        <td><?php echo e($student->email); ?></td>
        <td><?php echo e($student->phone); ?></td>
        <td><input type="submit" value="accept" name="confirmation" class="btn btn-success"></td>
        <td><input type="submit" value="reject" name="confirmation" class="btn btn-danger"></td>
    </tr>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lilbig/Desktop/project/laravel/resources/views/dashboard/admins/students/new.blade.php ENDPATH**/ ?>