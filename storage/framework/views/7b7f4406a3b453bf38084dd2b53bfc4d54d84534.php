

<?php $__env->startSection('content'); ?>
<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Packages
                     </h3>
                  </div>
               </div>
               
                     <ul style="list-style: none;">
                     <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li>
                     <div style='margin:10px' class="card">
                        <h5 style="color: black" class="card-header"><?php echo e($package->title); ?></h5>
                           <div class="card-body">
                              
                              <p style="color: black" class="card-text"><?php echo e($package->description); ?></p>
                              <h6 style="color: black; float: right" class="card-title">$<?php echo e($package->price); ?> /Month</h6>
                              <button  id='subscribepackage' class="btn themeBtn" packageid='<?php echo e($package->Id); ?>'>Subscribe</button>
                           </div>
                     </div>
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </ul>
               
            </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type= "text/javascript">

$('body').on('click', '#subscribepackage',function(e){

e.preventDefault();

   var url = '<?php echo e(route("SubscribePackage")); ?>/'+$(this).attr('packageid');


$.ajax({

   type: 'get',

   url: url,

   success:function(response){

        window.location.href = '<?php echo e(route("signupUser")); ?>/'+response;
       
   },
   error:function()
   {
       alert('Error in the request');
   }

});

});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('packages.PackagesLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/packages/packagesListOnLoginPage.blade.php ENDPATH**/ ?>