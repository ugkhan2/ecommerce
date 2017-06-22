<?php 
	require_once 'core/init.php';
	include_once 'includes/head.php';
	include_once 'includes/navigation.php';
	include_once 'includes/headerpartial.php';
	include_once 'includes/leftbar.php';
	if (isset($_GET['cat'])) {
		$cat_id = sanitize($_GET['cat']);
	}else{
		$cat_id = '';
	}

	$sql = "SELECT * FROM products 	WHERE categories = '$cat_id'";
	$productQ = $db->query($sql);
	$category = get_category($cat_id);
	
?>

<!-- Main content -->
<div class="col-md-8">
	<div class="row">
		<h2 class="text-center"><?=$category['parent'].' '. $category['child'];?></h2>
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

		
		
	