<?php
    require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
//show message from add / edit page
if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts_seo WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));


	header('Location: viewBlogs.php?action=deleted');
	exit;
}
   $pageArray = array(
"name"  => "HuntByte - Posts",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');
include('includes/leftbar.php');?>
<script>
$( "li:contains('View')" ).addClass("active");

  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'viewBlogs.php?delpost=' + id;
	  }
  }

</script>

        <div class="right">
            <h2><span>Blog Posts</span></h2>
            <div class="columnContent" id="primaryContent">
			<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>'.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table>
	<tr>
		<th>Title</th>
		<th class="mobile">Date</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts_seo ORDER BY postID DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td class="mobile">'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>

				<td>
					<a href="editBlog.php?id=<?php echo $row['postID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='addBlog.php'>Add Post</a></p>

            </div>
        </div>
       <?php include('includes/footer.php'); ?>