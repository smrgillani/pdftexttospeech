<?php $__env->startSection('content'); ?>
<section class="login">
        <div class="container">
            <div class="row justify-content-center align-content-center">
                <div class="col-md-12">
                    <div class="loginBox">
                        <div class="text-center mb-5 pb-3">
                            <img src="<?php echo e(asset('assets/img/logo.png')); ?>">
                        </div>
                    <form method="POST" action="

                    <?php if(request()->route()->getName()=='user.register'): ?>

                    <?php echo e(route('auth.register')); ?>


                    <?php else: ?>
                    <?php echo e(route('register')); ?>

                    <?php endif; ?>


                    ">
                        <?php echo csrf_field(); ?>
                         <?php if(request()->route()->getName()=='user.register'): ?>
                            <input type='hidden' value='<?php echo e(request()->item); ?>' name='item'>
                            <input type='hidden' value='<?php echo e(request()->cbreceipt); ?>' name='cbreceipt'>
                         <?php endif; ?>
                        <input type="hidden" name="redirect" value="<?php echo e($link); ?>">

                        <div class="form-group">
                            
                            <span class="<?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                                <input type="text"  name="name" placeholder="Name"  class="form-control "  value="<?php echo e(old('name')); ?>" required autocomplete="name">
                            </span>
                            

                          </div>
                          <?php if(request()->cemail): ?>
                      
                                <input type="hidden"  name="email" placeholder="User email"  class="form-control "  value="<?php echo e(request()->cemail); ?>" required autocomplete="email">
                     
                            

                 
                          <?php else: ?>
                              <div class="form-group">
                            
                            <span class="<?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                                <input type="email"  name="email" placeholder="User email"  class="form-control "  value="<?php echo e(old('email')); ?>" required autocomplete="email">
                            </span>
                            

                          </div>
                          <?php endif; ?>
                          <div class="form-group">
                          
                            <span class="<?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>">
                                <input type="password" name="password" placeholder="User password" autocomplete="false" class="form-control"   required>
                            </span>
                            
                          </div>
                          <div class="form-group">
                          
                            <span class="">
                                <input type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="false" class="form-control"   required>
                            </span>
                            
                          </div>

                  

                        
                          <button type="submit" class="btn themeBtn w-100 text-white p-2 mt-4">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts2.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/auth/register.blade.php ENDPATH**/ ?>