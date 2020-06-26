

<?php $__env->startSection('content'); ?>
<div class="container  pl-5 pr-5">
<div class="row mt-3">
                  <div class="col-md-12">
                  	 <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Package Name</th>
                            <th>User Status</th>
                            <th>Change Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                          <tr>
                            <td><?php echo e($user->name); ?></td>
                            
                            
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->Name); ?></td>
                            <td><?php if($user->status){echo 'Active';}else{echo 'In Active';} ?></td>
                            <td><button id='changeuserstatus' type='button' class="btn  themeBtn" user_id='<?php echo e($user->user_id); ?>' user_status = '<?php echo e($user->status); ?>'>Change Status</button></td>
                          </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                          <td colspan="4" align="center">No User Found</td>
                          </tr>
                        <?php endif; ?> 
                        </tbody>
                      </table>
                  </div>
                   </div>
               </div>
               </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type= "text/javascript">
$('body').on('click', '#changeuserstatus',function(e){
   e.preventDefault();
   var url = '<?php echo e(route("ChangeUserStatus")); ?>/'+$(this).attr('user_id')+'/'+$(this).attr('user_status');
   $.ajax({


type: 'get',

url: url,


success:function(response){

   if(response == 1)
   {
       alert('User Status Changed');
       location.reload();
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
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/packages/ViewSubscribers.blade.php ENDPATH**/ ?>