
<?php $firmsess= FirmDetail();?>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        
        <?php echo (isset($firmsess) && !empty($firmsess)?$firmsess["firmname"]:"");?>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <?php if(FirmAdded()){?>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/dashboard');?>">
          <svg class="nav-icon">
            <use xlink:href="<?php echo base_url('modules/common/theme/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-speedometer')?>"></use>
          </svg> Dashboard</a>
        </li>
        <?php }?>  
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/firm');?>">
            <svg class="nav-icon">
              <use xlink:href="<?php echo base_url('modules/common/theme/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-industry-slash')?>"></use>
            </svg> Firm</a>
        </li>
        <?php if(FirmAdded()){?>        
        <li class="nav-title">User Managment</li>
        <!--
        <li class="nav-item"><a class="nav-link" href="colors.html">
            <svg class="nav-icon">
              <use xlink:href="<?php //echo base_url('modules/common/theme/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-drop')?>"></use>
            </svg> Add Karigar</a></li>-->
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="<?php echo base_url('modules/common/theme/coreui/dist/vendors/@coreui/icons/svg/free.svg#user')?>"></use>
            </svg>Customer</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/customer');?>"><span class="nav-icon"></span> Customer List</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/customer/addnew');?>"><span class="nav-icon"></span>Add Customer</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/customerajax');?>"><span class="nav-icon"></span>Customer Ajax</a></li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="<?php echo base_url('modules/common/theme/coreui/dist/vendors/@coreui/icons/svg/free.svg#user')?>"></use>
            </svg>Complain</a>
            <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/complain');?>"><span class="nav-icon"></span>Add Complain</a></li> 
            
            </ul>
        </li>
        <?php }?>
            
            
        
        
        
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>