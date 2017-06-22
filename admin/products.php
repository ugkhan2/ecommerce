<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/e-commerce/core/init.php';
	require_once '../core/init.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include 'includes/head.php';
	include 'includes/navigation.php';
	// Delete comment
	if (isset($_GET['delete'])) {
		$id = sanitize($_GET['delete']);
		$db->query("UPDATE products SET deleted=1 WHERE id='$id'");
		header('Location: products.php');
	}
	$dbpath='';

	if (isset($_GET['add']) || isset($_GET['edit'])) {
		// When Add product is clicked.
		$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
		$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
		$title=((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
		$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
		$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
		$category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
		$price=((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
		$list_price=((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
		$description=((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
		$sizes=((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):'');
		$sizes = rtrim($sizes, ',');
		$saved_image = '';

		if (isset($_GET['edit'])){
			$edit_id= (int)$_GET['edit'];
			$product_edit_result= $db->query("SELECT * FROM products WHERE id = '$edit_id'");
			$products_array_from_database = mysqli_fetch_assoc($product_edit_result);
			if (isset($_GET['delete_image'])) {
				$imgi = (int)$_GET['imgi'] - 1;
				$images = explode(',',$products_array_from_database['image']);
				$image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imgi];
				unlink($image_url);
				unset($images[$imgi]);
				$imageString = implode(',', $images);
				$db->query("UPDATE products SET image = '{$imageString}' WHERE id = '{$edit_id}'");
				header('Location: products.php?edit='.$edit_id);
			}
			$category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$products_array_from_database['categories']);
			$title=((isset($_POST['title']) && !empty($_POST['title']))?sanitize($_POST['title']):$products_array_from_database['title']);
			$brand=((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):$products_array_from_database['brand']);
			$parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
			$parentResult = mysqli_fetch_assoc($parentQ);
			$parent=((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):$parentResult['parent']);	
			$price=((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):$products_array_from_database['price']);
			$list_price=((isset($_POST['list_price']))?sanitize($_POST['list_price']):$products_array_from_database['list_price']);
			$description=((isset($_POST['description']))?sanitize($_POST['description']):$products_array_from_database['description']);
			$sizes=((isset($_POST['sizes']) && !empty($_POST['sizes']))?sanitize($_POST['sizes']):$products_array_from_database['sizes']);
			$sizes = rtrim($sizes, ',');
			$saved_image = (($products_array_from_database['image'] != '')?$products_array_from_database['image']:'');
			$dbpath = $saved_image;
		}

		if (!empty($sizes)) {
			$sizeString = sanitize($sizes);
			$sizeString = rtrim($sizeString,',');
			$sizesArray = explode(',', $sizeString);
			$sArray=array();
			$qArray = array();
			$tArray = array();
			foreach ($sizesArray as $ss) {
				$s=explode(':', $ss);
				$sArray[] = $s[0];
				$qArray[] = $s[1];
				$tArray[] = $s[2];
			}
		}else{$sizesArray = array();}
		
		if ($_POST) {
			$errors=array();
			$required = array('title','brand', 'price', 'parent', 'child', 'sizes');
			$allowed = array('png', 'jpg', 'jpeg', 'gif');
			$uploadPath = array();
			$tempLoc = array();
			foreach ($required as $field) {
				if ($_POST[$field]=='') {
					$errors[]='All fields with an Asterisk are required!';
					break;
				}
			}

			
			$photoCount = count($_FILES['photo']['name']);
			 if ($photoCount > 0) {
			 	for ($i=0; $i < $photoCount; $i++) { 
				// 	$photo = $_FILES['photo'];
				 	$name=$_FILES['photo']['name'][$i];
				 	$nameArray=explode('.', $name);
					$fileName= $nameArray[0];
					$fileExt = $nameArray[1];
					$mime = explode('/', $_FILES['photo']['type'][$i]);
					$mimeType = $mime[0];
					$mimeExt = $mime[1];
				 	$tempLoc[] = $_FILES['photo']['tmp_name'][$i];
				 	$FileSize =  $_FILES['photo']['size'][$i];
					$uploadName= md5(microtime().$i).'.'.$fileExt;
					$uploadPath[] = BASEURL.'img/products/'.$uploadName;
					if ($i != 0) {
						$dbpath .= ',';
					}
				 	$dbpath .= '/e-commerce/img/products/'.$uploadName;
					if ($mimeType !='image') {
						$errors[]='The file must be an Image';
					}
					if (!in_array($fileExt, $allowed)) {
						$errors[]='The Photo extention must be .png, .jpg, .jpeg or .gif format!';
					}
					if ($FileSize>15000000) {
						$errors[]='The file must be under 15MB!';
					}
			 	}
				
			}
			if (!empty($errors)) {
				echo display_errors($errors);
			}else{
					// Upload file and Update Database....
				if ($photoCount > 0) {
					for ($i=0; $i < $photoCount; $i++) { 
						move_uploaded_file($tempLoc[$i], $uploadPath[$i]);
					}					
				}
				$insertSql = "INSERT INTO products (title, price, list_price, brand, categories, image, description, sizes) VALUES ('$title','$price', '$list_price', '$brand', '$category', '$dbpath', '$description', '$sizes' )";
				if (isset($_GET['edit'])){
					//echo "$title $price $list_price $brand $category $dbpath $sizes $description $edit_id";
					$insertSql="UPDATE products SET title='$title', price='$price', list_price='$list_price', brand='$brand', categories='$category', image= '$dbpath', sizes='$sizes', description='$description' WHERE `id`='$edit_id'";
				}
				$db->query($insertSql);
				header('Location: products.php');
			}
		}
?>

<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add A New');?> Product</h2><hr>
<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST" enctype="multipart/form-data">
	<div class="form-group col-md-3">
		<label for="title">Title*</label>
		<input type="text" name="title" class="form-control" id="title" value="<?=$title?>">
	</div>
	<div class="form-group col-md-3">
		<label for="brand">Brand*</label>
		<select name="brand" class="form-control" id="brand">
			<option value=""<?=(($brand == '')?' selected':'');?>></option>
			<?php while($b = mysqli_fetch_assoc($brandQuery)):?>
				<option value="<?=$b['id'];?>" <?=(($brand == $b['id'])?' selected':''); ?>><?=$b['brand'];?></option>
			<?php endwhile;?>
		</select>
	</div>
	<div class="form-group col-md-3">
		<label for="parent">Parent Category*</label>
		<select name="parent" class="form-control" id="parent">
			<option value=""<?=(($parent =='')?' selected':'');?>></option>
			<?php while($p = mysqli_fetch_assoc($parentQuery)):?>
				<option value="<?=$p['id'];?>"<?=(($parent==$p['id'])?' selected':'');?>><?=$p['category'];?></option>
			<?php endwhile;?>
		</select>
	</div>
	<div class="form-group col-md-3">
		<label for="child">Child Category*</label>
		<select name="child" id="child" class="form-control"></select>
	</div>
	<div class="form-group col-md-3">
		<label for="price">Price*</label>
		<input type="text" name="price" id="price" class="form-control" value="<?=$price;?>">
	</div>
	<div class="form-group col-md-3">
		<label for="list_price">List Price</label>
		<input type="text" name="list_price" id="list_price" class="form-control" value="<?=$list_price;?>">
	</div>

	<div class="form-group col-md-3">
	<label>Quantity and Sizes*</label>
		<button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle'); return false;">Quantity and Sizes</button>
	</div>
	<div class="form-group col-md-3">
		<label for="sizes">Sizes & Qty Preview</label>
		<input type="text" name="sizes" id="sizes" class="form-control" value="<?=$sizes;?>" readonly> 
	</div>
	
	<div class="form-group col-md-6">
		<?php if ($saved_image != ''):?>
			<?php 
				$imgi =1;
				$images = explode(',', $saved_image);
			 ?>
			 <?php foreach ($images as $image): ?>
				<div class="saved-image col-md-4">
					<img src="<?=$image;?>" alt="saved-image"><br>
					<a href="products.php?delete_image=1&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Delete Image</a>
				</div> 	
			 <?php $imgi++; endforeach ?>
			
		<?php else: ?>
			<label for="photo">Product Photo:</label>
			<input type="file" name="photo[]" id="photo" class="form-control" multiple>
		<?php endif; ?>
	</div>

	<div class="form-group col-md-6">
		<label for="description">Description</label>
		<textarea name="description" id="description" class="form-control" cols="30" rows="6"><?=$description;?></textarea>
	</div>
	<div class="form-group pull-right">
		<a href="products.php" class="btn btn-default">Cancel</a>
		<input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Product" class="btn btn-success">
	</div><div class="clearfix"></div>
</form>

<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
       	<?php for ($i=1; $i <=12; $i++):?>
	       	<div class="form-group col-md-2">
	       		<label for="size<?=$i;?>">Size:</label>
	       		<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'') ?>" class="form-control">
	       	</div>
	       	<div class="form-group col-md-2">
	       		<label for="qty<?=$i;?>">Quantity:</label>
	       		<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'') ?>" min="0" class="form-control">
	       	</div>
	       	<div class="form-group col-md-2">
	       		<label for="threshold<?=$i;?>">Threshold:</label>
	       		<input type="number" name="threshold<?=$i;?>" id="threshold<?=$i;?>" value="<?=((!empty($tArray[$i-1]))?$tArray[$i-1]:'') ?>" min="0" class="form-control">
	       	</div>
	    <?php endfor; ?>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();" data-dismiss="modal" jQuery('sizesModal').modal('toggle');>Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php	} else{
	$sql = "SELECT * FROM products WHERE deleted = 0";
	$presults = $db->query($sql);

	if (isset($_GET['featured'])) {

		$id= (int)$_GET['id'];
		$featured = (int)$_GET['featured'];
		$featuredsql= "UPDATE products SET featured= '$featured' WHERE id = '$id'";
		$db->query($featuredsql);
		header('Location: products.php');

	}

?>
<h2 class="text-center">Products</h2>
	<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Products</a>
	<div class="clearfix"></div>

<hr>

<table class="table table-bordered table-condenced table-striped">
	<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Feautured</th><th>Sold</th></thead>
	<tbody>
		<?php while($Product = mysqli_fetch_assoc($presults)):
			$childID=$Product['categories'];
			$catSql = "SELECT * FROM categories WHERE 	id = '$childID'";
			$resultChild = $db->query($catSql);
			$cat_array = mysqli_fetch_assoc($resultChild);
			$parentID = $cat_array['parent'];
			$parentSql =  "SELECT * FROM categories WHERE id = '$parentID'";
			$resultParent = $db->query($parentSql);
			$parent_array= mysqli_fetch_assoc($resultParent);
			$category = $parent_array['category'].'~'.$cat_array['category'];
		?>
			<tr>
				<td>
					<a href="products.php?edit=<?=$Product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="products.php?delete=<?=$Product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td><?=$Product['title'];?></td>
				<td><?=money($Product['price']);?></td>
				<td><?=$category;?></td>
				<td><a href="products.php?featured=<?=(($Product['featured']==0)?'1':'0')?>&id=<?=$Product['id'];?>" class=" btn btn-xs btn-default">	<span class="glyphicon glyphicon-<?=(($Product['featured']==1)?'minus':'plus')?>"></span></a>
					&nbsp <?=(($Product['featured']==1)?'Featured Product':''); ?>
				</td>
				<td>0<?//=$Product['id'];?></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
<?php } ?>
<?php  include 'includes/footer.php'; ?>
<script>
	jQuery('document').ready(function() {
		get_child_options('<?=$category?>');		
	});
</script>