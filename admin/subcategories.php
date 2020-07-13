<?php 
  include('inc/config.php');
  include 'inc/Authorize.php'; 
  include 'inc/functions.php';
  $PageTitle = ' Sub Categories | ';
  include('header.php');
  include('sidebar.php');
  include('topbar.php');  
  $AllSubCategoriesQuery = mysqli_query($conn, "SELECT t1.*, t2.category_name FROM subcategory as t1 INNER JOIN category as t2 on t1.category_id = t2.category_id WHERE t1.del_status = 0 ORDER BY t1.subcategory_sort ASC");
?>
<style>
    .table thead > tr > th {font-size: 13px;font-weight: 600;padding: 10px !important;}
    .swal2-container {transform: scale(1.7);}
</style>
<!-- used for aligning data after sidebar -->
<div class="content-wrapper">
    <!-- Page content -->
<div id="page-content">
    <!-- <div class="content-header">
        <div class="header-section">
            <h1>
                  <strong>All</strong> SubCategories
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li><a href="javacscript:;">Subcategories</a></li>
    </ul> -->

        <div class="col-md-12">
                <!-- END Form Elements Title -->
                   <!-- Datatables Content -->
                        <div class="block full">
                            <div class="block-title category-wrapper row">
                                <h2 class="col-6">
                                    <strong>Sub Categories</strong> List
                                    &nbsp; <a href="javascript:;" class="btn btn-xs btn-danger btn-sm margin-right20 themebtn deleteall" style="display: none;">Delete All</a>
                                </h2>
                                <div class="col-4"></div>
                                <div class="col-2">
                                 
                                 <a href="<?php echo $SiteUrl ?>admin/manage_subcategories.php" style="margin-top:10px;" class="btn btn-info btn-sm margin-right20 themebtn"> <i class="fa fa-plus"></i> Add Sub Category</a>
                                </div>
                                
                            </div>

                          
                            
                            <div class="table-responsive">
                                <table id="example-datatable" class="text-center table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="allcheckbox" value=""></th>
                                            <th class="text-center">S.no</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Category Name</th>
                                            <th class="text-center">Subcategory Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($AllSubCategoriesQuery) > 0): $count = 1;?>
                                            <?php while($Subcategories = mysqli_fetch_assoc($AllSubCategoriesQuery)): ?>
                                                 <tr>
                                                    <td class="text-center"><input type="checkbox" class="colcheckbox" name="colcheckbox[]" value="<?php echo $Subcategories['subcategory_id']; ?>"></td>
                                                    <td class="text-center"><?php echo $count;  ?></td>
                                                    <td class="text-center"><a href="javascript:void(0)">
                                <?php if ($Subcategories['subcategory_imgsm'] == null || !file_exists('../' . $Subcategories['subcategory_imgsm'])): ?>
                                     <small><strong>No Image Uploaded</strong></small>
                                    <?php else: ?>
                                        <img src="<?php echo $SiteUrl . $Subcategories['subcategory_imgsm']; ?>" alt="Subcategory Image" style="height: 30px; object-fit: cover;">
                                <?php endif ?>
                                                    </a></td>
                                                    <td class="text-center"><a href="javascript:void(0)"><?php echo $Subcategories['category_name'] ?></a></td>
                                                    <td class="text-center"><a href="javascript:void(0)"><?php echo $Subcategories['subcategory_name'] ?></a></td>
                                                    <td class="text-center"><label class="switch switch-success"><input type="checkbox" <?php echo $Subcategories['subcategory_status'] == 1 ? 'checked' : null; ?>  name="cat_status" value="1" class="status" data-subcat_id="<?php echo $Subcategories['subcategory_id']; ?>"><span></span></label> </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="<?php echo $SiteUrl ?>admin/manage_subcategories.php?subcatid=<?php echo $Subcategories['subcategory_id']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pen"></i></a>
                                                           
                                                               <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger deletesubcategory" data-subcat_id="<?php echo $Subcategories['subcategory_id']; ?>" ><i class="fa fa-times"></i></a>
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
<!-- ends content wrapper -->
<?php
  
  include('bottom.php');
  include('footer.php');
?>
<script src="<?php echo $SiteUrl; ?>admin/js/sweetalert2.js"></script>
<script src="<?php echo $SiteUrl; ?>admin/js/subcategory.js"></script>
<script src="<?php echo $SiteUrl; ?>admin/js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>