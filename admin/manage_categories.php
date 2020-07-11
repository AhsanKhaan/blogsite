<?php 
  include('inc/config.php');
  include('inc/functions.php');
  include 'inc/Authorize.php'; 
  $PageTitle = ' Manage Categories | ';
  include('header.php');
  include('topbar.php');
  include('sidebar.php');
  
?>
<?php if (isset($_GET['catid'])): ?>
    <?php 
        $catid = preg_replace('/[^0-9]/', '-', $_GET['catid']);
        $CategeryData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE category_id = ".$catid.""));
        if(!isset($CategeryData)){
            echo '<script> window.location = "'.$SiteUrl.'admin/categories.php"; </script>';
            exit();
        }
     ?>
<?php endif ?> 
<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manage Categories</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo $SiteUrl; ?>admin/dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Categories Form</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
 
<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Manage Catetegories Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="categoryform" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="card-body">
<div class="row">
	<div class="col-md-3">
		<div class="form-group name-group">
			<label class="" for="cat_image">Category Image</label>
			<div class="">
				<input type="file" id="cat_image" name="cat_image" value="">
			</div>
		</div>
	</div>
	
	<div class="col-md-6 catname-group">
		<div class="form-group catname-group">
			<label class="control-label" for="cat_name">Category Name</label>
				<input type="text" <?php echo TypeLength(); ?> id="cat_name" name="cat_name" class="form-control" placeholder="Category Name" value="<?php echo $CategeryData['category_name'] ?? null; ?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group name-group">
			<label class="" for="cat_image">Category Price <small style="color:red;"><strong>(Percentage)</strong></small></label>
			<input type="text" id="cat_price" name="cat_price" class="form-control" placeholder="Category Price" value="<?php echo $CategeryData['price'] ?? null; ?>">
		</div>
	</div>

<div class="col-md-6">
    <div class="form-group name-group">
        <label class="control-label" for="cat_slug">Category Slug</label>
            <input type="text" <?php echo TypeLength(); ?> id="cat_slug" name="cat_slug" class="form-control" placeholder="Category Slug" value="<?php echo $CategeryData['category_slug'] ?? null; ?>">
    </div>
</div>

<div class="col-md-6">
     <div class="form-group name-group">
        <label class="control-label" for="cat_salecaption">Sale Caption</label>
       
            <input type="text" <?php echo TypeLength(); ?> id="cat_salecaption" name="cat_salecaption" class="form-control" placeholder="Sale Caption" value="<?php echo $CategeryData['category_salecaption'] ?? null; ?>">

    </div>
</div>

<div class="col-md-6">
        
         <label class="control-label" for="cat_sortorder">Sort Order</label>
        
            <input type="text" id="cat_sortorder" name="cat_sortorder" class="form-control" placeholder="Sort Order" value="<?php echo $CategeryData['category_sort'] ?? null; ?>">
        
    </div>


<div class="col-md-3">
	<div class="form-group">
		<label for=""></label>
		<div class="custom-control custom-checkbox">
          <input class="custom-control-input" type="checkbox" <?php echo isset($CategeryData['category_status']) &&  $CategeryData['category_status'] == 1 ? 'checked' : null; ?>  name="cat_status" value="1">
          <label for="customCheckbox2" class="custom-control-label">Category Status</label>
        </div>
		  
                        
	</div>
</div>


<div class="col-md-3">
	<div class="form-group">
		<label for=""></label>
		<div class="custom-control custom-checkbox">
          <input class="custom-control-input" type="checkbox" name="cat_displayhome" value="1" <?php echo isset($CategeryData['category_displayhome']) &&  $CategeryData['category_displayhome'] == 1 ? 'checked' : null; ?>>
          <label for="customCheckbox1" class="custom-control-label">Display On Home</label>
        </div>               
	</div>
</div>

<div class="col-md-12">
	<div class="form-group">
	 <label class="control-label" for="cat_shortdesc">Short Description</label>
  
      <textarea id="cat_shortdesc" name="cat_shortdesc" rows="3" class="form-control" placeholder="Short Description" <?php echo TypeLength(490); ?>><?php echo $CategeryData['category_shortdesc'] ?? null; ?></textarea>
    </div>
</div>


<div class="col-md-12">
	<div class="form-group">
  <label class="control-label" for="cat_longdesc">Long Description</label>
      
    <textarea id="textarea-ckeditor" rows="7" name="cat_longdesc" class="textarea form-control" placeholder="Long Description"><?php echo isset($CategeryData['category_longdesc']) ? stripslashes($CategeryData['category_longdesc']) : null; ?></textarea>
        </div>
    
</div>



<div class="col-md-12">
	  <div class="form-group name-group">
            <label class="control-label" for="metatitle">Meta Title</label>
                <input type="text" <?php echo TypeLength(); ?> id="metatitle" name="metatitle" class="form-control" placeholder="Meta Title" value="<?php echo $CategeryData['title'] ?? null; ?>">
        </div>
	</div>

	<div class="col-md-12">
		   <div class="form-group name-group">
                        <label class="control-label" for="metadesc">Meta Description</label>
                        
                          <textarea <?php echo TypeLength(); ?> id="metadesc" name="metadesc" rows="3" class="form-control" placeholder="Meta Description"><?php echo $CategeryData['description'] ?? null; ?></textarea>
                        
                    </div>
	</div>

	<div class="col-md-12">
		  <div class="form-group name-group">
                        <label class="control-label" for="metakeyword">Meta Keyword</label>
                        
                          <textarea <?php echo TypeLength(); ?> id="metakeyword" name="metakeyword" rows="3" class="form-control" placeholder="Meta Keyword"><?php echo $CategeryData['keyword'] ?? null; ?></textarea>
                        
                    </div>
	</div>
</div>
                   


                   
                     

                   
 
               <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $CategeryData['category_id'] ?? null; ?>">
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
<script src="<?php echo $SiteUrl; ?>admin/js/category.js"></script>