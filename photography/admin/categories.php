<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delcat'])){ 
	
	$stmt = $db->prepare('DELETE FROM blog_cats WHERE catID = :catID') ;
	$stmt->execute(array(':catID' => $_GET['delcat']));

	header('Location: categories.php?action=deleted');
	exit;

}

elseif(isset($_GET['delpcat'])){
	$stmt2 = $db->prepare('DELETE FROM portfolio_cats WHERE catID = :catID') ;
	$stmt2->execute(array(':catID' => $_GET['delpcat']));

	header('Location: categories.php?action=deleted');
	
	exit;
} 

$pageArray = array(
"name"  => "Categories",
"menu"  => "menu.php",
"style" => "../style/",
"sidebar" => "none"
); ?>

<?php include('../includes/adminHeader.php');?>
  <script language="JavaScript" type="text/javascript">
  function delcat(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'categories.php?delcat=' + id;
	  }
  }
    function delpcat(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'categories.php?delpcat=' + id;
	  }
  }
  </script>
  
<div class="hasflex" id='main'>
	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Category '.$_GET['action'].'.</h3>'; 
	} 
	?>
	<h2>Blog Categories</h2>
	<table>
	<tr>
		<th>Title</th>
        <th>Description</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT catID, catTitle, catSlug, catDesc FROM blog_cats ORDER BY catTitle DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['catTitle'].'</td>';
				echo '<td>'.$row['catDesc'].'</td>';
				?>

				<td>
					<a href="edit-category.php?c=blog&id=<?php echo $row['catID'];?>">Edit</a> | 
					<a href="javascript:delcat('<?php echo $row['catID'];?>','<?php echo $row['catSlug'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-category.php'>Add Category</a></p>
    
    	<h2>Portfolio Categories</h2>
	<table>
	<tr>
		<th>Title</th>
        <th>Description</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt2 = $db->query('SELECT catID, catTitle, catSlug, catDesc FROM portfolio_cats ORDER BY catTitle DESC');
			while($row2 = $stmt2->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row2['catTitle'].'</td>';
				echo '<td>'.$row2['catDesc'].'</td>';
				?>

				<td>
					<a href="edit-category.php?c=portfolio&id=<?php echo $row2['catID'];?>">Edit</a> | 
					<a href="javascript:delpcat('<?php echo $row2['catID'];?>','<?php echo $row2['catSlug'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e2) {
		    echo $e2->getMessage();
		}
	?>
	</table>

	<p><a href='add-portCategory.php'>Add Category</a></p>

</div>

<?php include('../includes/adminFooter.php') ?>