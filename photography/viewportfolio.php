<?php require('includes/config.php'); 



$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate, postImage FROM portfolio_posts_seo WHERE postSlug = :postSlug');
$stmt->execute(array(':postSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "Portfolio",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" => $row['postImage'],
"headerMount" => "photomount.png"
); ?>
<?php include('includes/header.php');?>
<script>
$( "li:contains('Portfolio')" ).addClass("active");
</script>
        <?php if(isset($_GET['c'])){
				echo '<p><a href="javascript:history.go(-1)">Portfolio Categories</a></p>';
		}
			else{
				echo '<p><a href="./blog.php'.$lastPage.'">Portfolio Index</a></p>';
				}  ?>

		<div id='main'>
			<div id='pageImage'><img src="<?php echo str_replace(' ', '%20',$pageArray["mainImage"]); ?>"></div>
			<?php	
				echo '<div>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

						$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM portfolio_cats, portfolio_post_cats WHERE portfolio_cats.catID = portfolio_post_cats.catID AND portfolio_post_cats.postID = :postID');
						$stmt2->execute(array(':postID' => $row['postID']));

						$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

						$links = array();
						foreach ($catRow as $cat)
						{
						    $links[] = "<a href='cp-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
						}
						echo implode(", ", $links);

					echo '</p>';
					echo '<p>'.$row['postCont'].'</p>';				
				echo '</div>';
			?>

		</div>

<?php include('includes/footer.php'); ?>