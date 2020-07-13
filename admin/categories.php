<?php 
  include('inc/config.php');
  include 'inc/Authorize.php'; 
  $PageTitle = ' Categories | ';
  include('header.php');
  include('sidebar.php');
  include('topbar.php');  
  $AllCategoriesQuery = mysqli_query($conn, "SELECT * FROM category WHERE del_status = 0 ORDER BY category_sort ASC");
  
?>
<style>
    .table thead > tr > th {font-size: 13px;font-weight: 600;padding: 10px !important;}
    .swal2-container {transform: scale(1.7);}
</style>
    
   <div class="content-wrapper">
   <div id="page-content">
    <!-- <div class="content-header">
        <div class="header-section">
            <h1>
                  <strong>All</strong> Categories
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li><a href="">Categories</a></li>
    </ul> -->

        <div class="col-md-12">
                <!-- END Form Elements Title -->
                   <!-- Datatables Content -->
                        <div class="block full">
                            <div class="block-title category-wrapper row">
                                <div class="display-4 col-8">
                                    <strong>Categories</strong> List
                                    &nbsp; <a href="javascript:;" class="btn btn-xs btn-danger btn-sm margin-right20 themebtn deleteall" style="display: none;">Delete All</a>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-2 pull-right">
                                <br/>
                                 <a href="<?php echo $SiteUrl ?>admin/manage_categories.php" class="btn btn-info btn-sm margin-right20 themebtn"><i class="fa fa-plus"></i> Add Category</a>
                                </div>
                                
                            </div>

                          
                            
                            <div class="table-responsive">
                                <table id="example-datatable" class="text-center table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="allcheckbox" value=""></th>
                                            <th class="text-center">S.no</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Home Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($AllCategoriesQuery) > 0): $count = 1;?>
                                            <?php while($Categories = mysqli_fetch_assoc($AllCategoriesQuery)): ?>
                                                 <tr>
                                                    <td class="text-center"><input type="checkbox" class="colcheckbox" name="colcheckbox[]" value="<?php echo $Categories['category_id']; ?>"></td>
                                                    <td class="text-center"><?php echo $count;  ?></td>
                                                    <td class="text-center"><a href="javascript:void(0)">
<?php if ($Categories['category_imgsm'] == null || !file_exists('../' . $Categories['category_imgsm'])): ?>
     <small><strong>No Image Uploaded</strong></small>
    <?php else: ?>
        <img src="<?php echo $SiteUrl . $Categories['category_imgsm']; ?>" alt="Category Image" style="height: 30px; object-fit: cover;">
<?php endif ?>
                                                    </a></td>
                                                    <td class="text-center"><a href="javascript:void(0)"><?php echo $Categories['category_name'] ?></a></td>
                                                    <td class="text-center"><label class="switch switch-success"><input type="checkbox" <?php echo $Categories['category_status'] == 1 ? 'checked' : null; ?>  name="cat_status" value="1" class="status" data-cat_id="<?php echo $Categories['category_id']; ?>"><span></span></label> </td>
                                               
                                                    <td class="text-center">
                                                         <label class="switch switch-success"><input type="checkbox" name="cat_displayhome" value="1" <?php echo $Categories['category_displayhome'] == 1 ? 'checked' : null; ?> class="display_status" data-cat_id="<?php echo $Categories['category_id']; ?>"><span></span></label>
                                                    </td>
                                                    
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="<?php echo $SiteUrl ?>admin/manage_categories.php?catid=<?php echo $Categories['category_id']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger deletecategory" data-cat_id="<?php echo $Categories['category_id']; ?>" ><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $count++; endwhile; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->
             
            <!-- END Basic Form Elements Block -->
        </div>
    <div class="clearfix"></div>
</div>
<!-- END Page Content -->
  </div>           



<?php
  
  include('bottom.php');
  include('footer.php');
?>
  <script src="<?php echo $SiteUrl; ?>admin/js/sweetalert2.js"></script>
  <script src="<?php echo $SiteUrl; ?>admin/js/category.js"></script>
  <script src="<?php echo $SiteUrl; ?>admin/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>