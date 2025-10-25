
<script>    
    $(document).ready(function() {
        var flagchecked=0;
        
        $("#btn_customermodel").click(function(){            
            GetCustmerData();
            $('#myModal').modal('show');
        });   
        $("#addpumpmodel").click(function(){                        
            $('#pumpmodel').modal('show');
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
            $(".modal-body").html(response);
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
            $(".modal-body").html(response);
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
            <div class="row">
                <div class="col-md-6">
                    <p class="text-medium-emphasis small"><button id="btn_customermodel" type="button" class="btn btn-outline-secondary" >Customer</button></p>
                </div>
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
                          <option value="volvo">Volvo</option>
                          <option value="saab">Saab</option>                       
                          <option value="mercedes">Mercedes</option>
                          <option value="audi">Audi</option>
                        
                      </select>                                     
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="addcompany">&nbsp;</label>
                        <p class="text-medium-emphasis small"><button id="addcompany" type="button" class="btn btn-outline-secondary" >Add Company</button></p>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="addcompany">&nbsp;</label>
                        <p class="text-medium-emphasis small"><button id="addpumpmodel" type="button" class="btn btn-outline-secondary" >Select Model</button></p>
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
      <div class="modal-body">
          <form name="complainform" action="" method="POST" class="row g-3">
            <div class="col-md-2">
              <label class="form-label" for="addcompany">Model Name</label>
              <input class="form-control" name="modelname" id="modelname" type="text" value="" >
            </div> 
            <div class="col-md-2">
            <label class="form-label" for="mobile1">HP</label>
              <select class="form-control" name="hp" id="hp">   
                  <option value="0">HP</option>
                  <option value="1">0.5</option>
                  <option value="2">1</option>
                  <option value="3">1.5</option>
                  <option value="4">1.2</option>
                  <option value="5">1.75</option>
                  <option value="6">2</option>
              </select>                                     
            </div>                         
            <div class="col-md-2">                                
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">
                1PH
                 </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                <label class="form-check-label" for="exampleRadios2">3PH</label>
                </div>
            </div>
            <div class="col-md-6"></div>
          </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>