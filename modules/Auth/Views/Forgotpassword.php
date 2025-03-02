

<div class="row justify-content-center">
  <div class="col-lg-8">
      
     <?php if($err=="1"): ?>
      <div class="alert alert-danger" role="alert">Link expire please resend link for reset password</div>
    <?php endif;?>
  
     <?php if(session()->get('success')): ?>
        <div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
    <?php endif;?>

    <?php if(isset($validation)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
    <?php endif;?>
        
     <?php if($emailresult=="1"): ?>
        <div class="alert alert-success" role="alert">Change password link send on your email please check your email</div>
    <?php endif;?>

    <?php if($emailresult=="0"): ?>
        <div class="alert alert-danger" role="alert">Email not send please try again</div>
    <?php endif;?>
        
    <div class="card-group d-block d-md-flex row">
      <div class="card col-md-7 p-4 mb-0">
        <form action="<?php echo base_url('login/sendforgetpasslink'); ?>" id="formAuthentication" class="mb-3"  method="POST">  
        <div class="card-body">
          <h1>Forgot Password</h1>
          <p class="text-medium-emphasis">Send link for reset password</p>
          <div class="input-group mb-3"><span class="input-group-text">
              <svg class="icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
              </svg></span>
            <input class="form-control" id="email" name="email" type="text" placeholder="Pleas enter your Email">
          </div>

          <div class="row">
            <div class="col-6">
              <button class="btn btn-primary px-4" type="submit">Send Link</button>
            </div>
            <div class="col-6 text-end">    
                    <a href="<?php echo base_url();?>login">                   
                        <button class="btn btn-link px-0" type="button">Login</button>   
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
            <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>