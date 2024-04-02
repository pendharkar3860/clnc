<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
      
      	
  	 	<form action="<?php echo base_url('registration/createlogin'); ?>" id="formAuthentication" class="mb-3" action="index.html" method="POST">
            <div class="row justify-content-center">
          
              <div class="col-md-6">
                
          		
                <div class="card mb-4 mx-4">
                  <div class="card-body p-4">
                  <?php if(isset($validation)): ?>
                  	<div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
          	 		<?php endif;?>
                    <h1>Register</h1>
                    <p class="text-medium-emphasis">Create your account</p>
                    
                    <div class="input-group mb-3"><span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
    
                        </svg></span>
                      <input class="form-control" type="text" placeholder="Username" id="username" name="username" >
                    </div>
                    <div class="input-group mb-3"><span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                        </svg></span>
                      <input class="form-control" type="text" placeholder="Email" id="email" name="email" >
                    </div>
                    <div class="input-group mb-3"><span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                        </svg></span>
                      <input class="form-control" type="password" placeholder="Password" id="password" name="password">
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                        </svg></span>
                      <input class="form-control" type="password" placeholder="Repeat password" id="confirmpassword" name="confirmpassword">
                    </div>
                    <div class="row">
                       	<div class="col-6">
                        	<button class="btn btn-block btn-success" type="submit">Create Account</button>
                        </div>
                        <div class="col-6 text-end">    
                        	<a href="<?php echo base_url();?>login">                   
                          		<button class="btn btn-link px-0" type="button">Backto Login</button>   
                          	</a>                       
                        </div>
                    </div>
                                                                                                  
                  </div>
                 
                </div>
                
              </div>
              
            </div>
        </form>
      </div>
    </div>