<?php 
	require_once 'core/init.php';
	include_once 'includes/head.php';
	include_once 'includes/navigation.php';
	include_once 'includes/headerpartial.php';
	include_once 'includes/leftbar.php';
	$sql = "SELECT * FROM products";
	$cat_id = (($_POST['cat'] != '')?sanitize($_POST['cat']):'');
	if ($cat_id == '') {
		$sql .=" WHERE deleted = 0";
	}else{
		$sql .=" WHERE categories = '{$cat_id}' AND deleted = 0";
	}
	$price_sort  = (($_POST['price_sort'] != '')?sanitize($_POST['price_sort']):'');
	$min_price  = (($_POST['min_price'] != '')?sanitize($_POST['min_price']):'');
	$max_price  = (($_POST['max_price'] != '')?sanitize($_POST['max_price']):'');
	$brand  = (($_POST['brand'] != '')?sanitize($_POST['brand']):'');
	if ($min_price != '') {
		$sql .=" AND price >= '{$min_price}'";
	} 
	if ($max_price != '') {
		$sql .=" AND price <= '{$max_price}'";
	}
	if ($brand !='') {
		$sql .=" AND brand = '{$brand}'";
	}
	if ($price_sort == 'low') {
		$sql .=" ORDER By price ";
	}if ($price_sort == 'high') {
		$sql .=" ORDER By price DESC";
	}
	


	$productQ = $db->query($sql);
	$category = get_category($cat_id);
	
?>

<!-- Main content -->
<div class="col-md-8">
	<div class="row">
		<?php if($cat_id != ''): ?>
			<h2 class="text-center"><?=$category['parent'].' '. $category['child'];?></h2>
		<?php else: ?>
			<h2 class="text-center">Your results.</h2>
		<?php endif; ?>
		<?php while ($product = mysqli_fetch_assoc($productQ)): ?>
			<div class="col-md-3">
				<h4><?=$product['title']; ?></h4>
				<?php $photos = explode(',', $product['image']); ?>
				<img src="<?=$photos['0']; ?>" alt="<?=$product['title']; ?>" class="img-thumb">
				<p class="list-price text-danger">List Price <s><?=money($product['list_price']);?></s></p>
				<p class="price">Our Price: <?=money($product['price']);?></p>
				<button-button class="btn btn-sm btn-success" onclick="detailsmodal(<?=$product['id'];?>)">Details</button-button>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php 
	//include_once'includes/detailsmodal.php';
	include_once 'includes/rightbar.php';
	include_once 'includes/footer.php';
 ?>

		
		
	