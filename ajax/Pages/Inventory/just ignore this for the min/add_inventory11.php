
<script>
	$('.agreeselect').on('change', function() {
		if (this.value == 3) 
		{
			$(".boxbox").load("Agreements/EEG_Agreement.txt");
		}
		else if (this.value == 4) 
		{
			$(".boxbox").load("Agreements/Ians_Agreement.txt");
		}
		else if (this.value == 5) 
		{
			$(".boxbox").load("Agreements/Matteo_Agreement.txt");
		}
	})
</script>
<style>
	.addItemForm
	{
	background-color: transparent;

	text-align: center;
	}
	.restext
	{
		display: none;
		font-family: 'Amaranth', sans-serif;
	}
	.formItems
	{
		margin-top: 1em;
		text-align: center;
		font-family: 'Amaranth', sans-serif; /*what a nice font*/
		font-size: 1em;
	}
	.addextra
	{
		width: 25em;
		height: 5em;
	}
	.boxbox
	{
		width: 100%;
		height: 25em;
		
	}

</style><!-- dont worry fam, i will move these later-->
<?

//http://stackoverflow.com/questions/10899384/uploading-both-data-and-files-in-one-form-using-ajax
    print_r($_POST);
    print_r($_FILES);
?>
	<p>Add item</p> <!--did you know, I The amazing james, Forgot to add this and broke the page for 3 hours?-->
	<form   id="data" method="post" enctype="multipart/form-data" class="addItemForm"> <!--thats right, a form, for doing formy things-->
		<input type="text" class="formItems" id="ItemName" required="true" placeholder="Item Name"><br>
		<select class="formItems" id="Type">
			<option value="" selected disabled>Type</option> <!--haha trying using that-->
			<option value="1">Pi</option>
			<option value="2">Book</option>
			<option value="3">Lego</option>
			<option value="4">Other</option>
		</select>
		<br>
		<select class="formItems agreeselect" id="Agreement">
			<option value="" selected disabled class="">Agreement Type</option>
			<option value="0">None</option>
			<option value="3">EEG Agreement</option>
			<option value="4">Ians Agreement</option>
			<option value="5">Matteo Agreement</option>

		</select>
		<br>
 
		<select class="formItems" id="Restriction">
			<option value="" selected disabled class="">Restrictions</option>
			<option value="1">All</option>
			<option value="2">Third Year or Above</option>
			<option value="3">PostGrad only</option>
			<option value="4">Tutors Only</option>
		</select>

		
		<select class="formItems con" id="Condition">
			<option value="" selected disabled class="">Condition</option>
			<option value="1">Perfect</option>			
			<option value="2">Minor scuffs</option>
			<option value="3">Some Damage</option>
			<option value="4">Broken</option>
			
		</select>
		
		<br>
		  
		Select image to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<!--<input type="submit" value="Upload Image" name="submit">-->
		<br>

		<button>Submit</button>
		<br>
	</form> <!--this is no longer a form-->
	
		
	<br>
	<textarea class="boxbox"></textarea>

<script>
    $('form#data').submit(function() { //wait for the button to be pressed, this will need a name change 
    
	 var formData = new FormData($(this)[0];
    
        $.ajax({ // now the ajax
        type: 'POST', // we are posting it 
        url: '/ajax/Pages/Inventory/addItem12.php', // this is where we're posting 
        data: formData , // set the php values
        success: function(data) { // #ffsgraham 
            alert(data)
        },
		cache: false,
		contentType: false,
		processData: false
        });
		return false;
});
</script>


        
