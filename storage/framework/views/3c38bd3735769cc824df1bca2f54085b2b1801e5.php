
<?php $__env->startSection('content'); ?>
<div class="container  pl-5 pr-5">
<div class="row">
   <div class="col-md-12">
      <h3>
         Add Package
      </h3>
   </div>
</div>
<form id='AddPackageForm'>
   <?php echo csrf_field(); ?>
   <ul style="list-style-type : none !important;">
      <li> Package Name          <input class="form-control input-sm" style="color: black;"  name='title' type='text' required></input></li>
      <li> Package Sku          <input class="form-control input-sm" style="color: black;"  name='sku' type='text' required></input></li>
      <li> Package Description   <input  class="form-control input-sm"style="color: black;"  name='description' type='text' required></input></li>
      <li> Package Price        <input type = "number" class="form-control input-sm" style="color: black;"  name='price' required></input></li>
      <li> Rebill Comission       <input type = "number" class="form-control input-sm" style="color: black;"  name='rebillCommission' required></input></li>
      <li> Rebill Price        <input type = "number" class="form-control input-sm" style="color: black;"  name='rebillPrice' required></input></li>
      <input type="hidden" name="currency" value="USD">
      <input type="hidden" name="language" value="EN">
      <input type="hidden" name="site" value="audiogen">
      <input type="hidden" name="categories" value="EBOOK">
      <input type="hidden" name="duration" value="30">
      <input type="hidden" name="frequency" value="MONTHLY">
      <input type="hidden" name="pitchPage" value="http://www.audiorobot.net">
      <input type="hidden" name="thankYouPage" value="https://www.audiorobot.net">
      <input type="hidden" name="trialPeriod" value="0">
      <input type="hidden" name="digital" value="true">
      <input type="hidden" name="physical" value="false">
      <input type="hidden" name="digitalRecurring" value="true">
      <input type="hidden" name="physicalRecurring" value="false">
      <!-- <li> 
         Membership        <input type = "text" class="form-control input-sm" style="color: black;"  name='PackagePrice' required></input>
         </li> -->
     <!--  <li>
         <div class="form-group">
            <label>Membership</label>
            <select id="voice_type" name="membership_id" class="form-control" required="">
               <option disabled="" selected="">Choose membership</option>
               <option value="Standard">Standard</option>
                  <option value="WaveNet">WaveNet</option>
                  <option value="Both">Both</option>
               <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option value="<?php echo e($membership->id); ?>"><?php echo e($membership->name); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
         </div>
      </li> -->
      <li> <input type="button" id="AddPackagebtn" style= "float: left; margin-top: 10px;" class=" btn  themeBtn" type='submit' value='submit' > </li>
   </ul>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type= "text/javascript">
   $('body').on('click', '#AddPackagebtn',function(e){
   
   e.preventDefault();
   
   var Formdata = $("#AddPackageForm").serializeArray();
   
   
   $.ajax({
   
      type: 'post',
   
      url:'<?php echo e(route("AddPackage")); ?>',
   
      data: Formdata,
   
      success:function(response){
   
          if(response == 1)
          {
              alert('data added in the db');
              // window.location.href = '<?php echo e(route("Packages")); ?>'
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

<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/packages/AddPackage.blade.php ENDPATH**/ ?>