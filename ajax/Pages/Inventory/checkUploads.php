<?php
function checkImage()
{
	
	//set filepath to the folder to store images in
	$target = "images/";
	
	$target_file = $target . basename($_FILES["image"]["name"]);
	//a variable to set if the upload is fine
	$uploadOk = 1;
	//a variable to hold the images filetype
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Check if image file is an actual image
	if(isset($_POST["upload"])) 
		{
			$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) 
				{//as long as the image is an image
					//tell user its an image
					echo "File is an image - " . $check["mime"] . ".";
					//set to 1 if upload is fine
					$uploadOk = 1;
				
				} //if its not an image
					else 
						{
							//tell the user its not an acceptable file	
							echo "File is not an image.";	
							//set to 0 if upload is not fine
							$uploadOk = 0;
						}
		}
	// Check to see if file already exists in the folder
	if (file_exists($target_file)) 
		{//if it does
			//tell user its already there
			echo "Sorry, file already exists.";
			//set to 0 if upload is not fine
			$uploadOk = 0;
		}
		
	// Check file size, if image is more than 900000 
	if ($_FILES["image"]["size"] > 900000) 
		{
			//tell user the file's too big
			echo "Sorry, your file is too large.";
			//set to 0 if upload is not fine
			$uploadOk = 0;
		}
		
	// Allow certain file formats
	//if its not a jpg, png or jpeg format 
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
		{
			//tell user why its not acceptable
			echo "Sorry, only JPG, JPEG or PNG files are allowed.";
			//set to 0 if upload is not fine
			$uploadOk = 0;
		}
		
	// Check if $uploadOk has been set to 0 by an error
	if ($uploadOk == 0) 
		{//if the uploadOk is set to 0 then tell the user their file wasnt uploaded
		echo "Sorry, your file was not uploaded.";
		//header('Location: notUploaded.php');
		}
		//if all checks pass
		else
		{
			//if everything is ok, move the image to the images folder
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target .basename($_FILES['image']['name'])))
				{
					//return a true if this all worked ok
					return TRUE;
					//probably dont need this but I'll leave it here for now
					$msg = "uploaded";
					//just an echo to check 
					echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		

				}
				//if it doesnt upload echo a message
				else	
					{
						//probably dont need this but I'll leave it here for now
						$msg = "error uploading";
						echo "oh no! something went wrong and your file wasnt uploaded.";
						
					}
		}
				


}