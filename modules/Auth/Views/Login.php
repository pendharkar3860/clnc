<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
      
        <div class="row justify-content-center">
          <div class="col-lg-8">
          		<?php if(session()->get('success')): ?>
      			<div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
      			<?php endif;?>
      			
           		<?php if(isset($validation)): ?>
          		<div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
          	 	<?php endif;?>
          		
            <div class="card-group d-block d-md-flex row">
              
                  <div class="card col-md-7 p-4 mb-0">
                  <form action="<?php echo base_url('login/doLogin'); ?>" id="formAuthentication" class="mb-3" action="index.html" method="POST">
                    <div class="card-body">
                      <h1>Login</h1>
                      <p class="text-medium-emphasis">Sign In to your account</p>
                      <div class="input-group mb-3"><span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                          </svg></span>
                        <input class="form-control" type="text" placeholder="Username" name="email">
                      </div>
                      <div class="input-group mb-4"><span class="input-group-text">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                          </svg></span>
                        <input class="form-control" type="password" placeholder="Password" name="password">
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <button class="btn btn-primary px-4" type="submit">Login</button>
                        </div>
                        <div class="col-6 text-end">    
                        	<a href="<?php echo base_url();?>forgotpassword">                   
                          		<button class="btn btn-link px-0" type="button">Forgot password?</button>   
                          	</a>                       
                        </div>
                      </div>
                    </div>
                     </form>	
                  </div>
             
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <h2>Sign up</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a href="<?php echo base_url();?>registration">
                    <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>