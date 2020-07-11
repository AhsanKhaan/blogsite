<?php 
  include('inc/config.php');
  include('inc/functions.php');
  include 'inc/Authorize.php'; 
  $PageTitle = ' Dashboard | ';
  include('header.php');
  include('topbar.php');
  include('sidebar.php');
  
?>
   <!-- Page content -->

    <div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="header-section">
            <?php if (isset($_GET['catid'])): ?>
                <?php 
                    $catid = preg_replace('/[^0-9]/', '-', $_GET['catid']);
                    $CategeryData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE category_id = ".$catid.""));
                    if(!isset($CategeryData)){
                        echo '<script> window.location = "'.$SiteUrl.'admin/categories.php"; </script>';
                        exit();
                    }
                 ?>
                <h1>
                      <strong><?php echo $CategeryData['category_name']; ?></strong> Category
                </h1>
                <?php else: ?>
                <h1>
                      <strong>Add New</strong> Category
                </h1>
            <?php endif ?>
        </div>
  
    <ul class="breadcrumb breadcrumb-top">
        <li>Categories</li>
        <li><a href="">Manage Categories</a></li>
    </ul>
   

        <div class="col-md-12">
            <!-- Basic Form Elements Block -->
            <div class="block">
                <!-- Basic Form Elements Title -->
                <div class="block-title">
                    <h2><strong>Category </strong> Settings</h2>
                </div>
                <!-- END Form Elements Title -->

                <!-- Basic Form Elements Content -->
                <form id="categoryform" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="cat_image">Category Image</label>
                        <div class="col-md-9">
                            <input type="file" id="cat_image" name="cat_image" value="">
                        </div>
                    </div>

                    <div class="form-group catname-group">
                        <label class="col-md-3 control-label" for="cat_name">Category Name</label>
                        <div class="col-md-9">
                            <input type="text" <?php echo TypeLength(); ?> id="cat_name" name="cat_name" class="form-control" placeholder="Category Name" value="<?php echo $CategeryData['category_name'] ?? null; ?>">
                        </div>
                    </div>

                    <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="cat_slug">Category Slug</label>
                        <div class="col-md-9">
                            <input type="text" <?php echo TypeLength(); ?> id="cat_slug" name="cat_slug" class="form-control" placeholder="Category Slug" value="<?php echo $CategeryData['category_slug'] ?? null; ?>">
                        </div>
                    </div>

                     <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="cat_salecaption">Sale Caption</label>
                        <div class="col-md-3">
                            <input type="text" <?php echo TypeLength(); ?> id="cat_salecaption" name="cat_salecaption" class="form-control" placeholder="Sale Caption" value="<?php echo $CategeryData['category_salecaption'] ?? null; ?>">
                        </div>
                         <label class="col-md-3 control-label" for="cat_sortorder">Sort Order</label>
                        <div class="col-md-3">
                            <input type="text" id="cat_sortorder" name="cat_sortorder" class="form-control" placeholder="Sort Order" value="<?php echo $CategeryData['category_sort'] ?? null; ?>">
                        </div>
                    </div>
 

                     <div class="form-group name-group">
                        <label class="col-md-3 control-label">Category Status</label>
                        <div class="col-md-3">
                              <label class="switch switch-success"><input type="checkbox" <?php echo isset($CategeryData['category_status']) &&  $CategeryData['category_status'] == 1 ? 'checked' : null; ?>  name="cat_status" value="1"><span></span></label>
                        </div>

                         <label class="col-md-3 control-label">Display On Home</label>
                        <div class="col-md-3">
                              <label class="switch switch-success"><input type="checkbox" name="cat_displayhome" value="1" <?php echo isset($CategeryData['category_displayhome']) &&  $CategeryData['category_displayhome'] == 1 ? 'checked' : null; ?>><span></span></label>
                        </div>
                    </div>


                     <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="cat_shortdesc">Short Description</label>
                        <div class="col-md-9">
                          <textarea id="cat_shortdesc" name="cat_shortdesc" rows="3" class="form-control" placeholder="Short Description" <?php echo TypeLength(490); ?>><?php echo $CategeryData['category_shortdesc'] ?? null; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="cat_longdesc">Long Description</label>
                        <div class="col-md-9">
                            <textarea id="textarea-ckeditor" rows="7" name="cat_longdesc" class="ckeditor form-control" placeholder="Long Description"><?php echo isset($CategeryData['category_longdesc']) ? stripslashes($CategeryData['category_longdesc']) : null; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="metatitle">Meta Title</label>
                        <div class="col-md-9">
                            <input type="text" <?php echo TypeLength(); ?> id="metatitle" name="metatitle" class="form-control" placeholder="Meta Title" value="<?php echo $CategeryData['title'] ?? null; ?>">
                        </div>
                    </div>

                    <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="metadesc">Meta Description</label>
                        <div class="col-md-9">
                          <textarea <?php echo TypeLength(); ?> id="metadesc" name="metadesc" rows="3" class="form-control" placeholder="Meta Description"><?php echo $CategeryData['description'] ?? null; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group name-group">
                        <label class="col-md-3 control-label" for="metakeyword">Meta Keyword</label>
                        <div class="col-md-9">
                          <textarea <?php echo TypeLength(); ?> id="metakeyword" name="metakeyword" rows="3" class="form-control" placeholder="Meta Keyword"><?php echo $CategeryData['keyword'] ?? null; ?></textarea>
                        </div>
                    </div>
                    
               <input type="hidden" name="csrf" id="csrf" value="<?php echo GenerateCSRF();  ?>">
               <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $CategeryData['category_id'] ?? null; ?>">
                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                          <?php $ButtonText = 'Submit'; ?>
                          <?php include('inc/spinnerbutton.php'); ?>
                        </div>
                    </div>
                </form>
                <!-- END Basic Form Elements Content -->
            </div>
            <!-- END Basic Form Elements Block -->
        </div>
    </div>
    </div>
    </div>
    <div class="clearfix"></div>

<!-- END Page Content -->



<?php 
  include('bottom.php');
  include('footer.php');
?>