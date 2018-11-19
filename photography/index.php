<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT home FROM content');
$stmt->execute();
$rowCont = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt2 = $db->prepare('SELECT Image1, Image2, Image3 FROM content');
$stmt2->execute();
$rowImage = $stmt2->fetch(PDO::FETCH_ASSOC);
$stmt3 = $db->prepare('SELECT catTitle, catSlug, catDesc, catLink1, catLink2, catLink3 FROM  portfolio_cats , content WHERE catLink1 = catTitle OR catLink2 = catTitle OR catLink3 = catTitle ORDER BY FIELD(catTitle, catLink1,catLink2,catLink3)');
$stmt3->execute();
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "Home",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" =>"images/exampleHeader.jpg",
"headerMount" => "stickyTape.png"
); ?>

<?php include('includes/header.php');?>
<script>
$( "li:contains('Home')" ).addClass("active");
</script>
<div style="display:flex;" class="hasflex homeMain" id='main'>
			<?php 
			$count = 1;
			while($rowCat = $stmt3->fetch()){
			$desc[$count] = $rowCat['catDesc'];
			$url[$count] = $rowCat['catSlug'];
			$title[$count] = $rowCat['catTitle'];
			$count += 1;
			}
			echo '<div id="homeImages" class="contentImages">';
			$count2 = 1;
			foreach($rowImage as $Image){
				echo '<div id="contimage"><p><a class="noDisplay" href="cp-'.$url[$count2].'">'.$title[$count2].'</a></p><a href="admin/uploads/'.$Image.'" data-lightbox="content" data-title="contentImage">';
           	 	echo '<div id ="Image" class="contentImage">';
            	echo '<img src ="admin/resizeImage/'.basename($Image).'" ></div>';
				echo '</a><p ><a class="noDisplay" style="white-space:normal" href="cp-'.$url[$count2].'">'.$desc[$count2].'</a></p></div>';
				$count2 += 1;
			}
			echo '</div>';
       
			
			
			/*
				try {

					$pages = new Paginator('6','p');

					$stmt = $db->query('SELECT postID FROM portfolio_posts_seo');

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate, postImage FROM portfolio_posts_seo ORDER BY rand() DESC '.$pages->get_limit());
					while($row = $stmt->fetch()){
							echo '<div class="portPost"><div id="postimage"><a href="'.$row['postImage'].'" data-lightbox="portfolio" data-title="'.$row["postTitle"].'">';
                            echo '<div class="rImgWrap"><img src ="admin/resizeImage/'.basename($row['postImage']).'" ></div>';
							echo '</a></div>';
						echo '<div id="post">';
							echo '<h1><a href="p-'.$row['postSlug']. $lastPage.'">'.$row['postTitle'].'</a></h1>';
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
                            
							echo '<p>'.$row['postDesc'].'</p>';				
							echo '<p><a href="p-'.$row['postSlug'].$lastPage.'">Read More</a></p>';
						echo '</div></div>';
					}
				} catch(PDOException $e) {
				    echo $e->getMessage();
				}*/
			?>

</div>
<div class="hasflex" id='homeCont'>
        <?php echo $rowCont['home']; ?>
</div>
<?php include('includes/footer.php');?>
