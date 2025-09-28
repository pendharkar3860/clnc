
<script>    
    $(document).ready(function() {
        $(".modal-body").text("Jquery response ajax response");  
          $("#btn_customermodel").click(function(){
            //$('#myModal').modal('show');
            GetCustmerData();
        });
    });
  
    
        
    function loadDoc() {

    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange  = function() {

      //document.getElementsByClassName("modal-body").innerText = this.responseText;
      document.getElementsByClassName("modal-body").innerText = "AJAX RESPONSE";

    }
    xhttp.open("GET", "<?php echo base_url('admin/customerajax');?>");
    xhttp.send();                  
  }
  function GetCustmerData()
  {
      $.ajax({
        url: '<?php echo base_url('admin/customerajax');?>',
        method: 'GET',
        dataType: 'html',
        success: function(response) {
            console.log("Data received:", response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
      
  }    
   
</script>
<div class="row">     
    <div class="col-12">
      <div class="card mb-4">
          <div class="card-header"><strong>Complain</strong></div>
        <div class="card-body">
          <?php 
              
             
            if(isset($complaindata) && !empty([$complaindata])){ 
               $complainid=$complaindata['complainid'];
                ?>
            <p class="text-medium-emphasis small"><b>Update complain</b>  </p>
          <?php }else{
                
                $complainid=0;
              ?>
            <p class="text-medium-emphasis small"><b>Add complain</b>  </p>
            <p class="text-medium-emphasis small">
               
                <button id="btn_customermodel" type="button" class="btn btn-ghost-secondary" >Customer</button>
               
            </p>
          <?php }?>
            <div class="tab-content rounded-bottom">
                <?php  if(isset($validation)): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $validation->listErrors();?></div>
                <?php endif;?>
                <?php if(session()->get('success')): ?>
                       <div class="alert alert-success" role="alert"><?php echo session()->get('success');?></div>
                       <?php endif;?>   
              <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1003">
                <form name="complainform" action="<?php echo ($complainid>0)? base_url('admin/complain/update'):base_url('admin/complain/insert'); ?>" method="POST" class="row g-3">
                    
                    <input class="form-control" name="customerid" id="customerid" type="hidden" value="<?php echo $complainid;?>">
                    <input class="form-control" name="userid" id="userid" type="hidden" value="<?php echo $userid;?>">
                    <input class="form-control" name="firmid" id="firmid" type="hidden" value="<?php echo $firmid;?>">
                                        
                    
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Full Name</label>
                      <input class="form-control" name="fullname" id="fullname" type="text" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customername']: ""; ?>" required>
                    </div>
                    
                    <div class="col-md-6">
                      <label class="form-label" for="mobile1">Mobile-1</label>
                      <input class="form-control" pattern="[7896][0-9]{9}" name="mobile1" id="mobile1" type="text" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customermobile1']: ""; ?>" required>
                    </div>
                      <div class="col-md-6">
                      <label class="form-label" for="mobile2">Mobile-2</label>
                      <input class="form-control" pattern="[7896][0-9]{9}" name="mobile2" id="mobile2" type="text" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customermobile2']: ""; ?>" >
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="email">Email</label>
                      <input class="form-control" name="email" id="email" type="email" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customeremail']: ""; ?>" >
                    </div>
                     <div class="col-12">
                      <label class="form-label" for="customeraddress">Customer Address </label>
                      <input class="form-control" name="customeraddress" id="customeraddress" type="text" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customeraddress']: ""; ?>" >
                    </div>
                     <div class="col-md-6">
                      <label class="form-label" for="firm">Firm</label>
                      <input class="form-control" name="firm" id="firm" type="text" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customerfirm']: ""; ?>" >
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="customerfirmaddress">Firm Address </label>
                      <input class="form-control" name="customerfirmaddress" id="customerfirmaddress" type="text" value="<?php  echo (isset($complaindata) && !empty($complaindata))?$complaindata['customerfirmaddress']: ""; ?>" >
                    </div>
                                     
                   <?php if(isset($complaindata) && !empty([$complaindata])){  ?>
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

<!<!-- POP UP MODEL  -->

<div class="modal fade modal-xl" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer List</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        here the text
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
        <button type="button" id="savemodel" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>