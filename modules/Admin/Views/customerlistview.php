
<script>
  
 
function ResetSearch()
{
   document.getElementById("fullname").value="";
   document.getElementById("mobile1").value="";
   document.getElementById("mobile2").value="";
   document.getElementById("email").value="";
   document.getElementById("customerlistform").submit();
   
}
</script>
<div class="row">     
    <div class="col-12">
      <div class="card mb-4">
          <div class="card-header"><h5>Customer</h5></div>
                                                
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
                          <form name="customerlistform" id="customerlistform" action="<?php echo base_url('admin/customer'); ?>" method="POST" class="row g-3">                                                                                                    
                            <div class="col-md-4">
                              <label class="form-label" for="fullname">Full Name</label>
                              <input class="form-control" name="fullname" id="fullname" type="text" value="<?php echo (isset($searchdata['fullname'])&& !empty($searchdata['fullname'])?$searchdata['fullname']:""); ?>" >
                            </div>

                            <div class="col-md-2">
                              <label class="form-label" for="mobile1">Mobile-1</label>
                              <input class="form-control" pattern="[7896][0-9]{9}" name="mobile1" id="mobile1" type="text" value="<?php echo (isset($searchdata['searchmobile1'])&& !empty($searchdata['searchmobile1'])?$searchdata['searchmobile1']:""); ?>" >
                            </div>
                              <div class="col-md-2">
                              <label class="form-label" for="mobile2">Mobile-2</label>
                              <input class="form-control" pattern="[7896][0-9]{9}" name="mobile2" id="mobile2" type="text" value="<?php echo (isset($searchdata['searchmobile2'])&& !empty($searchdata['searchmobile2'])?$searchdata['searchmobile2']:""); ?>" >
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="email">Email</label>
                              <input class="form-control" name="email" id="email" type="email" value="<?php echo (isset($searchdata['searchemail'])&& !empty($searchdata['searchemail'])?$searchdata['searchemail']:""); ?>" >
                            </div>
                              <div class="col-12" style="text-align: right;">
                                  <button type="button" class="btn btn-primary rounded-0" onclick="ResetSearch()">ResetSearch</button>
                                  <button class="btn btn-secondary rounded-0" type="submit">Search</button>
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
                            <th scope="col">Customer Name</th>
                            <th scope="col">Mobile-1</th>
                            <th scope="col">Mobile-2</th>
                            <th scope="col">Email</th>
                            <th scope="col">Customer Address</th>
                            <th scope="col">Customer Firm</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($customerdata) && !empty($customerdata)){?>
                            <?php foreach ($customerdata['pagedata'] as $key => $value) {?>
                                <tr class="datagridrow" id="dtg<?php echo $value['customerid']; ?>">
                                <th scope="row"><?php echo $key+1;?></th>
                                <td><?php echo $value['customername']; ?></td>
                                <td><?php echo $value['customermobile1']; ?></td>
                                <td><?php echo $value['customermobile2']; ?></td>
                                <td><?php echo $value['customeremail']; ?></td>
                                <td><?php echo $value['customeraddress']; ?></td>
                                <td><?php echo $value['customerfirmaddress']; ?></td>
                                <td><a class="nav-link" href="<?php echo base_url('admin/customer/details/').$value['customerid'];?>" >                                        
                                        <img src="<?php echo base_url('modules/common/theme/coreui/src/assets/icons/pen.png')?>" alt="Update" style="position:relative;width:20px;height:20px;display:block;" />
                                    </a>
                                </td>
                              </tr>
                            <?php }?>
                        <?php }?>
                                
                        </tbody>
                      </table>
                       <?php 
                       echo $customerdata["pager"]->links("group1",'coreui_paggination');
                       ?> 
                        
                   </div>
            </div>
          </div>
        </div>
      </div>
    </div>