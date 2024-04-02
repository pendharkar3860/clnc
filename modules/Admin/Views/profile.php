<div class="content-wrapper">          
  <div class="container-xxl flex-grow-1 container-p-y">
       	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> User Profile</h4>
			<form action="<?php echo base_url('admin/profile/update/'.$userid); ?>" id="formAuthentication" class="mb-3" action="index.html" method="POST">
            <!-- Basic Layout -->
            <div class="row">
            
            <div class="col-xl">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Personal Detail</h5>
                  
                </div>
                <div class="card-body">
                 	<input type="hidden" name="userdetailid" id="userdetailid" value="<?php echo isset($userdata)? $userdata['userdetailid'] :""?>"/>
                 	<input type="hidden" name="userid" id="userid" value="<?php echo $userdata['userid'];?>"/>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">First Name</label>
                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="John Doe" value="<?php echo $userdata['firstname'];?>" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-company">Last Name</label>
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="ACME Inc." value="<?php echo $userdata['lastname'];?>" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-email">Email</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="email"
                          class="form-control"
                          placeholder="john.doe"
                          aria-label="john.doe"
                          aria-describedby="basic-default-email2"
                          name="email"
                          value="<?php //echo $userdata['email'];?>"
                        />
                        <span class="input-group-text" id="basic-default-email2">@example.com</span>
                      </div>
                      <div class="form-text">You can use letters, numbers & periods</div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Mobile No</label>
                      <input
                        type="text"
                        id="mobile"
                        class="form-control phone-mask"
                        placeholder="658 799 8941"
                        name="mobile"
                        value="<?php echo $userdata['mobile'];?>"
                      />
                    </div>
                   
                   
                  
                </div>
              </div>
              
            
            
            </div>
            <div class="col-xl">
              	<div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Address</h5>
                      
                    </div>
                    <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Address</label>
                      <textarea class="form-control" name="address" id="address" placeholder="Address"><?php echo $userdata['address1'];?></textarea>
                    </div>
                   
                    </div>
                     
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            
            </div>
         </form>
</div>
<!-- / Content -->


</div>