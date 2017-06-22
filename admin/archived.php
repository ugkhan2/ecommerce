<?php 
	require_once '../core/init.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include 'includes/head.php';
	include 'includes/navigation.php';
	$SqlShowArchived="SELECT * FROM products WHERE deleted=1";
	$resultArchived = $db->query($SqlShowArchived);

	if (isset($_GET['restore'])) {
		echo $id= sanitize($_GET['restore']);
		$db->query("UPDATE products SET deleted=0 WHERE id='$id'");
		header('Location: archived.php');
	}
	
 ?>
<h2 class="text-center">Archived Products</h2><hr>
<table class="table table-bordered table-condenced table-striped">
	<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Sold</th></thead>
	<tbody>
		<?php while($Product = mysqli_fetch_assoc($resultArchived)):
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
					<a href="archived.php?restore=<?=$Product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a>
				</td>
				<td><?=$Product['title'];?></td>
				<td><?=money($Product['price']);?></td>
				<td><?=$category;?></td>
				<td>0<?//=$Product['id'];?></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
 <?php include 'includes/footer.php'; ?>