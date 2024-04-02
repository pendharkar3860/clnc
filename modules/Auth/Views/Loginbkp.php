
<div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">SHIVAM</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to clinic App! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
              
              <?php if(session()->get('success')): ?>
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->get('success');?>
                        </div>
                    </div>    
              <?php endif;?>
              <?php if(isset($validation)): ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?php echo $validation->listErrors();?>
                        </div>
                    </div>    
              <?php endif;?>
              <form action="<?php echo base_url('login/doLogin'); ?>" id="formAuthentication" class="mb-3" action="index.html" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email or Username</label>
                  <input
                    type="email"
                    class="form-control"
                    id="bs-validation-email"
                    name="email"
                    placeholder="Enter your email or username"
                    autofocus
					required
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="<?php echo base_url();?>forgotpassword">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="bs-validation-password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="  "
					  required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="<?php echo base_url();?>registration">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>