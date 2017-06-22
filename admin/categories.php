<?php 
	require_once '../core/init.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include 'includes/head.php';
	include 'includes/navigation.php';
	$sql = "SELECT * FROM categories WHERE parent=0";
	$result = $db->query($sql);
	$errors = array();
	$category = '';
	$postparent = '';

	// Edit categories
	if (isset($_GET['edit']) && !empty($_GET['edit'])) {
		$edit_id = (int)$_GET['edit'];
		$edit_id = sanitize($edit_id);
		$editsql = "SELECT * FROM categories WHERE  id = '$edit_id'";
		$edit_result = $db->query($editsql);
		$category_edit =  mysqli_fetch_assoc($edit_result);

	}

	// Delete Categories
	if (isset($_GET['delete']) && !empty($_GET['delete'])) {
		$delete_id = (int)$_GET['delete'];
		$delete_id = sanitize($delete_id);
		$Psql = "SELECT * FROM categories WHERE id = '$delete_id'";
		$Presult= $db->query($Psql);
		$category = mysqli_fetch_assoc($Presult);
		if ($category['parent']==0) {
			$deletechildsql = "DELETE FROM categories WHERE parent = '$delete_id'";
			$db->query($deletechildsql);
		}
		$deletesql = "DELETE FROM categories WHERE id = '$delete_id'";
		$db->query($deletesql);
		header('Location: categories.php');
	}

	// Process form
	if (isset($_POST) && !empty($_POST)) {
		$post_parent = sanitize($_POST['parent']);
		$category = sanitize($_POST['category']);
		// check database for duplicacy in categories under same parent class.
		$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
		if (isset($_GET['edit'])) {
			$id = $category_edit['id'];
			$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id != '$id'";
		}
		$fresult = $db->query($sqlform);
		$count = mysqli_num_rows($fresult);
		# if category is blank.....
		if ($category=='') {
			$errors[] .='The category can not be left blank.!';
		}
		// if exists in the database
		if ($count>0) {
			$errors[] .= $category. ' already exists. Please choose a new category!';
		}

		// Display Errors or Update database
		if (!empty($errors)) {
			// Display errors.
			$display=display_errors($errors);?>
			<script>
				jQuery('document').ready(function (){
					jQuery('#errors').html('<?=$display; ?>');
				});
			</script>

	<?php }else{
			// Update database.
			$updatesql="INSERT INTO categories (category, parent) VALUES ('$category', '$post_parent')";
			if (isset($_GET['edit'])) {
				$updatesql="UPDATE categories SET category = '$category', parent = '$post_parent' WHERE id = '$edit_id'";
			}
			$db->query($updatesql);
			header('Location: categories.php');
		}
	}
	$category_value = '';
	$parent_id_edit = 0;
	if (isset($_GET['edit'])) {
		$category_value = $category_edit['category'];
		$parent_id_edit = $category_edit['parent'];
	}else{
		if (isset($_POST)) {
			$category_value = $category;
			$parent_id_edit =  $postparent;
		}
	}

?>
<h2 class="text-center">Categories</h2><hr>
<div class="row">
	<!-- Form -->
	<div class="col-md-6">
		<form action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" class="form" method="POST">
		<legend><?=((isset($_GET['edit']))?'Edit':'Add A');?> Category</legend>
		<div id="errors"></div>
			<div class="form-group">
				<label for="parent">Parent</label>
				<select name="parent" id="parent" class="form-control">
					<option value="0"<?=(($parent_id_edit==0)?'Selected = "selected"':'');?>>Parent</option>
					<?php while($parent = mysqli_fetch_assoc($result)):?>
						<option value="<?=$parent['id'] ?>"<?=(($parent_id_edit==$parent['id'])?'Selected = "selected"':'');?>><?=$parent['category'] ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<input type="text" name="category" id="category" class="form-control" value="<?=$category_value;?>">
			</div>
			<div class="form-grou">
				<input type="submit" name="" id="" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Category" class="btn btn-success">
			</div>
		</form>
	</div>

	<!-- Category Table -->
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<th>Category</th><th>Parent</th><th></th>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT * FROM categories WHERE parent=0";
					$result = $db->query($sql); 
					while($parent=mysqli_fetch_assoc($result)):
					$parent_id = (int)$parent['id'];
					$sqlchild = "SELECT * FROM categories WHERE parent = '$parent_id'";
					$childresult = $db->query($sqlchild);	
				?>
					<tr class="bg-primary">
						<td><?=$parent['category'] ?></td>
						<td>Parent</td>
						<td>
							<a href="categories.php?edit=<?=$parent['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="categories.php?delete=<?=$parent['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
						</td>
					</tr>
					<?php while($child = mysqli_fetch_assoc($childresult)):?>
						<tr class="bg-info">
						<td><?=$child['category'] ?></td>
						<td><?=$parent['category'] ?></td>
						<td>
							<a href="categories.php?edit=<?=$child['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="categories.php?delete=<?=$child['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
						</td>
					</tr>
					<?php endwhile; ?>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>
<?php include 'includes/footer.php'; ?>