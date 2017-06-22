<?php 
	require_once 'core/init.php';
	include_once 'includes/head.php';
	include_once 'includes/navigation.php';
	include_once 'includes/headerfull.php';
	include_once 'includes/leftbar.php';

	$sql = "SELECT * FROM products 	WHERE featured = 1 AND deleted = 0";
	$featured = $db->query($sql);

?>
<!-- Main content -->
<div class="col-md-8">
	<div class="row">
		<h2 class="text-center">Feature Products</h2>
		<?php while ($product = mysqli_fetch_assoc($featured)): ?>
			<div class="col-md-3">
				<h4><?=$product['title']; ?></h4>
				<?php $photos = explode(',', $product['image']); ?>
				<img src="<?=$photos[0]; ?>" alt="<?=$product['title']; ?>" class="img-thumb">
				<p class="list-price text-danger">List Price <s><?=money($product['list_price']);?></s></p>
				<p class="price">Our Price: <?=money($product['price']);?></p>
				<button-button class="btn btn-sm btn-success" onclick="detailsmodal(<?=$product['id'];?>)">Details</button-button>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php 
	include_once 'includes/rightbar.php';
	include_once 'includes/footer.php';
 ?>	