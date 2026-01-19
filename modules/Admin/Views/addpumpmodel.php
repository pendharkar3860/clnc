
<script>
  function previous()
  {
      //console.log("<?php echo base_url('admin/pumpmodel'); ?>/addnew");
      window.location.replace("<?php echo base_url('admin/pumpmodel'); ?>");
      
  }
 

</script>
<div class="row">     
    <div class="col-12">
        
      <div class="card mb-4">          
          <div class="card-header"><strong>Add New Model</strong></div>
          
        <div class="card-body">
                       
          <?php /* if($firmid==0){ ?>
            <p class="text-medium-emphasis small"><b>Hello <?php echo $userdata[0]->firstname." ".$userdata[0]->lastname;?>  Create your Company</b>  </p>
          <?php }else{?>
            <p class="text-medium-emphasis small"><b>Hello <?php echo $userdata[0]->firstname." ".$userdata[0]->lastname;?> , Update your Company</b>  </p>
          <?php }*/ ?>
            <div class="tab-content rounded-bottom">
               
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
                <?php endif;?>
                     
              <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                  
                  
                <form action="<?php echo ($pumpmodelid>0)? base_url('admin/pumpmodel/update'):base_url('admin/pumpmodel/insert'); ?>" method="POST" class="row g-3">
                    <input class="form-control" name="userid" id="userid" type="hidden" value="<?php echo $userid;?>"/>
                    <input class="form-control" name="firmid" id="firmid" type="hidden" value="<?php  echo $firmid;?>" />
                    <input class="form-control" name="pumpmodelid" id="pumpmodelid" type="hidden" value="<?php  echo (isset($modeldata) && !empty($modeldata))?$modeldata["pumpmodelid"]: "0"; ?>" />
                    <div class="col-md-12"><button class="btn btn-secondary rounded-0" onclick="previous();">Back</button></div> 
                <div class="col-md-5">
                  <label class="form-label" for="addcompany">Model Name</label>
                  <input class="form-control" name="modelname" id="modelname" type="text" value="<?php  echo (isset($modeldata) && !empty($modeldata))?$modeldata["modelname"]: ""; ?>" required>
                </div> 
                <div class="col-md-3">
                  <label class="form-label" for="company">Motor/Pump Company</label>
                    <select class="form-control" name="company" id="company" required >   
                            <option selected disabled value="">Select Company</option>
                    <?php if(isset($companylist) && !empty($companylist)){ $cselected="";  ?>
                        <?php foreach ($companylist as $key => $com) { ?>
                            <?php ($modeldata["companyid"] == $com["companyid"])?$cselected="selected":$cselected=""; ?>
                            <option <?php echo $cselected;?> value="<?php echo $com["companyid"];?>"><?php echo $com["companyname"];?></option>
                        <?php }?>
                    <?php }?>                        
                    </select>                    
                </div>
               
                <div class="col-md-1">
                  <label class="form-label" for="mobile1">HP</label>
                  <select class="form-control" name="hp" id="hp" required> 
                      <option value="">HP</option>
                      <?php if(isset($hp) && !empty($hp)){  $hselected="";?>
                            <?php foreach ($hp as $khp => $dhp) { ?>
                            <?php ($modeldata["hpid"] == $dhp->hpid)?$hselected="selected":$hselected=""; ?>
                                <option <?php echo $hselected;?> value="<?php echo $dhp->hpid;?>"><?php echo $dhp->hp;?></option>
                            <?php }?>
                        <?php }?>   
                  </select>                                     
                </div>                         
                <div class="col-md-1">  
                  <label class="form-label" for="mobile1">PHASE</label>
                    <div class="form-check">
                       
                        <input class="form-check-input" type="radio" name="phase" id="phase1" value="1PH" required <?php echo ($modeldata["phase"]=="1PH")?"checked":""; ?>  >
                        <label class="form-check-label" for="exampleRadios1">1PH</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="phase" id="phase3" value="3PH" required <?php echo ($modeldata["phase"]=="3PH")?"checked":""; ?> >
                        <label class="form-check-label" for="exampleRadios2">3PH</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="RPM">RPM</label>
                    <select class="form-control" name="rpm" id="rpm" required>   
                        <option value="">RPM</option>
                        <?php if(isset($rpm) && !empty($rpm)){ $rselected="";  ?>
                            <?php foreach ($rpm as $k => $r) { ?>
                                <?php ($modeldata["rpmid"] == $r->rpmid)?$rselected="selected":$rselected=""; ?>
                                <option <?php echo $rselected;?> value="<?php echo $r->rpmid;?>"><?php echo $r->rpm;?></option>
                            <?php }?>
                        <?php }?>              
                    </select>                                     
                </div>   
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="RPM">Model Group Desc</label>
                        <select class="form-control" name="pumpdesc" id="pumpdesc" required>   
                            <option value="">Select Group</option>

                            <?php if(isset($pumpdesclist) && !empty($pumpdesclist)){ $msselected="";?>
                                <?php foreach ($pumpdesclist as $key => $desc) {?>
                                    <?php ($modeldata["modeldescid"] == $desc["modeldescid"])?$msselected="selected":$msselected=""; ?>
                                    <option <?php echo $msselected;?> value="<?php echo $desc["modeldescid"];?>"><?php echo $desc["modeldesc"];?></option>
                                <?php }?>
                            <?php }?>               
                        </select> 
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="headrange">Head Range (In MET)</label>
                        <input class="form-control" name="headrange" id="headrange" type="text" value="<?php  echo (isset($modeldata) && !empty($modeldata))?$modeldata["headrange"]: ""; ?>" >
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="totalhead">Total Head (In MET)</label>
                        <input class="form-control" name="totalhead" id="totalhead" type="text" value="<?php  echo (isset($modeldata) && !empty($modeldata))?$modeldata["totalhead"]: ""; ?>" >
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="amp">Amp</label>
                        <input class="form-control" name="amp" id="amp" type="text" value="<?php  echo (isset($modeldata) && !empty($modeldata))?$modeldata["amp"]: ""; ?>" >
                    </div>  
                    <div class="col-md-2">&nbsp;</div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label" for="modelextradesc">Model Extra Description</label>
                    <input class="form-control" name="modelextradesc" id="modelextradesc" type="text" value="<?php  echo (isset($modeldata) && !empty($modeldata))?$modeldata["modelextradesc"]: ""; ?>" >
                </div> 
                
                <?php if($pumpmodelid==0){ ?>
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
