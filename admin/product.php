<?php 
  include('inc/config.php');
  include 'inc/Authorize.php'; 
  include 'inc/functions.php';
  $PageTitle = ' Sub Categories | ';
  include('header.php');
  include('sidebar.php');
  include('topbar.php');  
?>
<div class="content-wrapper">
<h1>   Hello World</h1>

<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                <form id="ProductDetailForm" enctype="multipart/form-data" class="form-horizontal form-bordered">
 


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
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Add Product</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
</div>
<!-- content wrapper -->
<?php
  
  include('bottom.php');
  include('footer.php');
?>