

<?php $__env->startSection('content'); ?>

<section class="login">
   		<div class="container">
   			<div class="row justify-content-center align-content-center">
   				<div class="col-md-12">
   					<div class="loginBox">
   						<div class="text-center mb-4">
   							<img src="<?php echo e(asset('assets/img/logo.png')); ?>">
   						</div>
              <div class="text-center">
              <h3 style="color: #fff">Private Acces Only</h3>
				<a style="text-decoration: underline;" href="<?php echo e(route('login')); ?>" class="colorGrey">Member Login</a><br>
				<a style="text-decoration: underline;" href="<?php echo e(route('Packages')); ?>" class="colorGrey">Subscribe/Register</a>
              </div>
   					</div>
   				</div>
   			</div>
   		</div>
   	</section>
   	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts2.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/auth/memberlogin.blade.php ENDPATH**/ ?>