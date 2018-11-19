<?php require('includes/config.php'); 
$stmt = $db->prepare('SELECT about FROM content');
$stmt->execute();
$row = $stmt->fetch();
$stmt2 = $db->prepare('SELECT Image4, Image5, Image6 FROM content');
$stmt2->execute();
$rowImage = $stmt2->fetch(PDO::FETCH_ASSOC);
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "About",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" =>"images/exampleHeader.jpg",
"headerMount" => "stickyTape.png"
); ?>

<?php include('includes/header.php');?>
<script>
$( "li:contains('About')" ).addClass("active");
</script>
		
        <div style="display:flex;" class="hasflex portMain" id='main'>
        <?php 
			echo '<div id="aboutImages" class="hasflex contentImages">';
			foreach($rowImage as $Image){
			echo '<div id="contimage"><a href="admin/uploads/'.$Image.'" data-lightbox="content" data-title="contentImage">';
            echo '<div id ="Image" class="contentImage">';
            echo '<img src ="admin/resizeImage/'.basename($Image).'" ></div>';
			echo '</a></div>';
			}
			echo '</div>';
		?>
        </div>
        <div class="hasflex" id='main'>
        
        
        
        
        <?php echo $row['about']; ?>
		</div>
        
<?php include('includes/footer.php');?>
