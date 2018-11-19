
<?php //include config
require_once('../includes/config.php');
require('../includes/Zebra_Image.php');
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

function resize($target_file, $new_path, $w, $h, $aspect){
	
			$image = new Zebra_Image();
			$image->source_path = $target_file;
			
			$image->target_path = $new_path;
			$image->jpeg_quality = 90;
			$image->preserve_aspect_ratio = $aspect;
    		$image->enlarge_smaller_images = true;
    		$image->preserve_time = true;
			    if (!$image->resize($w, $h, ZEBRA_IMAGE_NOT_BOXED)) {

        // if there was an error, let's see what the error is about
        switch ($image->error) {

            case 1:
                $uploadString .= 'Source file could not be found!';
                break;
            case 2:
                $uploadString .= 'Source file is not readable!';
                break;
            case 3:
                $uploadString .= 'Could not write target file!';
                break;
            case 4:
                $uploadString .= 'Unsupported source file format!';
                break;
            case 5:
                $uploadString .= 'Unsupported target file format!';
                break;
            case 6:
                $uploadString .= 'GD library version does not support target file format!';
                break;
            case 7:
                $uploadString .= 'GD library is not installed!';
                break;

        }

    // if no errors
    } else {

        $uploadString .= 'Success!';

    }
	
	
	}

function uploadFile($fileUpload){
	
    $target_dir = "uploads/";
	$_FILES[$fileUpload]["name"] = str_replace(' ', '_', $_FILES[$fileUpload]["name"]);
    $target_file = $target_dir . basename($_FILES[$fileUpload]["name"]);
    $uploadOk = 1;
	$uploadString = "";
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$fileUpload]["tmp_name"]);
        if($check !== false) {
            $uploadString .= "File is an image - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            $uploadString .= "File is not an image. ";
            $uploadOk = 0;
        }
    }
    // Check if file already exists

    if (file_exists($target_file)) {
        $uploadString .= "File already exists. ";
        $uploadOk = 0;
    }
     // Check file size
    if ($_FILES[$fileUpload]["size"] > 3000000) {
        $uploadString .= "Your file is too large. ";
        $uploadOk = 0;
    }

    // Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "jpeg"
     ) {
        $uploadString .= "Only JPG & JPEG files are allowed. ";
        $uploadOk = 0;
    }
	//Rescale image to more web friendly size
	
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $uploadString .= "Sorry, your file was not uploaded. ";
		return array($uploadOk,$uploadString);
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$fileUpload]["tmp_name"], $target_file)) {
            $uploadString .= "The file ". basename( $_FILES[$fileUpload]["name"]). " has been uploaded.";
			$new_path = 'thumbnails/'.basename($_FILES[$fileUpload]["name"]);
			resize($target_file, $new_path, 200, 200, false);
			$new_path = 'resizeImage/'.basename($_FILES[$fileUpload]["name"]);
			resize($target_file, $new_path, 1000, 1000, true);
			
            return array('admin/'.$target_file, $uploadString);
        } else {
            $uploadString .= "There was an error uploading your file. ";
			$uploadOk = "Nothing Selected";
			return array($uploadOk,$uploadString);
			
        }

    }
}
?>