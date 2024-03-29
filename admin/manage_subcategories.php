<?php 
  include('inc/config.php');
  include('inc/functions.php');
  include 'inc/Authorize.php'; 
  $PageTitle = ' Manage Sub Categories | ';
  include('header.php');
  include('topbar.php');
  include('sidebar.php');
  
?>
<div class="content-wrapper">
    <!-- Page content -->
<div id="page-content">
    <div class="content-header">
        <div class="header-section">
            <?php if (isset($_GET['subcatid'])): ?>
                <?php 
                    $subcatid = preg_replace('/[^0-9]/', '-', $_GET['subcatid']);
                    $SubcategeryData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subcategory WHERE subcategory_id = ".$subcatid.""));
                    if(!isset($SubcategeryData)){
                        echo '<script> window.location = "'.$SiteUrl.'admin/subcategories.php"; </script>';
                        exit();
                    }
                 ?>
            <?php endif ?>
        </div>
    </div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Subcategories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $SiteUrl; ?>admin/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Subcategories Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
<div class="col-md-12">   
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Manage Sub-Categories Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="subcategoryform" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="card-body">



<div class="row">

	
<div class="col-md-3">
      <div class="form-group category-group">
            <label class="control-label" for="cat_dropdown">Select Category</label>
            
            <?php 
                $CategoryQuery = mysqli_query($conn, "SELECT * FROM category WHERE category_status = 1");
            ?>    
            <select name="category-chosen" class="form-control categorySelect" id="cat_dropdown">
                <?php if (mysqli_num_rows($CategoryQuery) > 0): ?>
                    <option value="">Please Select Category</option>
                    <?php while($Category = mysqli_fetch_assoc($CategoryQuery)): ?>
                        <option <?php echo isset($SubcategeryData['category_id']) && $SubcategeryData['category_id'] == $Category['category_id'] ? 'selected' : null; ?> value="<?php echo $Category['category_id']; ?>"><?php echo $Category['category_name']; ?></option>
                    <?php endwhile; ?>
                    
                    <?php else: ?>
                    <option value=""></option>
                    <option value="">No Categories Are Active</option>
                <?php endif ?>
            </select>
             
            
        </div>
</div>

	<div class="col-md-6 subcatname-group">
		<div class="form-group subcatname-group">
			<label class="control-label" for="subcat_name">SubCategory Name</label>
				<input type="text" <?php echo TypeLength(); ?> id="subcat_name" name="subcat_name" class="form-control" placeholder="SubCategory Name" value="<?php echo $SubcategeryData['subcategory_name'] ?? null; ?>">
		</div>
	</div>

  <div class="col-md-3">
    <div class="form-group name-group">
      <label class="control-label" for="subcat_image">SubCategory Image</label>
      <div class="col-md-3">
        <input type="file" id="subcat_image" name="subcat_image" value="">
      </div>
    </div>
  </div>


<div class="col-md-4">
    <div class="form-group name-group">
        <label class=" control-label" for="subcat_slug">SubCategory Slug</label>
            <input type="text" <?php echo TypeLength(); ?> id="subcat_slug" name="subcat_slug" class="form-control" placeholder="SubCategory Slug" value="<?php echo $SubcategeryData['subcategory_slug'] ?? null; ?>">
    </div>
</div>

<div class="col-md-4">
     <div class="form-group name-group">
        <label class="control-label" for="subcat_salecaption">Sale Caption</label>
            <input type="text" <?php echo TypeLength(); ?> id="subcat_salecaption" name="subcat_salecaption" class="form-control" placeholder="Sale Caption" value="<?php echo $SubcategeryData['subcategory_salecaption'] ?? null; ?>">
    </div>
</div>

  <div class="col-md-4">
    <div class="form-group name-group">
      <label class="" for="subcat_price">SubCategory Price <small style="color:red;"><strong>(Percentage)</strong></small></label>
      <input type="text" id="subcat_price" name="subcat_price" class="form-control" placeholder="SubCategory Price" value="<?php echo $SubcategeryData['price'] ?? null; ?>">
    </div>
  </div>

<div class="col-md-6">
        
         <label class="control-label" for="subcat_sortorder">Sort Order</label>
        
            <input type="text" id="subcat_sortorder" name="subcat_sortorder" class="form-control" placeholder="Sort Order" value="<?php echo $SubcategeryData['subcategory_sort'] ?? null; ?>">
        
    </div>


    <div class="col-md-3">
    <br/>
    <div class="custom-control custom-checkbox">
     <input type="checkbox" id="subcat_status"<?php echo isset($SubcategeryData['subcategory_status']) &&  $SubcategeryData['subcategory_status'] == 1 ? 'checked' : null; ?>  name="subcat_status" value="1">
     <label class="" for="subcat_status">Sub Category Status</label>
    </div>
    </div>                              


    <div class="col-md-3">
    <br/>
    <div class="custom-control custom-checkbox">
     <input type="checkbox" id="subcat_displayhome"<?php echo isset($SubcategeryData['subcategory_displayhome']) &&  $SubcategeryData['subcategory_displayhome'] == 1 ? 'checked' : null; ?>  name="subcat_displayhome" value="1">
     <label class="" for="subcat_displayhome">Display On Home</label>
    </div>
    </div>


<div class="col-md-12">
	<div class="form-group name-group">
	 <label class="control-label" for="subcat_shortdesc">Short Description</label>
  
      <textarea id="subcat_shortdesc" name="subcat_shortdesc" rows="3" class="form-control" placeholder="Short Description" <?php echo TypeLength(495); ?>><?php echo $SubcategeryData['subcategory_shortdesc'] ?? null; ?></textarea>
    </div>
</div>


<div class="col-md-12">
	<div class="form-group">
    <label class="control-label" for="subcat_longdesc">Long Description</label>
    <textarea id="textarea-ckeditor" rows="9" name="subcat_longdesc" class="textarea form-control" placeholder="Long Description"><?php echo isset($SubcategeryData['subcategory_longdesc']) ? stripslashes($SubcategeryData['subcategory_longdesc']) : null; ?></textarea>
   </div>
    
</div>



<div class="col-md-12">
	  <div class="form-group name-group">
            <label class="control-label" for="metatitle">Meta Title</label>
                <input type="text" <?php echo TypeLength(); ?> id="metatitle" name="metatitle" class="form-control" placeholder="Meta Title" value="<?php echo $SubcategeryData['title'] ?? null; ?>">
    </div>
	</div>


	<div class="col-md-12">
		<div class="form-group name-group">
      <label class="control-label" for="metadesc">Meta Description</label>
          <textarea <?php echo TypeLength(); ?> id="metadesc" name="metadesc" rows="3" class="form-control" placeholder="Meta Description"><?php echo $SubcategeryData['description'] ?? null; ?></textarea>
    </div>
	</div>

	<div class="col-md-12">
		<div class="form-group name-group">
      <label class="control-label" for="metakeyword">Meta Keyword</label>                        
        <textarea <?php echo TypeLength(); ?> id="metakeyword" name="metakeyword" rows="3" class="form-control" placeholder="Meta Keyword"><?php echo $SubcategeryData['keyword'] ?? null; ?></textarea>
                        
    </div>
	</div>
</div>

<input type="hidden" name="csrf" id="csrf" value="<?php echo GenerateCSRF();  ?>">
               <input type="hidden" name="subcat_id" id="subcat_id" value="<?php echo $SubcategeryData['subcategory_id'] ?? null; ?>">
<div class="form-group form-actions">
  <div class="col-md-9">
    <button type="submit" class="btn btn-primary">SUBMIT
    &nbsp; <svg style="display: none;" class="spinner" width="30" height="30" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
      <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
    </svg>
    </button>
  </div>
                    </div>         
              </form>
            </div>
            <!-- /.card -->


          </div>

        
    <div class="clearfix"></div>

    
</div>
 
      
</div>
<!-- END Page Content -->
</div>
<?php 
  include('bottom.php');
  include('footer.php');
?>
<script src="<?php echo $SiteUrl; ?>admin/js/subcategory.js"></script>