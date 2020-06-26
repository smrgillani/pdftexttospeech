<?php $__env->startSection('content'); ?>

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Packages
                     </h3>
                     <div style="float: right">
                   
                            <!-- <button type="button" id='viewsubscribers' class="btn  themeBtn" data-toggle="modal" data-target="#myModal"> -->
                            </div>
                  </div>
               </div>
               
                     <ul style="list-style: none;">
                     <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li>
                     <div style='margin:10px' class="card">
                        <h5 style="color: black" class="card-header"><?php echo e($membership->package->title); ?></h5>
                           <div class="card-body">
                              
                              <p style="color: black" class="card-text"><?php echo e($membership->package->description); ?></p>
                              <h6 style="color: black; float: right" class="card-title">$<?php echo e($membership->package->price); ?> /Month</h6>
                              <a href="<?php echo e(config('services.clickBank.baseLink').$membership->package->sku); ?>" target="_blank" id='subscribepackages' class="btn themeBtn" packageid='<?php echo e($membership->package->Id); ?>'>Subscribe</a>
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

       if(response == 1)
       {
           alert('package subscribed successfully');
       }
       if(response == 2)
       {
          alert('package is already subscribed');
       }
       else
       {
           alert('There is some issue. Package not subscribed')
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
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/AudioBotClickBank/audiobot/resources/views/packages/packagesList.blade.php ENDPATH**/ ?>