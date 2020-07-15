<?php 
  include('inc/config.php');
  include 'inc/Authorize.php'; 
  $PageTitle = ' Vendor | ';
  include('header.php');
  include('sidebar.php');
  include('topbar.php');  
  $AllVendorQuery = mysqli_query($conn, "SELECT * FROM vendor WHERE del_status = 0 ORDER BY vendor_name ASC");
  
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
                            <div class="block-title vendor-wrapper row">
                                <div class="display-4 col-8">
                                    <strong>Vendor</strong> List
                                    &nbsp; <a href="javascript:;" class="btn btn-xs btn-danger btn-sm margin-right20 themebtn deleteall" style="display: none;">Delete All</a>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-2 pull-right">
                                <br/>
                                 <a href="<?php echo $SiteUrl ?>admin/manage_vendor.php" class="btn btn-info btn-sm margin-right20 themebtn"><i class="fa fa-plus"></i> Add Vendor</a>
                                </div>
                                
                            </div>

                          
                            
                            <div class="table-responsive">
                                <table id="example-datatable" class="text-center table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="allcheckbox" value=""></th>
                                            <th class="text-center">S.no</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Vendor Name</th>
                                            <th class="text-center">Status</th>
                    
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 
                                        <?php if (mysqli_num_rows($AllVendorQuery) > 0): $count = 1;?>
                                            <?php while($Vendor = mysqli_fetch_assoc($AllVendorQuery)): ?>
                                                 <tr>
                                                    <td class="text-center"><input type="checkbox" class="colcheckbox" name="colcheckbox[]" value="<?php echo $Vendor['vendor_id']; ?>"></td>
                                                    <td class="text-center"><?php echo $count;  ?></td>
                                                    <td class="text-center"><a href="javascript:void(0)">
<?php if ($Vendor['vendor_imgsm'] == null || !file_exists('../' . $Vendor['vendor_imgsm'])): ?>
     <small><strong>No Image Uploaded</strong></small>
    <?php else: ?>
        <img src="<?php echo $SiteUrl . $Vendor['vendor_imgsm']; ?>" alt="vendor Image" style="height: 30px; object-fit: cover;">
<?php endif ?>
                                                    </a></td>
                                                    <td class="text-center"><a href="javascript:void(0)"><?php echo $Vendor['vendor_name'] ?></a></td>
                                                    <td class="text-center"><label class="switch switch-success"><input type="checkbox" <?php echo $Vendor['vendor_status'] == 1 ? 'checked' : null; ?>  name="vendor_status" value="1" class="status" data-vendor_id="<?php echo $Vendor['vendor_id']; ?>"><span></span></label> </td>
                                               
                                                  
                                                    
<td class="text-center">
    <div class="btn-group">
        <a href="<?php echo $SiteUrl ?>admin/manage_Vendor.php?vendorid=<?php echo $Vendor['id']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pen"></i></a>
        <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger deletevendor" data-vendor_id="<?php echo $Vendor['id']; ?>" ><i class="fa fa-times"></i></a>
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
  <script src="<?php echo $SiteUrl; ?>admin/js/vendor.js"></script>
  <script src="<?php echo $SiteUrl; ?>admin/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>