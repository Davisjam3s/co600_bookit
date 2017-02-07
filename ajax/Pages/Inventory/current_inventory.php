<style>
    .phpechofront1,.phpechofront2{
        display: none;
    }
</style>

<script>
$(document).ready(function() // wait till the page is ready
{
    $(".deleteItem").click(function() // wait till this button has been pressed
      { 
          $(".phpechofront1").show(); // show the main nav
      });
  });
</script>
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
echo "<p>Your Inventory</p>"; // dont delete this
?>
<?php require 'user_info.php' ?>
<?php require '../../../php/Conection.php';?>
<?php
$sql = "SELECT * FROM Asset WHERE OwnerUID = '$user' ";
$result = mysqli_query($conn, $sql);

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
			<th>AssetInBasket</th>
            <th>Delete</th>
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
    	$InBasket =$row["AssetInBasket"];
    	

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
		    	 <td>$InBasket</td>
                 <td><button class='deleteItem' value='$Asset'>Delete</button></td>
				 <td><button class='editItem' value='$Asset'>Edit</button></td>
    	 		</tr>"; // delete does not do anything yet
    }
} else
{
    echo "0 results";
}
mysqli_close($conn);
?>

<div class='phpechofront1'>
    <h1 class='agreeTitle'>Removing Item</h1>
    <h2 class='help'>By deleting this Item all the Assets will be lost</h2>
        <input type='text' id='ItemName' required class ='FormItems testname' disabled='true'>
    <span id='error'></span>
        <button id='Infobutton1' class='FormItems'> Submit </button>
        <button id='CancelDelete' class='FormItems'> Cancel </button>
</div>
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
        $('.deleteItem').click(function() {
            $(".testname").val($(this).val());

        });
    });
    
</script>
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
          $(".phpechofront1").hide(); // show the main nav
		  $(".phpechofront2").hide(); // show the main nav
      });
  });
</script>
<script>
    $('#Infobutton1').click(function() { //wait for the button to be pressed, this will need a name change 
       var val1 = $('#ItemName').val(); 
        
        $.ajax({ // now the ajax
        type: 'POST', // we are posting it 
        url: 'ajax/Pages/Inventory/remove_inventory.php', // this is where we're posting 
        data: { ItemName: val1}, // set the php values
        success: function(response) { // this wont work lol, it does not need to, 
            $('#result').html(response);
            $(".holder").load("ajax/Pages/Inventory/current_inventory.php");
        }
        });
});
</script>
<script>
    $('#Infobutton2').click(function() { //wait for the button to be pressed, this will need a name change 
       var val1 = $('#ItemName').val(); 
        
        $.ajax({ // now the ajax
        type: 'POST', // we are posting it 
        url: 'ajax/Pages/Inventory/edit_inventory.php', // this is where we're posting 
        data: { ItemName: val1}, // set the php values
        success: function(response) { // this wont work lol, it does not need to, 
            $('#result').html(response);
            $(".holder").load("ajax/Pages/Inventory/edit_inventory.php");
        }
        });
});
</script>