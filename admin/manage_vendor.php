<?php 
  include('inc/config.php');
  include('inc/functions.php');
  include 'inc/Authorize.php'; 
  $PageTitle = ' Manage Vendor | ';
  include('header.php');
  include('topbar.php');
  include('sidebar.php');
  
?>
<?php if (isset($_GET['vendorid'])): ?>
    <?php 
        $vendorid = preg_replace('/[^0-9]/', '-', $_GET['vendorid']);
        $VendorData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Vendor WHERE id = ".$vendorid.""));
        if(!isset($VendorData)){
            echo '<script> window.location = "'.$SiteUrl.'admin/vendor.php"; </script>';
            exit();
        }
     ?>
<?php endif ?> 
<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manage Vendor</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo $SiteUrl; ?>admin/dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Vendor Form</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
 
<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Manage Vendors Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="vendorform" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="card-body">
<div class="row">
	<div class="col-md-3">
		<div class="form-group name-group">
			<label class="" for="vendor_image">Vendor Profile Image</label>
			<div class="">
				<input type="file" id="vendor_image" name="vendor_image" value="">
			</div>
		</div>
	</div>
	
	<div class="col-md-6 vendorname-group">
		<div class="form-group vendorname-group">
			<label class="control-label" for="vendor_name">Vendor Name</label>
				<input type="text" <?php echo TypeLength(); ?> id="vendor_name" name="vendor_name" class="form-control" placeholder="Vendor Name" value="<?php echo $VendorData['vendor_name'] ?? null; ?>">
		</div>
	</div>
 

<div class="col-md-6">
    <div class="form-group name-group">
        <label class="control-label" for="vendor_slug">Vendor Slug</label>
            <input type="text" <?php echo TypeLength(); ?> id="vendor_slug" name="vendor_slug" class="form-control" placeholder="Vendor Slug" value="<?php echo $VendorData['vendor_slug'] ?? null; ?>">
    </div>
</div>

<div class="col-md-6">
 <label class="control-label" for="vendor_email">Vendor email</label>
  <div class=" input-group ">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
    </div>
   <input type="email" <?php echo TypeLength(); ?> id="vendor_email" name="vendor_email" class="form-control" placeholder="Enter Email" value="<?php echo $VendorData['vendor_email'] ?? null; ?>">
  </div>
</div>


<div class="col-md-6">
 <label class="control-label" for="vendor_phone">Vendor phone</label>
  <div class=" input-group ">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-phone"></i></span>
    </div>
   <input type="text" <?php echo TypeLength(); ?> id="vendor_phone" name="vendor_phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $VendorData['vendor_phone'] ?? null; ?>">
  </div>
</div>
<!-- <div class="col-md-6">
        
         <label class="control-label" for="vendor_sortorder">Sort Order</label>
        
            <input type="text" id="vendor_sortorder" name="vendor_sortorder" class="form-control" placeholder="Sort Order" value="<?php echo $VendorData['vendor_sort'] ?? null; ?>">
        
    </div> -->

<div class="col-md-3">
	<div class="form-group">
		<label for=""></label>
		<div class="custom-control custom-checkbox">
          <input type="checkbox" <?php echo isset($VendorData['vendor_status']) &&  $VendorData['vendor_status'] == 1 ? 'checked' : null; ?>  name="vendor_status" value="1">
          <label for="customCheckbox2" class="">Vendor Status</label>
        </div>
		  
                        
	</div>
</div>


<div class="col-md-3">
	<div class="form-group">
		<label for=""></label>
		<div class="custom-control custom-checkbox">
          <input type="checkbox"   name="vendor_displayhome" value="1" <?php echo isset($VendorData['vendor_displayhome']) &&  $VendorData['vendor_displayhome'] == 1 ? 'checked' : null; ?>>
          <label for="customCheckbox1" class="">Display On Home</label>
        </div>               
	</div>
</div>

<div class="col-md-12 mb-3">
 <label class="control-label" for="vendor_address">Address</label>
  <div class=" input-group ">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
    </div>
   <input type="text"  id="vendor_address" name="vendor_address" class="form-control" placeholder="Enter your address" value="<?php echo $VendorData['vendor_address'] ?? null; ?>">
  </div>
</div>

<div class="col-md-12">
	<div class="form-group">
	 <label class="control-label" for="vendor_shortdesc">Short Description</label>
  
      <textarea id="vendor_shortdesc" name="vendor_shortdesc" rows="3" class="form-control" placeholder="Short Description" <?php echo TypeLength(490); ?>><?php echo $VendorData['vendor_shortdisc'] ?? null; ?></textarea>
    </div>
</div>


<div class="col-md-12">
	<div class="form-group">
  <label class="control-label" for="vendor_longdesc">Long Description</label>
      
    <textarea id="textarea-ckeditor" rows="7" name="vendor_longdesc" class="textarea form-control" placeholder="Long Description"><?php echo isset($VendorData['vendor_longdisc']) ? stripslashes($VendorData['vendor_longdisc']) : null; ?></textarea>
        </div>
    
</div>



<div class="col-md-12">
	  <div class="form-group name-group">
            <label class="control-label" for="metatitle">Meta Title</label>
                <input type="text" <?php echo TypeLength(); ?> id="metatitle" name="metatitle" class="form-control" placeholder="Meta Title" value="<?php echo $VendorData['metatitle'] ?? null; ?>">
        </div>
	</div>

	<div class="col-md-12">
		   <div class="form-group name-group">
                        <label class="control-label" for="metadesc">Meta Description</label>
                        
                          <textarea <?php echo TypeLength(); ?> id="metadesc" name="metadesc" rows="3" class="form-control" placeholder="Meta Description"><?php echo $VendorData['metadesc'] ?? null; ?></textarea>
                        
                    </div>
	</div>

	<div class="col-md-12">
		  <div class="form-group name-group">
                        <label class="control-label" for="metakeyword">Meta Keyword</label>
                        
                          <textarea <?php echo TypeLength(); ?> id="metakeyword" name="metakeyword" rows="3" class="form-control" placeholder="Meta Keyword"><?php echo $VendorData['metakeyword'] ?? null; ?></textarea>
                        
                    </div>
	</div>
</div>
                   


                   
                     

                   
 
               <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $VendorData['id'] ?? null; ?>">
                    <div class="form-group form-actions">
                        <div class="col-md-9">
<button type="submit" class="btn btn-primary">SUBMIT 
              &nbsp; <svg style="display: none;" class="spinner" width="30" height="30" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
</svg>
</button>
                        </div>
                    </div>
                
                </div>
             
              </form>
            </div>
            <!-- /.card -->


          </div>

        
    <div class="clearfix"></div>

    
</div>
 



<?php 
  include('bottom.php');
  include('footer.php');
?>
<script src="<?php echo $SiteUrl; ?>admin/js/vendor.js"></script>