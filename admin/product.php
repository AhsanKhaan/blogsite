<?php 
  include('inc/config.php');
  include 'inc/Authorize.php'; 
  include 'inc/functions.php';
  $PageTitle = ' Manage Products | ';
  include('header.php');
  include('sidebar.php');
  include('topbar.php');  
?>

<style>
.form_wrapper_inner, .form_wrapper_inner2 {padding: 8px 0px 14px 0px; background: #fbfbfb;border: 1px solid #f1f1f1; margin: 0px 0px 20px 0px; position: relative;}
 h3.maintitle {position: absolute;right: -57px;z-index: 999;transform: rotate(-90deg);text-transform: uppercase;font-weight: bold;color: #e7e7e7;font-size: 37px;top: 35px;background: #fff;padding: 0px 22px 0px 24px;border-top: 1px solid #eee; border-bottom: 1px solid #eee;}
.form_wrapper_inner input, .form_wrapper_inner select, .form_wrapper_inner2 input {border-radius: 0px; height: 26px;}
.form_wrapper_inner > div > div, .form_wrapper_inner2 > div > div {position: relative;}
.div.norightborder:after {content: unset;}
.norightborder {position: static;}
.form_wrapper_inner label, .form_wrapper_inner2 label {font-size: 11px;}
.form_wrapper_inner ::-webkit-input-placeholder, .form_wrapper_inner2 ::-webkit-input-placeholder {font-size: 10px; text-transform: uppercase;}
.form_wrapper_inner ::-moz-placeholder, .form_wrapper_inner2 ::-moz-placeholder {font-size: 10px; text-transform: uppercase;}
.form_wrapper_inner :-ms-input-placeholder, .form_wrapper_inner2 :-ms-input-placeholder {font-size: 10px; text-transform: uppercase;}
.form_wrapper_inner :-moz-placeholder, .form_wrapper_inner2 :-moz-placeholder {font-size: 10px; text-transform: uppercase;}
.form_wrapper_inner hr, .form_wrapper_inner2 hr {margin: 15px 0px 10px 0px ;}
.form_wrapper_inner > div > div:after, .form_wrapper_inner2 > div > div:after {content: '';position: absolute;top: 3px;right: -15px;border-right: 1px solid #ddd;width: 1px;height: 100%;}
 .widget-simple .widget-content {display: flex;align-items: center;justify-content: space-between; padding: 0px 5px 0px 15px;}
.widget-simple {padding: 0px 5px 0px 5px;}
.border-down:after{top: 13px !important;}
.product_sizes_addition_info > div {margin: 20px;}
.product_sizes_addition_info > div:nth-child(1) {flex-basis: 45%;}
.product_sizes_addition_info > div:nth-child(2) {flex-basis: 75%;}
.product_sizes_addition_info {display: flex;align-items: center;justify-content: space-evenly;}
 
 /*Cutting Margin*/
.set-margin-box {border: 1px solid #efefef;background-color: #f9f9f9;padding: 47px;display: block;vertical-align: middle;position: relative;}
.red-margin {border-color: #ff0707;color: #ff0707;background-color: #FFF;position: relative;}
.red-margin, .green-margin {border-width: 1px;border-style: dashed;}
.red-margin small {left: 5px;position: absolute;top: 5px;}
small, .small {font-size: 85%;}
.red-margin .top-margin, .red-margin .right-margin, .red-margin .bottom-margin, .red-margin .left-margin {position: absolute;}
.top-margin {width: 60px;top: -37px;margin: 0px auto;left: 0;right: 0;text-align: center;}
.grey {color: #777 !important;}
.no-margin {margin: 0 !important;}
.form-group select, .form-group textarea, .form-group input[type="text"], .form-group input[type="password"], .form-group input[type="datetime"], .form-group input[type="datetime-local"], .form-group input[type="date"], .form-group input[type="month"], .form-group input[type="time"], .form-group input[type="week"], .form-group input[type="number"], .form-group input[type="email"], .form-group input[type="url"], .form-group input[type="search"], .form-group input[type="tel"], .form-group input[type="color"] {
    background: #FFF;}
textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"] {border-radius: 0 !important;color: #858585;background-color: #fff;border: 1px solid #d5d5d5;padding: 5px 4px 6px;font-size: 14px;font-family: inherit;-webkit-box-shadow: none !important;box-shadow: none !important;-webkit-transition-duration: .1s;transition-duration: .1s;}
.input-mini {width: 60px;max-width: 100%;}
.right-margin, .left-margin {bottom: 0;height: 30px;left: auto;margin: auto;right: -30px;top: 0;}
.bottom-margin {width: 60px;bottom: -37px;margin: 0px auto;left: 0;right: 0;text-align: center;}
.left-margin {right: auto;left: -40px;}
.green-margin {border-color: #00cc33;color: #00cc33;height: 87px;margin: 35px 65px;position: relative;}
.red-margin, .green-margin {border-width: 1px;border-style: dashed;}
.red-margin small {left: 5px;position: absolute;top: 5px;}
.green-margin .top-margin {top: -15px;}
.green-margin .bottom-margin {bottom: -15px;}
 /*Cutting Margin*/

 .btns_wrapper {margin: 0px 0px 8px 0px;float: right;}
</style> 

<div class="content-wrapper">
 <h1>   Hello World</h1>

 <div class="col-md-12">
   <!-- general form elements -->
   <div class="card card-primary">
     <div class="card-header">
       <h3 class="card-title">Add Product Details</h3>
     </div>
      <!-- /.card-header -->
     <!-- card-body start -->
     <div class="card-body">
     <form id="ProductDetailForm" enctype="multipart/form-data" class="form-horizontal form-bordered">
   <div class="widget-simple themed-background-dark">
    <h4 class="widget-content widget-content-light" style="margin: 7px 0px;">
    <a style="display: flex; align-items: center;" href="javascript:void(0)" class="colorwhite uppercase"><strong> General &nbsp; </strong> Details :</a>
    </h4>
  </div>
<?php 
  if(isset($ProductData) && $ProductData['product_type'] == 'generalecommerce'){
    $Web2PrintFeatures = FALSE;
  }
?>
<?php $var;
//!$SubSubCategory ? $CatColClass = 6 : $CatColClass = 4 ; ?>

<!-- Category -->
<div class="row">
      <div class="col-md-6 form-group category-group">
      <label for="cat_dropdown">Category List : <span style="color:red"> * </span> </label>
            
            <?php 
                $CategoryQuery = mysqli_query($conn, "SELECT * FROM category WHERE category_status = 1");
                // echo "<pre>";
                // while($Category = mysqli_fetch_assoc($CategoryQuery)){
                //   var_dump($Category);
                // }
                // echo "</pre>";
                // exit();
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
          <!-- end col -->
          <!-- Subcategory -->
<div class="col-md-6">
  <div class="form-group subcategory-group">
    <label for="subcat_dropdown">Sub Category List : </label>
     <select name="subcategory" id="subcat_dropdown" style="width:100%;"class="form-control subcategorySelect select-chosen" data-placeholder="Select SubCategory.." style="width: 250px;">
            <?php $SubcategoryQuery = mysqli_query($conn, "SELECT subcategory_id,subcategory_name FROM subcategory WHERE subcategory_status = 1"); ?>
            
            <?php if (mysqli_num_rows($SubcategoryQuery) > 0 ): ?>
                <option value="Please Select Sub Category">Please Select Sub Category</option>
            <?php while($Subcategory = mysqli_fetch_assoc($SubcategoryQuery)): ?>
                <option <?php echo isset($ProductData['subcategory_id']) && $ProductData['subcategory_id'] == $Subcategory['subcategory_id'] ? 'selected' : null; ?> value="<?php echo $Subcategory['subcategory_id']; ?>"><?php echo $Subcategory['subcategory_name']; ?></option>
            <?php endwhile; ?>
            
            <?php else: ?>
                <option value=""></option>
            <?php if (!isset($pro) && empty($pro)): ?>
                <option value="">Please Select The Category First</option>
            <?php else: ?>
                <option value="">No Subcategories Are Active</option>
            <?php endif ?>
            <?php endif ?>
        </select>
  
  </div>
</div>
<!-- Subcategory -->

</div>
<!-- end row -->

<?php
  // $SubcategoryQuery = mysqli_query($conn, "SELECT * FROM subcategory WHERE subcategory_status = 1");
  // echo "<pre>"; 
  // while($Subcategory = mysqli_fetch_assoc($SubcategoryQuery)){
  //   var_dump($Subcategory);
  // }
  // echo "</pre>";
  // exit();
?>



<?php $var;// if ($SubSubCategory): ?>
<!-- Subsubcategory -->
<!-- <div class="col-xs-4">
  <div class="form-group">
    <label for="">Sub Sub Category List : </label>
     <?php $var;// $SubSubcategoryQuery = mysqli_query($conn, "SELECT * FROM subsubcategory WHERE sub_subcategory_status = 1"); ?>
        <select name="subsubcategory" class="subsubcategorySelect select-chosen" data-placeholder="Select Sub SubCategory.." style="width: 250px;">
      <?php $var;// if (mysqli_num_rows($SubSubcategoryQuery) > 0): ?>
          <option value=""></option>
      <?php $var;//while($SubSubcategory = mysqli_fetch_assoc($SubSubcategoryQuery)): ?>
          <option <?php $var;// echo isset($ProductData['subsubcategory_id']) && $ProductData['subsubcategory_id'] == $SubSubcategory['sub_subcategory_id'] ? 'selected' : null; ?> value="<?php echo $SubSubcategory['sub_subcategory_id']; ?>"><?php echo $SubSubcategory['sub_subcategory_name']; ?></option>
      <?php $var;// endwhile; ?>
      
      <?php $var; //else: ?>
          <option value=""></option>
          <option value="">No Subcategories Are Active</option>
      <?php $var;// endif ?>
    </select>
  </div>
</div> -->
<!-- Subsubcategory -->
<?php $var;// endif ?>

<?php $ColTitle='Product';?>
<div class="table_wrapper">

<table class="table_general table table-hover table-bordered text-center">
  <thead>
    <tr>
      <th class="text-center" width="30%">Product Details</th>
      <th class="text-center" width="60">Product Values</th>
      <th class="text-center" width="60">Image Size</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <td>Product Type : <span style="color:red">*</span></td>
        <td colspan="2">
          <select name="producttype" id="producttype" class="form-control">
 

<?php if (!isset($ProductData)): ?>
	<option value="web2print">Product Web 2 Print</option>
	<option value="generalecommerce">General Ecommerce</option>
<?php else: ?>
	<option value="<?php echo $ProductData['product_type']; ?>"><?php echo ($ProductData['product_type'] == 'generalecommerce' ? 'General Ecommerce' : 'Product Web 2 Print'); ?></option>
<?php endif ?>
          </select>
        </td>
      </tr>

      <tr>
        <td>Name : <span style="color:red">*</span></td>
        <td colspan="2">
          <input type="text" name="<?php echo $ColTitle ?>_name" class="form-control" value="<?php echo $ProductData['proname'] ?? null; ?>" maxlength="250">
        </td>
      </tr>

      <tr>
        <td><?php echo ucwords($ColTitle); ?> URL :</td>
        <td colspan="2">
          <input type="text" name="<?php echo $ColTitle ?>_url" class="form-control" value="<?php echo $ProductData['url_link'] ?? null; ?>">
        </td>
      </tr>


    <tr id="filerow">
      <td>Image :</td>
      <td><input id="productimg" type="file" name="productimg" class="form-control" value="">
    </td>
    <td> <strong>(600px, 600px)</strong> </td>
  </tr>
  <tr>
    <td>Image Title: </td>
    <td colspan="2"><input  type="text" name="alttitle" class="form-control" value="<?php echo $ProductData['alttitle'] ?? null; ?>"></td>
  </tr>

  <tr>
    <td>SKU Code :</td>
    <td colspan="2">
       <input type="text" id="<?php echo $ColTitle; ?>_skucode" name="<?php echo $ColTitle; ?>_skucode" class="form-control" placeholder="Sku Code" value="<?php echo $ProductData['skucode'] ?? null; ?>">
    </td>
  </tr>

<?php 
  if(!isset($Web2PrintFeatures) || $Web2PrintFeatures === TRUE){
    $Web2PrintTR = 'style="display:table-row"';
    $EcommerceTR = 'style="display:none"';
    $EcommerceDiv = 'style="display:none"';
  }else{
    $Web2PrintTR = 'style="display:none"';
    $EcommerceTR = 'style="display:table-row"';
    $EcommerceDiv = 'style="display:block"';
  }
?>





<tr class="web2print_tr" <?php echo $Web2PrintTR; ?>>
   <td>Price Type: <span style="color:red">*</span></td>
   <td colspan="2">
       <select name="<?php echo $ColTitle; ?>_pricetype" id="<?php echo $ColTitle; ?>_pricetype" class="form-control">
          <option value="">Please Select Price Type</option>
          <option value="fixed" <?php echo isset($ProductData['price']) && $ProductData['price'] == 'fixed' ? 'selected' : null; ?>>Fixed Quantity Price</option>
          <option value="rangemultiplication" <?php echo isset($ProductData['price']) && $ProductData['price'] == 'rangemultiplication' ? 'selected' : null; ?>>Range Based With Multiplication</option>
          <option value="rangenotmultiplication" <?php echo isset($ProductData['price']) && $ProductData['price'] == 'rangenotmultiplication' ? 'selected' : null; ?>>Range Based With Out Multiplication</option>
          <?php if (!isset($ProductData) || ($ProductData['price'] != 'fixed' && $ProductData['price'] != 'rangemultiplication' && $ProductData['price'] != 'rangenotmultiplication')): ?>
            <option value="customsizeproduct" <?php echo isset($ProductData['price']) && $ProductData['price'] == 'customsizeproduct' ? 'selected' : null; ?>>Size Based Price Dynamic Size (Custom Products)</option>
          <?php endif ?>
      </select>
   </td>
</tr> 
        
<tr class="general_ecommerce_tr" <?php echo $EcommerceTR; ?>>
   <td>Price : <span style="color:red">*</span></td>
   <td colspan="2">
     <div class="input-group" style="width: 100%;">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
          <input type="text" id="product_price" name="price" class="form-control" placeholder="Product Price" value="<?php echo $ProductData['price'] ?? null; ?>">
          <span class="input-group-addon">.00</span>
      </div>
  </td>
</tr>


  
 
 

    <tr class="general_ecommerce_tr" <?php echo $EcommerceTR; ?>>
      <td><?php echo ucwords($ColTitle); ?> Quantity </td>
      <td colspan="2"> 
          <input type="text" class="form-control" name="<?php echo $ColTitle; ?>_quantity" id="<?php echo $ColTitle; ?>_quantity" placeholder="<?php echo ucwords($ColTitle); ?> Quantity" value="<?php echo $ProductData['pro_qty'] ?? null; ?>">
      </td>
    </tr>
    <tr class="general_ecommerce_tr" <?php echo $EcommerceTR; ?>>
      <td><?php echo ucwords($ColTitle); ?> Deals </td>
      <td colspan="2">
          <select name="<?php echo $ColTitle; ?>_deals" id="<?php echo $ColTitle; ?>_deals" class="form-control">
              <option <?php echo isset($ProductData) && $ProductData['deals'] == 'inactive' ? 'selected' : null; ?> value="inactive">Inactive</option>
              <option <?php echo isset($ProductData) && $ProductData['deals'] == 'active' ? 'selected' : null; ?> value="active">Active</option>
          </select>
      </td>
    </tr>


    <tr class="dealsduration" style="display: none;">
      <td>Deals Duration</td>
      <td colspan="2">
        <div class="input-group input-daterange" data-date-format="dd/mm/yyyy" style="width: 100%;">
<?php 
if(isset($ProductData['deals_s_date']) && !empty($ProductData['deals_s_date'])){
  $DealStart = explode('/', $ProductData['deals_s_date']);
  $DateStart = (new DateTime)->setDate($DealStart[2], $DealStart[1], $DealStart[0]);
  $DateStart = $DateStart->format('d/m/Y');
}else{
  $DateStart = null;
}
?>
<input type="text" id="dealsstart" name="dealsstart" class="form-control text-center" placeholder="Deal Start" value="<?php echo  $DateStart; ?>">
<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
<?php 
if(isset($ProductData['deals_e_date']) && !empty($ProductData['deals_e_date'])){
  $DealEnd = explode('/', $ProductData['deals_e_date']);
  $DateEnd = (new DateTime)->setDate($DealEnd[2], $DealEnd[1], $DealEnd[0]);
  $DateEnd = $DateEnd->format('d/m/Y');
}else{
  $DateEnd = null;
}
?>
<input type="text" id="dealend" name="dealend" class="form-control text-center" placeholder="Deal End" value="<?php echo $DateEnd ?? null; ?>">

        </div>
      </td>
    </tr>
   <tr class="general_ecommerce_tr" <?php echo $EcommerceTR; ?>>
     <td>Select Brands</td>
     <td colspan="2">
          <select name="brands" id="brands" class="form-control">
              <option value="">Select Brands</option>
          </select>
     </td>
   </tr>

   <tr class="general_ecommerce_tr" <?php echo $EcommerceTR; ?>>
     <td>Discount Price</td>
     <td colspan="2">
        <input type="text" class="form-control" placeholder="Discount Price"  name="discount" value="<?php echo $ProductData['d_price'] ?? null; ?>">
     </td>
   </tr>


 

 <tr>
   <td>Sort Order: </td>
   <td colspan="2">
        <input type="text" id="<?php echo $ColTitle; ?>_sortorder" name="<?php echo $ColTitle; ?>_sortorder" class="form-control" placeholder="Sort Order" value="<?php echo $ProductData['sort_order'] ?? null; ?>">
   </td>
 </tr>



 <tr>
   <td>Home Display: </td>
   <td colspan="2">
        <select name="best_seller" id="best_seller" class="form-control">
          <option <?php echo isset($ProductData) && $ProductData['best_seller'] == 0 ? 'selected' : null; ?> value="0" >Inactive</option>
          <option <?php echo isset($ProductData) && $ProductData['best_seller'] == 1 ? 'selected' : null; ?> value="1" >Active</option>
        </select>
   </td>
 </tr>
 

  

 <tr>
   <td>Short Description: </td>
   <td colspan="2">
      <textarea id="<?php echo $ColTitle; ?>_shortdesc" name="<?php echo $ColTitle; ?>_shortdesc" rows="3" class="form-control" placeholder="Short Description" maxlength="495"><?php echo isset($ProductData['shortdisc']) ? stripslashes($ProductData['shortdisc']) : null; ?></textarea>
   </td>
 </tr>

<tr>
    <td colspan="3">Long Discrption</td>
</tr>

<tr>
  <td  colspan="3">
 

    <textarea id="textarea-ckeditor" rows="7" name="<?php echo $ColTitle; ?>_longdesc" class="ckeditor form-control" placeholder="Long Description"><?php echo isset($ProductData['longdisc']) ? stripslashes($ProductData['longdisc']) : null; ?></textarea>
  </td>
</tr>


<tr>
  <td>Meta Title</td>
  <td colspan="2">
      <input type="text" id="metatitle" name="metatitle" class="form-control" placeholder="Meta Title" value="<?php echo $ProductData['metatitle'] ?? null; ?>"  maxlength="250">
  </td>
</tr>


<tr>
  <td>Meta Description</td>
  <td colspan="2">
       <textarea id="metadesc" name="metadesc" rows="3" class="form-control" placeholder="Meta Description" maxlength="250"><?php echo $ProductData['metadisc'] ?? null; ?></textarea>
  </td>
</tr>


<tr>
  <td>Meta Keyword</td>
  <td colspan="2">
      <textarea id="metakeyword" name="metakeyword" rows="3" class="form-control" placeholder="Meta Keyword" maxlength="250"><?php echo $ProductData['metakeyword'] ?? null; ?></textarea>
  </td>
</tr>

    <!-- <input type="hidden" name="csrf" id="csrf" value="<?php //echo GenerateCSRF();  ?>"> -->
    <input type="hidden" name="<?php echo $ColTitle; ?>_id" id="<?php echo $ColTitle; ?>_id" value="<?php echo $ProductData['id'] ?? null; ?>">
    <input type="hidden" name="action" id="" value="ProductSubmit">


  <tr>
    <td colspan="3">
        <?php $ButtonText = 'Submit'; ?>
        <?php $SubmitBTNClass = ' Add_Menu_Btn form-control submitcategory '; ?>
        <?php include('inc/spinnerbutton.php'); ?>
    </td>
  </tr>
</tbody>
</table>
            </div>                    
                </form>
            
     </div>
     <!-- /.card body-->
    </div>
    <!-- CARD END -->
  </div>
  <!-- col-ends -->
</div>
<!-- content wrapper -->
<script src="<?php echo $SiteUrl; ?>admin/js/productecommerce.js"></script>
<?php
  
  include('bottom.php');
  include('footer.php');
?>