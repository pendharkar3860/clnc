
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
              
             
            if(isset($customerdata) && !empty([$customerdata])){ 
               $customerid=$customerdata['customerid'];
                ?>
            <p class="text-medium-emphasis small"><b>Update Customer</b>  </p>
          <?php }else{
                
                $customerid=0;
              ?>
            <p class="text-medium-emphasis small"><b>Add Customer</b>  </p>
          <?php }?>
            <div class="tab-content rounded-bottom">
                <?php  if(isset($validation)): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
                <?php endif;?>
                <?php if(session()->get('success')): ?>
                       <div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
                       <?php endif;?>   
              <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                <form name="customerform" action="<?php echo ($customerid>0)? base_url('admin/customer/update'):base_url('admin/customer/insert'); ?>" method="POST" class="row g-3">
                    
                    <input class="form-control" name="customerid" id="customerid" type="hidden" value="<?php echo $customerid;?>">
                    <input class="form-control" name="userid" id="userid" type="hidden" value="<?php echo $userid;?>">
                    <input class="form-control" name="firmid" id="firmid" type="hidden" value="<?php echo $firmid;?>">
                                        
                    
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Full Name</label>
                      <input class="form-control" name="fullname" id="fullname" type="text" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customername']: ""; ?>" required>
                    </div>
                    
                    <div class="col-md-6">
                      <label class="form-label" for="mobile1">Mobile-1</label>
                      <input class="form-control" pattern="[7896][0-9]{9}" name="mobile1" id="mobile1" type="text" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customermobile1']: ""; ?>" required>
                    </div>
                      <div class="col-md-6">
                      <label class="form-label" for="mobile2">Mobile-2</label>
                      <input class="form-control" pattern="[7896][0-9]{9}" name="mobile2" id="mobile2" type="text" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customermobile2']: ""; ?>" >
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="email">Email</label>
                      <input class="form-control" name="email" id="email" type="email" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customeremail']: ""; ?>" >
                    </div>
                     <div class="col-12">
                      <label class="form-label" for="customeraddress">Customer Address </label>
                      <input class="form-control" name="customeraddress" id="customeraddress" type="text" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customeraddress']: ""; ?>" >
                    </div>
                     <div class="col-md-6">
                      <label class="form-label" for="firm">Firm</label>
                      <input class="form-control" name="firm" id="firm" type="text" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customerfirm']: ""; ?>" >
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="customerfirmaddress">Firm Address </label>
                      <input class="form-control" name="customerfirmaddress" id="customerfirmaddress" type="text" value="<?php  echo (isset($customerdata) && !empty($customerdata))?$customerdata['customerfirmaddress']: ""; ?>" >
                    </div>
                                     
                   <?php if(isset($customerdata) && !empty([$customerdata])){  ?>
                  <div class="col-12">                    
                    <button class="btn btn-primary btn-lg" type="submit">UPDATE</button>
                  </div>
                   <?php }else{?>
                    <div class="col-12">
                        <button class="btn btn-success btn-lg" type="submit" style="align:right">Save</button>
                    </div>
                   <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>