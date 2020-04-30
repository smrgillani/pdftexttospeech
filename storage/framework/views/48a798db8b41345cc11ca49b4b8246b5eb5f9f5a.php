

<?php $__env->startSection('content'); ?>

<section class="login">
   		<div class="container">
   			<div class="row justify-content-center align-content-center">
   				<div class="col-md-12">
   					<div class="loginBox">
   						<div class="text-center mb-5 pb-3">
   							<img src="<?php echo e(asset('assets/img/logo.png')); ?>">
   						</div>

              <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
               <?php endif; ?>

   						<form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>
						  <div class="form-group">
						    
                            <span class="<?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                                <input type="email"  name="email" placeholder="User email"  class="form-control "  value="<?php echo e(old('email')); ?>" required autocomplete="email">
                                   <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                  <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                  </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </span>
						    

						  </div>
						  
						  <button type="submit" class="btn themeBtn w-100 text-white p-2 mt-4"> <?php echo e(__('Send Password Reset Link')); ?></button>

						</form>



   					</div>
   				</div>
   			</div>
   		</div>
   	</section>
   	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts2.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>