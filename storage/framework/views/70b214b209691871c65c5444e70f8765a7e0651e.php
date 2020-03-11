<div class="container-fluid pl-5 pr-5 topBar">
               <div class="row">
                  <div class="col-md-12 text-right">
                    <div class="dropdown">
                        
                      <ul class="list-inline mt-5 dropdown-toggle" data-toggle="dropdown">
                        <li class="mr-2">
                           <img src="<?php echo e(asset('assets/img/useravatar.png')); ?>" width="50">
                        </li>
                        <li>
                           <p class="m-0">
                           <?php echo e(Auth::user()->name); ?>

                           </p>
                        </li>
                     </ul>
                      <div class="dropdown-menu  dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo e(route('home')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                       
                      </div>
                    </div>
                     
                  </div>
               </div>
            </div>

<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
<?php echo csrf_field(); ?>
</form><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/common/topbar.blade.php ENDPATH**/ ?>