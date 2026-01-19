
<script>
  function Addnew()
  {
      //console.log("<?php echo base_url('admin/pumpmodel'); ?>/addnew");
      window.location.replace("<?php echo base_url('admin/pumpmodel'); ?>/addnew");
      
  }
 
function ResetSearch()
{
    //console.log("reset funxtion");
   $("#searchmodelname").val("");
   $("#searchhp").val("");
   $("#phase1").prop('checked',false);
   $("#phase3").prop('checked',false);
      window.location.replace("<?php echo base_url('admin/pumpmodel');?>");
}
</script>
<div class="row">     
    <div class="col-12">
      <div class="card mb-4">
          <div class="card-header"><h5>Pumps Model</h5></div>
                                                
          <div class="card-body">
         
            <div class="tab-content rounded-bottom">
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
                <?php endif;?>
                <?php if(session()->get('success')): ?>
                       <div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
                       <?php endif;?>   
                    <div class="card">
                        <h5 class="card-header">Search List</h5>
                        <div class="card-body">
                          <form name="modellistform" id="modellistform" action="<?php echo base_url('admin/pumpmodel'); ?>" method="POST" class="row g-3">                                                                                                    
                            <div class="col-md-4">
                              <label class="form-label" for="fullname">Model Name</label>
                              <input class="form-control" name="searchmodelname" id="searchmodelname" type="text" value="<?php echo (isset($searchdata['modelname'])&& !empty($searchdata['modelname'])?$searchdata['modelname']:""); ?>" >
                            </div>

                            <div class="col-md-2">
                              <label class="form-label" for="mobile1">HP</label>
                                <select class="form-control" name="searchhp" id="searchhp" required> 
                                    <option value="">HP</option>
                                    <?php if(isset($hp) && !empty($hp)){  $hselected="";?>
                                        <?php foreach ($hp as $khp => $dhp) { ?>
                                        <?php ($searchdata["hpid"] == $dhp->hpid)?$hselected="selected":$hselected=""; ?>
                                    <option <?php echo $hselected;?> value="<?php echo $dhp->hpid;?>"><?php echo $dhp->hp;?></option>
                                        <?php }?>
                                    <?php }?>   
                                </select>  
                            </div>
                              <div class="col-md-2">
                              <label class="form-label" for="mobile2">Phase</label>
                            <div class="form-check">

                                <input class="form-check-input" type="radio" name="searchphase" id="phase1" value="1PH" <?php echo ($searchdata["phase"]=="1PH")?"checked":""; ?>  >
                                <label class="form-check-label" for="exampleRadios1">1PH</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="searchphase" id="phase3" value="3PH" <?php echo ($searchdata["phase"]=="3PH")?"checked":""; ?> >
                                <label class="form-check-label" for="exampleRadios2">3PH</label>
                            </div>
                            </div>
                            <div class="col-md-4">
                              
                            </div>
                            <div class="col-12" style="text-align: right;">
                                <button type="button" class="btn btn-secondary rounded-0" onclick="ResetSearch()">ResetSearch</button>
                                <button class="btn btn-dark rounded-0" type="submit">Search</button>
                                <button class="btn btn-primary rounded-0" onclick="Addnew()" type="button">Add New</button>
                            </div>
                            </form> 
                        </div>
                    </div>
                 
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                  </div>
                    <div class="table-responsive-lg table-responsive-xl table-responsive-sm ">
                      <table id="customerdatagrid" class="table table-bordered table-hover ">
                        <thead>
                          <tr>
                            <th scope="col">Nos</th>
                            <th scope="col">Model Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">HP</th>                            
                            <th scope="col">RPM</th>
                            <th scope="col">PHASE</th>
                            <th scope="col">Model Desc</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($modeldata) && !empty($modeldata)){?>
                            <?php foreach ($modeldata['pagedata'] as $key => $value) {?>
                                <tr class="datagridrow" id="dtg<?php echo $value['pumpmodelid']; ?>">
                                <th scope="row"><?php echo $key+1;?></th>
                                <td><?php echo $value['modelname']; ?></td>
                                <td><?php echo $value['companyname']; ?></td>
                                <td><?php echo $value['hp']; ?></td>
                                <td><?php echo $value['rpm']; ?></td>
                                <td><?php echo $value['phase']; ?></td>
                                <td><?php echo $value['modeldesc']; ?></td>
                                <td><a class="nav-link" href="<?php echo base_url('admin/pumpmodel/details/').$value['pumpmodelid'];?>" >                                        
                                        <img src="<?php echo base_url('modules/common/theme/coreui/src/assets/icons/pen.png')?>" alt="Update" style="position:relative;width:20px;height:20px;display:block;" />
                                    </a>
                                </td>
                              </tr>
                            <?php }?>
                        <?php }?>
                                
                        </tbody>
                      </table>
                       <?php 
                       //echo $modeldata["pager"]->links("group1",'coreui_paggination');
                       ?> 
                        
                   </div>
            </div>
          </div>
        </div>
      </div>
    </div>