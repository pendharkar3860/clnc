
<script>    
    $(document).ready(function() {
        var flagchecked=0;
        
        $("#btn_customermodel").click(function(){            
            GetCustmerData();
            $('#myModal').modal('show');
        });   
       
        $(document).on('click', '.page-link', function(e){
            e.preventDefault();
            var pgnumber=0;   
            pagenumber=$.trim($(this).html());
            SearchCustomer(pagenumber);
        });
        $(document).on('click', 'input[name="customerchk[]"]', function(e){            

               if(flagchecked==$(this).val())
               {
                   $(this).prop('checked', false);
                   flagchecked=0;
               }
               else
               {
                   $("input[name='customerchk[]']").prop('checked', false);
                   $(this).prop('checked', true);

                   flagchecked=$(this).val();
               }                           
        });
        $('#modelform').on('submit', function(e) {
            e.preventDefault();
            console.log("Form submission prevented. Executing custom logic...");
            $("#loader").show();
        });
        
        
    });
  
    
    function opencompany()
    {
         $('#companymodel').modal('show');
        
    }    
    function loadDoc() {

    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange  = function() {

      //document.getElementsByClassName("modal-body").innerText = this.responseText;
      document.getElementsByClassName("modal-body").innerText = "AJAX RESPONSE";

    }
    xhttp.open("GET", "<?php echo base_url('admin/customerajax');?>");
    xhttp.send();                  
  }
  function SearchCustomer(page=0)
  {
        var formdata=$('#customerlistform').serialize();
        var url="";
       
        if(page>0)
        {
            
            url="<?php echo base_url('admin/customerajax/');?>"+page;
        }
        else
        {
            url="<?php echo base_url('admin/customerajax');?>";
        }
       $.ajax({
        url: url,
        method: 'POST',
        data:formdata,
        dataType: 'html',
        success: function(response) {
           // console.log("Data received:", response);
            $("#myModal").find('.modal-body').html(response);
            flagchecked=0;
        },
        error:  function(jqXHR, textStatus, errorThrown) {
        // Handle error response here
        console.error("AJAX Error:", textStatus, errorThrown);

        // Access the raw response text from the server
        console.error("Response Text:", jqXHR.responseText);
        }
    });
  }
  function GetCustmerData()
  {
      $.ajax({
        url: '<?php echo base_url('admin/customerajax');?>',
        method: 'GET',
        dataType: 'html',
        success: function(response) {
           // console.log("Data received:", response);
            $("#myModal").find('.modal-body').html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
      
  }  
  
  function ResetSearch()
    {
       $("#srhfullname").val("");
       $("#srhmobile1").val("");
       $("#srhmobile2").val("");
       $("#srhmail").val(""); 
       SearchCustomer();
    }
    function GetCustomerDetail()
    {
            if($('input[name="customerchk[]"]').is(':checked')==true)
            {
               var customerid=$('input[name="customerchk[]"]:checked').val();
                var customerinfo="";
                $("#customerinfo").html("");
                $.ajax({
                 url: '<?php echo base_url('admin/customerajax/customerdetail/');?>'+customerid,
                 method: 'POST',
                 dataType: 'json',
                 success: function(res) {
                     customerinfo='<h5 class="card-title">'+res["customername"]+'</h5><p class="card-title"><b>'+res["customermobile1"]+'</b></p> <p class="card-text">'+res["customermobile2"]+'</p> <p class="card-text">'+res["customeraddress"]+'</p>';
                     $("#customerinfo").html(customerinfo);
                       $('#myModal').modal('hide');                      
                 },
                 error: function(xhr, status, error) {
                     console.error("Error:", error);
                 }
                });
            }
            else
            {
               alert("Please select customer!");
            }
            
            /*
            
        */
    }
    function openpumpmodel()
    {        
        $('#pumpmodel').modal('show');                
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
            <div class="row p-3">
                <div class="col-md-1">
                    <p class="text-medium-emphasis small"><button id="btn_customermodel" type="button" class="btn btn-outline-secondary" >Customer</button></p>                    
                </div>
                <div class="col-md-1">
                    
                <p class="text-medium-emphasis small"><button id="addpumpmodel" onclick="openpumpmodel()" type="button" class="btn btn-outline-secondary" >Model</button></p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-6">
                     <div class="card">
                      <h5 class="card-header">Customer Details</h5>
                      <div class="card-body" id="customerinfo">
                      
                      </div>
                    </div>
                </div>
            </div>
            
            
            
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
                                        
                    
                    <div class="col-md-2">
                    <label class="form-label" for="mobile1">Motor/Pump Company</label>
                    <select class="form-control" name="cars" id="cars">   
                            <option value="0">Select Company</option>
                 
                    </select>                                     
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="addcompany">&nbsp;</label>
                        <p class="text-medium-emphasis small"><button id="addcompany" type="button" class="btn btn-outline-secondary" >Add Company</button></p>
                    </div>
                    
                    <div class="col-md-6"></div>
                                     
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

<!<!-- Customer Popup  -->

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
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- Pump Model Popup  -->

<div class="modal fade modal-xl" id="pumpmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">PumpModel</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>                        
        <div class="modal-body card">
            <div class="card">
            <div class="card-body">
                <form name="modelform" id="modelform" action="" method="POST" class="row g-3">
                  <div class="col-md-5">
                    <label class="form-label" for="addcompany">Model Name</label>
                    <input class="form-control" name="modelname" id="modelname" type="text" value="" >
                  </div> 
                <div class="col-md-3">
                  <label class="form-label" for="company">Motor/Pump Company</label>
                    <select class="form-control" name="company" id="company" required >   
                            <option selected disabled value="0">Select Company</option>
                    <?php if(isset($companylist) && !empty($companylist)){  ?>
                        <?php foreach ($companylist as $key => $com) { ?>
                            <option value="<?php echo $com["companyid"];?>"><?php echo $com["companyname"];?></option>
                        <?php }?>
                    <?php }?>
                        
                    </select>   
                  <div class="invalid-feedback">
                    Please select company.
                  </div>
                </div>
               
                <div class="col-md-1">
                  <label class="form-label" for="mobile1">HP</label>
                  <select class="form-control" name="hp" id="hp"> 
                      <option value="0">HP</option>
                      <?php if(isset($hp) && !empty($hp)){  ?>
                            <?php foreach ($hp as $khp => $dhp) { ?>
                                <option value="<?php echo $dhp->hpid;?>"><?php echo $dhp->hp;?></option>
                            <?php }?>
                        <?php }?>   
                  </select>                                     
                </div>                         
                <div class="col-md-1">  
                  <label class="form-label" for="mobile1">PHASE</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">1PH</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">3PH</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="RPM">RPM</label>
                    <select class="form-control" name="rpm" id="rpm">   
                        <option value="0">RPM</option>
                        <?php if(isset($rpm) && !empty($rpm)){  ?>
                            <?php foreach ($rpm as $k => $r) { ?>
                                <option value="<?php echo $r->rpmid;?>"><?php echo $r->rpm;?></option>
                            <?php }?>
                        <?php }?>              
                    </select>                                     
                </div>   
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="RPM">Model Group Desc</label>
                        <select class="form-control" name="pumpdesc" id="pumpdesc">   
                            <option value="0">Select Group</option>

                            <?php if(isset($pumpdesclist) && !empty($pumpdesclist)){?>
                                <?php foreach ($pumpdesclist as $key => $desc) {?>
                                    <option value="<?php echo $desc["modeldescid"];?>"><?php echo $desc["modeldesc"];?></option>
                                <?php }?>
                            <?php }?>               
                        </select> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button name="btnmodelsave" id="btnmodelsave" class="btn btn-success btn-lg" type="submit" style="color:#FFFFFF">Save</button>
                    </div>
                </div>              
                </form>
            </div>
            
            <div class="card-body">
                <div class="card">
                    <b class="card-header">Search List</b>
                    <div class="card-body">
                      
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
                        <tr class="datagridrow" id="">
                        <th scope="row"></th>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a class="nav-link" href="" >                                        
                                <img src="<?php echo base_url('modules/common/theme/coreui/src/assets/icons/pen.png')?>" alt="Update" style="position:relative;width:20px;height:20px;display:block;" />
                            </a>
                        </td>
                      </tr>
                           
                        </tbody>
                      </table>
                                               
                   </div>
            </div>   
        </div>
        </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!<!-- company Popup  -->

<div class="modal fade modal-xl" id="companymodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="companylabel">CompanyList</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
