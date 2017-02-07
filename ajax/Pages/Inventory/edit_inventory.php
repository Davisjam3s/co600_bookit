<!--
    ** This Is a page for deleting a  user into the Owner Database, this is actvated when the admin user wants to remove a user from the database. of course this page would first need to delete the assests that that user has within the database first 

    ** It first gets the values from the ajax from on the Control.php page (found on /ajax/Pages/Admin) it sets the values posted and then uses them to create the first SQL statement

    ** At the moment has the connection to the datbase directly in here, this can be moved later, but for now it is working 

    ** Once it has been connected to the database it will strips all the tags these being things like ' ect as we want to prevent the user from creating an sql injection this is done by using "mysqli_real_escape_string($connection, $ExampleVariable)" this should in theory prevent them from that

    ** IT also makes sure to strip the tags, this should prevent the user from XSS attacks, this of course can ruin the websute if it was used. So it would be good to stop that from happening 

    ** The fist SQL statement is to select from the database, this is done because the Owner table within the database needs some information From the User table once we get this information it is then set into varibles so they can be used in the second SQL statement.

    ** The second SQL statement is for acctually inserting the information to the Owner table, it gathers the information from both the form that the user filled out and from the data that is capturerd from the first SQL.

    **This page was Created by Matt Hood, James Davis
    **Commented by James Davis

    **Tasks for this page
        *Code Clean
        *Code Format
        *use the include file for the connection rather than the whole connection script
        
-->
<style>
    .phpechofront2{
        display: none;
    }
</style>

<script>
$(document).ready(function() // wait till the page is ready
{
    $(".editItem").click(function() // wait till this button has been pressed
      { 
          $(".phpechofront2").show(); // show the main nav
      });
  });
</script>
<?php
//read in variables
$ItemName = $_POST['ItemName']; // for that ItemName 

require '../../../php/Conection.php'; //connect to server

$ItemName = mysqli_real_escape_string($conn, $ItemName);
$ItemName = strip_tags($ItemName);

// gather information from their user account
$sql = "SELECT * FROM Asset WHERE AssetUID=$ItemName";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table>
		<tr>
			<th>AssetUID</th>
			<th>AgreementUID</th>
			<th>OwnerUID</th>
			<th>AssetTypeUID</th>
			<th>AssetDescription</th>
			<th>AssetCondition</th>
			<th>assetImage</th>
			<th>AssetRestriction</th>
			
			<th>Edit</th>
			
		</tr>";
    while($row = mysqli_fetch_assoc($result)) 
    {
    	$Asset =$row["AssetUID"];
		$AgreementType =$row["AgreementUID"];
    	$Owner =$row["OwnerUID"];
		$AssetType = $row['AssetTypeUID'];
    	$AssetDescription =$row["AssetDescription"];
		$AssetCondition =$row["AssetCondition"];
    	$Image =$row["AssetImage"];
    	$ItemType =$row["AssetTypeUID"];   	
    	$Restrictions =$row["AssetRestriction"];
    	
    	

    	if ($AgreementType == 3 ) {
    		$AgreementType = 'EEG Agree';
    	}
        if ($AgreementType == 4 ) {
            $AgreementType = 'Ian Agree';
        }
         if ($AgreementType == 5 ) {
            $AgreementType = 'Matteo Agree';
        }
    	
    	if ($ItemType == 1 ) {
    		$ItemType = 'Pi';
    	}
    	if ($ItemType == 2 ) {
    		$ItemType = 'Book';
    	}
    	if ($ItemType == 3 ) {
    		$ItemType = 'Lego';
    	}
    	if ($AssetCondition == 1 ) {
    		$AssetCondition = 'Perfect';
    	}
    	if ($AssetCondition == 2 ) {
    		$AssetCondition = 'Minor Scuffs';
    	}
    	if ($AssetCondition == 3 ) {
    		$AssetCondition = 'Some Damage';
    	}
    	if ($AssetCondition == 4 ) {
    		$AssetCondition = 'Broken';
    	}
		if ($Restrictions ==1){
			$Restrictions = 'All';
		}
		if ($Restrictions ==2){
			$Restrictions = 'Third Year and Above';
		}
		if ($Restrictions ==3){
			$Restrictions = 'Post Grads only';
		}
		if ($Restrictions ==4){
			$Restrictions = 'Tutors only';
		}


    	 echo "<tr>
		    	 <td>$Asset</td>
		    	 <td>$AgreementType</td>
		    	 <td>$Owner</td>
		    	 <td>$ItemType</td>
		    	 <td>$AssetDescription</td>
		    	 <td>$AssetCondition</td>
		    	 <td><img src='$Image' height='60' width='100'></td>
		    	 <td>$Restrictions</td>
		    	 
                 
				 <td><button class='editItem' value='$Asset'>Edit</button></td>
    	 		</tr>"; // delete does not do anything yet
    }
} else
{
    echo "0 results";
}
mysqli_close($conn);
?>


<div class='phpechofront2'>
    <h1 class='agreeTitle'>Editing Item</h1>
    <h2 class='help'>Complete this Form to edit your Asset</h2>
        <input type='text' id='ItemName' required class ='FormItems testname' disabled='true'>
    <span id='error'></span>
        <button id='Infobutton2' class='FormItems'> Submit </button>
        <button id='CancelDelete' class='FormItems'> Cancel </button>
</div>

<script>
$(document).ready(function() {
        $('.editItem').click(function() {
            $(".testname").val($(this).val());

        });
    });
    
</script>
<script>
$(document).ready(function() // wait till the page is ready
{
    $("#CancelDelete").click(function() // wait till this button has been pressed
      { 
          
		  $(".phpechofront2").hide(); // show the main nav
      });
  });
</script>

<script>
    $('#Infobutton2').click(function() { //wait for the button to be pressed, this will need a name change 
       var val1 = $('#ItemName').val(); 
        
        $.ajax({ // now the ajax
        type: 'POST', // we are posting it 
        url: 'ajax/Pages/Inventory/edit_inventory_commit.php', // this is where we're posting 
        data: { ItemName: val1}, // set the php values
        success: function(response) { // this wont work lol, it does not need to, 
            $('#result').html(response);
            $(".holder").load("ajax/Pages/Inventory/current_inventory.php");
        }
        });
});
</script>