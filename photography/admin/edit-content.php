<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

$pageArray = array(
"name"  => "Edit Content",
"menu"  => "menu.php",
"style" => "../style/",
"sidebar" => "none"
); ?>

<?php include('../includes/adminHeader.php');?>

<div class="hasflex" id='main'>

	<h2>Edit Content</h2>


	<?php

	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Content '.$_GET['action'].'.</h3>'; 
	} 

	//if form has been submitted process it
	if(isset($_POST['submit'])){
		

		//collect form data
		extract($_POST);
			
        
		//very basic validation

		if($about ==''){
			$error[] = 'Please enter the about contents.';
		}

		if($home ==''){
			$error[] = 'Please enter the home contents.';
		}

		if(!isset($error)){

			try {


				//insert into database
				$stmt = $db->prepare('UPDATE content SET home = :home, about = :about, Image1 = :Image1, catLink1 = :catLink1, Image2 = :Image2, catLink2 = :catLink2, Image3 = :Image3, catLink3 = :catLink3, Image4 = :Image4, Image5 = :Image5, Image6 = :Image6') ;
				$stmt->execute(array(
					':home' => $home,
					':about' => $about,
					':Image1' => $Image1,
					':catLink1' => $catLink1,
					':Image2' => $Image2,
					':catLink2' => $catLink2,
					':Image3' => $Image3,
					':catLink3' => $catLink3,
					':Image4' => $Image4,
					':Image5' => $Image5,
					':Image6' => $Image6
				));

				

				//redirect to index page
				header('Location: edit-content.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {
			//get data from db
			$stmt = $db->prepare('SELECT home, about, Image1, catLink1, Image2, catLink2, Image3, catLink3, Image4, Image5, Image6 FROM content') ;
			$stmt->execute();
			$row = $stmt->fetch(); 
			
			

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
?>

	<!-- Trigger/Open The Image Modal -->
    <div id="homeButtons" class="imageSelect">
	<p>Choose Homepage images:</p>
	<button class="myBtn" onclick="openModal(['Image1','0'])">Choose Image 1</button>
    <button class="myBtn" onclick="openModal(['Image2','0'])">Choose Image 2</button>
    <button class="myBtn" onclick="openModal(['Image3','0'])">Choose Image 3</button>
    <button style="display:none;" id="clearSelect">Clear Selection</button>
    </div>	

<?php include('modal.php');?>
 			<div id="aboutButtons" class="imageSelect">
			<p>Choose About images:</p>
            <button class="myBtn" onclick="openModal(['Image4','0'])">Choose Image 1</button>
            <button class="myBtn" onclick="openModal(['Image5','0'])">Choose Image 2</button>
            <button class="myBtn" onclick="openModal(['Image6','0'])">Choose Image 3</button>
            <button style="display:none;" id="clearSelect">Clear Selection</button>
            </div>	

            
    
		
   
    <form id="postForm" action='' method='post' enctype="multipart/form-data">
   			<div id="mainLinks" class="hasflex">
            <div id="selectBox" style= class="hasflex imageSelect">
            <p>Selected Home images:</p>
            <input type="text" name="Image1" value=<?php echo $row['Image1'];?> readonly>
            <input type="text" name="Image2" value=<?php echo $row['Image2'];?> readonly>
            <input type="text" name="Image3" value=<?php echo $row['Image3'];?> readonly>
            </div> 
            <div id="linkSelect" style="flex-direction:column;"class="hasflex linkSelect">
            <p>Select categories to be displayed with Homepage images</p>
            <?php
            //populate select boxes 
            $stmt2 = $db->query('SELECT catTitle FROM portfolio_cats ORDER BY catTitle DESC'); 
            $catArray =  Array();
                while($row2 = $stmt2->fetch()){
                    array_push($catArray,$row2["catTitle"]);
                }
            foreach (range(1, 3) as $number){ 
                echo '<select name="catLink'.$number.'">';
                foreach ($catArray as $catName){ 
                    if ($catName == $row["catLink".$number]){
                        echo '<option selected="'.$catName.'" value="'.$catName.'">'.$catName.'</option>';
                    }else{
                        echo '<option value="'.$catName.'">'.$catName.'</option>';
                    }}
                echo "</select></br>";
                }
            ?>
            </div>
            </div>
            <div id="selectBox" class="hasflex imageSelect">
            <p>Selected About images:</p>
            <input type="text" name="Image4" value=<?php echo $row['Image4'];?> readonly>
            <input type="text" name="Image5" value=<?php echo $row['Image5'];?> readonly>
            <input type="text" name="Image6" value=<?php echo $row['Image6'];?> readonly>
            </div>

		<p><label>Home page content.</label><br /><br />
		<textarea name='home' cols='60' rows='10'><?php echo $row['home'];?></textarea></p>

		<p><label>About page content.</label><br /><br />
		<textarea name='about' cols='60' rows='10'><?php echo $row['about'];?></textarea></p>


		<p><input type='submit' name='submit' value='Update'></p>

		

	</form>
</div>

<?php include('../includes/adminFooter.php');?>
