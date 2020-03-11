

<?php $__env->startSection('content'); ?>

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Update Package
                     </h3>
                     
                  </div>
               </div>
<ul>
               <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form id='updatepackageform'>
<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Package Name</label>
    <input name='packageName' type="email" value='<?php echo e($package->Name); ?>' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Package Name">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Package Description</label>
    <input name='packageDescription' type="text" value='<?php echo e($package->Description); ?>' class="form-control" id="exampleInputPassword1" placeholder="Package Description">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Package Price</label>
    <input name='packagePrice' type="Number" value='<?php echo e($package->Price_month); ?>' class="form-control" id="exampleInputPassword1" placeholder="Package Price">
    <input type='hidden' name='id' value='<?php echo e($package->Id); ?>'>
    <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
  </div>
  <button id='submitForm' type="submit" class="btn themeBtn">Update</button>
</form>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type= "text/javascript">

$('body').on('click', '#submitForm',function(e){

e.preventDefault();

   var url = '<?php echo e(route("UpdatePackage")); ?>';

   var formData = $("#updatepackageform").serializeArray();

$.ajax({

   type: 'post',

   url: url,

   data: formData,

   success:function(response){

       if(response == 1)
       {
           alert('Data updated successfully');
           window.location.href = '<?php echo e(route("Packages")); ?>'
       }
       else
       {
           alert('There is some issue. Package not added')
       }
   },
   error:function()
   {
       alert('Error in the request');
   }

});

});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/packages/UpdatePackage.blade.php ENDPATH**/ ?>