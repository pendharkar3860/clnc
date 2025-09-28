<div class="row">     
    <div class="col-12">
      <div class="card mb-4">
          <div class="card-header"><strong>New Firm</strong></div>
        <div class="card-body">
          <?php if($firmid==0){ ?>
            <p class="text-medium-emphasis small"><b>Hello <?php echo $userdata[0]->firstname." ".$userdata[0]->lastname;?>  Create your Company</b>  </p>
          <?php }else{?>
            <p class="text-medium-emphasis small"><b>Hello <?php echo $userdata[0]->firstname." ".$userdata[0]->lastname;?> , Update your Company</b>  </p>
          <?php }?>
            <div class="tab-content rounded-bottom">
                <?php if(session()->get('success')): ?>
                <div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
                <?php endif;?>
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
                <?php endif;?>
                    
              <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                <form action="<?php echo ($firmid>0)? base_url('admin/firm/update'):base_url('admin/firm/insert'); ?>" method="POST" class="row g-3">
                    <input class="form-control" name="userid" id="userid" type="hidden" value="<?php echo $userdata[0]->userid;?>">
                    <input class="form-control" name="firmid" id="firmid" type="hiddden" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmid:"0"; ?>">
                  <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Business Name (Title)</label>
                    <input class="form-control" name="firmname" id="firmname" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmname:""; ?>">
                    
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="inputPassword4">Email</label>
                    <input class="form-control" name="firmemail" id="firmemail" type="email" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmemail: session()->get("firmemail"); ?>">
                  </div>
                    <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Mobile</label>
                    <input class="form-control" name="firmmobile" id="firmmobile" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmmobile: session()->get("firmmobile"); ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="inputPassword4">Nature Of Business Activity</label>
                    <input class="form-control" name="firmactivity" id="firmactivity" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmactivity: session()->get("firmactivity"); ?>">
                  </div>
                    <div class="col-md-12">
                    <label class="form-label" for="inputEmail4">Dealing In Goods and Services</label>
                    <input class="form-control" name="firmdealing" id="firmdealing" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmdealing: session()->get("firmdealing"); ?>">
                  </div>
                 
                  <div class="col-12">
                    <label class="form-label" for="inputAddress">Address</label>
                    <input class="form-control" name="firmaddress1" id="firmaddress1" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmaddress1:session()->get("firmaddress1") ; ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="inputAddress2">Address 2</label>
                    <input class="form-control" name="firmaddress2" id="firmaddress2" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmaddress2: session()->get("firmaddress2"); ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="inputCity">City</label>
                    <input class="form-control" name="firmcity" id="firmcity" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmcity: session()->get("firmcity"); ?>">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label" for="inputState">State</label>
                     <input class="form-control" name="firmstate" id="firmstate" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmstate: session()->get("firmstate"); ?>">
                  </div>
                  <div class="col-md-2">
                    <label class="form-label" for="inputZip">Zip</label>
                    <input class="form-control" name="firmzip" id="firmzip" type="text" value="<?php  echo (isset($firmdata) && !empty($firmdata))?$firmdata[0]->firmzip: session()->get("firmzip"); ?>">
                  </div>
                   <?php if($firmid==0){ ?>
                  <div class="col-12">
                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                  </div>
                   <?php }else{?>
                    <div class="col-12">
                        <button class="btn btn-primary btn-lg" type="submit">update</button>
                    </div>
                   <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
