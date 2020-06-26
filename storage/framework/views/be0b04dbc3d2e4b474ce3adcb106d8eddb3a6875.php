<?php $__env->startSection('content'); ?>

<section class="login">
   		<div class="container">
   			<div class="row justify-content-center align-content-center">
   				<div class="col-md-12">
   					<div class="loginBox">
   						<div class="text-center mb-5 pb-3">
   							<img src="<?php echo e(asset('assets/img/logo.png')); ?>">
   						</div>
              <?php if(Session::has('error')): ?>
              <div class="alert alert-danger">
            
                        <?php echo e(Session('error')); ?>

              </div>
              <?php endif; ?>
   						<form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
						  <div class="form-group">
						    
                            <span class="<?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                                <input type="email"  name="email" placeholder="User email"  class="form-control "  value="<?php echo e(old('email')); ?>" required autocomplete="email">
                            </span>
						    

						  </div>
						  <div class="form-group">
						  
                            <span class="<?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                                <input type="password" name="password" placeholder="User password" autocomplete="false" class="form-control"   required>
                            </span>
						    
						  </div>

						<?php if(Route::has('password.request')): ?>
                                    
                                <a href="<?php echo e(route('password.request')); ?>" class="colorGrey">Forgot Password?</a>
                        <?php endif; ?> 
						  
						    <button type="submit" class="btn themeBtn w-100 text-white p-2 mt-4">LOGIN</button>

						</form>
   					</div>
   				</div>
   			</div>
   		</div>
   	</section>
   	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts2.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ar\newhtml\html\AudioBotClickBank\audiobot\resources\views/auth/login.blade.php ENDPATH**/ ?>