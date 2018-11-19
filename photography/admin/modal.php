
<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
		<div class="modal-header">
		  <span class="closeModal">×</span>
		  <h2 style="color: #fff;">Uploaded Images</h2>
          <h3 style="color: #fff;">Please double-click to select an image.</h3>
		</div>
		<div class="modal-body">
        <div class="picker">
		<picker class="image-picker" data-limit="1" name="modalSelect" form="postForm">
        
        <?php
		// Iterates through uploads directory
        $dir = new DirectoryIterator('thumbnails');
        $count = 1;
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                echo '<option data-img-src="thumbnails/'.$fileinfo->getFilename().'" data-img-label="'. $fileinfo->getFilename().'">'.$fileinfo->getFilename().'</option>';
                $count++;
    }
}
        ?>
       
        </picker>
		</div>
        </div>
		<div class="modal-footer">
		</div>
	  </div>
</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');


// selects clear field button and changes it back to clear
var clearSelect = document.getElementById("clearSelect");
clearSelect.onclick = function(){
	var myBtn = document.getElementsByClassName("myBtn")
	//need to create a loop and check if each item in get will get changed
	$('input[name=thumbImage]').val("Nothing Selected");
	$('input[name=mainImage]').val("Nothing Selected");
	}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeModal")[0];


var currentButton = ""; 
// When the user clicks the button, opens the modal
//btnName needs to be the name of the field that the image will be copied to.
function openModal(btnName) {
    modal.style.display = "block";
	currentButton = btnName;
	
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

//if try to select image from site and upload clear the other
   function setfield(value){
   		$('input[name='+value[0]+']').val(value[1]);
	
  }

$(function() {
    // initial configuration of the plugin
    $("picker").imagepicker({
        show_label  : false
        });
		// gets data from the picker and puts it in a text box
		
		//dbl click for image selectiom(not perfect may cause issues)
		window.ondblclick = function(event){
			if(currentButton[0] == "urlImage"){
				var $image = "http://edinburghrock.net/staging//admin/resizeImage/"
				}
			else{
				var $image = "";
				}
			if (event.target.nodeName == "IMG"){
				$image += $("picker").data("picker").selected_values();
			
        		
        	//jquery selector
        	$('input[name='+currentButton[0]+']').val($image);
			//remove any upload file selected
			$('input[name='+currentButton[1]+']').replaceWith( $('input[name='+currentButton[1]+']').val('').clone( true ));
        	modal.style.display = "none";
				} 
			}
        mainSelect.onclick = function() {
			var $mainImage = $("select").data("picker").selected_values();
        	alert("You have selected '" + $mainImage + "' as a main image.");
        		
        	//jquery selector
        	$('input[name=mainImage]').val($mainImage);
			//remove any upload file selected
			$('input[name=mainUpload]').replaceWith( $('input[name=mainUpload]').val('').clone( true ));
        
         };
         thumbSelect.onclick = function() {
			 var $thumbImage =  $("select").data("picker").selected_values();
        	alert("You have selected '" + $thumbImage + "' as a thumbnail.");
			//jquery selector
			$('input[name=thumbImage]').val($thumbImage);
			//remove any upload file selected
			$('input[name=thumbUpload]').replaceWith( $('input[name=thumbUpload]').val('').clone( true ));
         };
});

  </script>