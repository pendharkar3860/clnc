
<script>
    (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(form => {
      form.addEventListener('submit', event => {
          
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    
</script>
<div class="row">     
    <div class="col-12">
      <div class="card mb-4">
          <div class="card-header"><strong>Customer</strong></div>
        <div class="card-body">
          <?php 
            if(isset($userdata) && !empty([$userdata])){ 
                $customerid=$userdata['userdetailid'];
                ?>
            <p class="text-medium-emphasis small"><b>Update Customer</b>  </p>
          <?php }else{
                
                $userdetailid=0;
              ?>
            <p class="text-medium-emphasis small"><b>Add Customer</b>  </p>
          <?php }?>
            <div class="tab-content rounded-bottom">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
                <?php endif;?>
                <?php if(session()->get('success')): ?>
                       <div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
                       <?php endif;?>   
              <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                <form action="<?php echo ($customerid>0)? base_url('admin/profile/update'):base_url('admin/profile/insert'); ?>" method="POST" class="row g-3">
                    
                    <input class="form-control" name="customerid" id="customerid" type="hidden" value="<?php echo $userdata['userid'];?>">
                    <input class="form-control" name="customerdetailid" id="customerdetailid" type="hidden" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['userdetailid']: "0"; ?>" >
                    <div class="col-md-6">
                      <label class="form-label" for="firstname">First Name</label>
                      <input class="form-control" name="firstname" id="firstname" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['firstname']: ""; ?>" required>

                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="lastname">Last Name</label>
                      <input class="form-control" name="lastname" id="lastname" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['lastname']: ""; ?>" required>
                    </div>
                      <div class="col-md-6">
                      <label class="form-label" for="mobile">Mobile</label>
                      <input class="form-control" pattern="[7896][0-9]{9}" name="mobile" id="mobile" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['mobile']: ""; ?>" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="education">Education</label>
                      <input class="form-control" name="education" id="education" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['education']: ""; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="birthdate">Birthdate</label>                                             
                        <input class="form-control" name="birthdate" id="birthdate" type="date" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['birthdate']: ""; ?>" required>                                            
                    </div>                     
             
                    <div class="col-md-3">
                      <label class="form-label" for="age">age</label>
                      <input class="form-control" name="age" id="age" type="number" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['age']: ""; ?>" required>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="workingskill">Working Skill</label>
                      <input class="form-control" name="workingskill" id="workingskill" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['workingskill']: ""; ?>" required>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="roll">Work AS</label>
                      <input class="form-control" name="roll" id="roll" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['roll']: ""; ?>" required>
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="address1">Address 1</label>
                      <input class="form-control" name="address1" id="address1" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['address1']: ""; ?>" required>
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="address2">Address 2</label>
                      <input class="form-control" name="address2" id="address2" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['address2']: ""; ?>" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="city">City</label>
                      <input class="form-control" name="city" id="city" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['city']: ""; ?>" required>
                    </div>
                  <div class="col-md-4">
                    <label class="form-label" for="state">State</label>
                     <input class="form-control" name="state" id="state" type="text" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['state']: ""; ?>">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label" for="zip">Zip</label>
                    <input class="form-control" name="zip" id="zip" type="number" value="<?php  echo (isset($userdata) && !empty($userdata))?$userdata['zip']: ""; ?>">
                  </div>
                   <?php if(isset($userdata) && !empty([$userdata])){ print_r($userdata); ?>
                  <div class="col-12">                    
                    <button class="btn btn-primary btn-lg" type="submit">update</button>
                  </div>
                   <?php }else{?>
                    <div class="col-12">
                        <button class="btn btn-success btn-lg" type="submit">Save</button>
                    </div>
                   <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>