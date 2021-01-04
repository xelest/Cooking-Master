<?php
include_once('connects.php');
$rec_id = $_POST['rec_id'];
$ingredient = array();
$amount = array();
$measurement = array();
$stock = array();
$meas = array();
$counter = 0;



	$string = "SELECT recipe.kilogram as kilogram, recipe.recipe_id as rec_id , recipe.recipe_name as name, recipe.main_ingr as main, recipe.rating as rate, recipe.image as img, recipe_steps.date_created as date_created,recipe.type_ingr as type, recipe_steps.steps_id as step_id FROM recipe INNER JOIN recipe_steps ON recipe.recipe_id = recipe_steps.rec_id WHERE recipe.recipe_id = '$rec_id'";

	$result = mysqli_query($con,"SELECT steps_id FROM recipe_steps WHERE rec_id = '$rec_id'");
	$row = mysqli_fetch_assoc($result);
	$steps_id  = $row['steps_id'];



	$ingrString = "SELECT * FROM ingredients_steps WHERE steps_id = '$steps_id'";
	$result = mysqli_query($con,$string);
	$row = mysqli_fetch_assoc($result);
	$recipe_name = $row['name'];
	$ingredient[$counter] = $row['main'] . " " . $row['type'];
	$amount[$counter] = $row['kilogram'];
	$measurement[$counter] = "kg";
	$counter++;

	$result = mysqli_query($con,$ingrString);

	while($extract = mysqli_fetch_array($result))
	{
		$ingredient[$counter] = $extract['ingredient'];
		$amount[$counter] = $extract['amount'];
		$measurement[$counter] = $extract['measurement'];
		$counter++;
	}

	for($i=0;$i<$counter;$i++)
	{
		$string2 = "SELECT * FROM ingredient_stocks WHERE stock_name = '$ingredient[$i]'";

		$result2 = mysqli_query($con,$string2);

		if(mysqli_num_rows($result2)>=1)
		{
			$row2 = mysqli_fetch_assoc($result2);
			$stock[$i] = $row2['amount'];
			$meas[$i] = $row2['measurement'];
		}
		else
		{
			$stock[$i] = 0;
			$meas[$i] = "none";
		}

	}

	$string3 = "SELECT * FROM procedure_steps where steps_id ='$steps_id'";
	$result3 = mysqli_query($con,$string3);
	$caption = array();
	$desc = array();
	$cunt = 0;
	$stepcounter = 1;

	while($extract = mysqli_fetch_array($result3))
	{
		$caption[$cunt] = $extract['caption'];
		$desc[$cunt] = $extract['instruction'];
		$stepcounter++;
		$cunt++;
	}

?>

<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript">

	$( document ).ready(function() {
    
	var ingredient = <?php echo json_encode($ingredient)?>;
	var flag = "false";
	var amount = <?php echo json_encode($amount)?>;
	var measurement = <?php echo json_encode($measurement)?>;
	var stock = <?php echo json_encode($stock)?>;
	var meas = <?php echo json_encode($meas)?>;
	var counter = <?php echo $counter ?>;
	var stepcounter = <?php echo $stepcounter ?>;
	var caption = <?php echo json_encode($caption)?>;
	var desc = <?php echo json_encode($desc)?>;
	var flag = [];
	var flag2 = "false";
	var used = [];
	var count = 1;
	var i = 0;
	var index = 0;
	var j = 1;
	
	var standard = <?php echo json_encode($amount[0])?>;


  	for(i=0;i<counter;i++)
  	{
  		var converted = convertValue(amount[i], measurement[i]);
  		
  		used[i] = converted;
  		var row = $("<tr>");
  		if(count==1)
  			row.append($("<td>" + count + "(main)</td>"));
  		else
  			row.append($("<td>" + count + "</td>"));
  		row.append($("<td>" + ingredient[i] + "</td>"));

  		if(converted<=stock[i])
  		{
  				row.append($("<td>" + amount[i] + "</td>"));
  				flag[i] = "false";
  		}
  		else
  		{
  				row.append($("<td style='color:red;'>" + amount[i] + "</td>"));
  				flag[i] = "true";
  				flag2 = "true";
  		}
  		row.append($("<td>" + measurement[i] + "</td>"));

  		$("#MyTable").append(row);
  		count++;
  	}



  	$('#adjust').click(function() {

  		$('#MyTable').empty();
  		count = 1;
  		var newVal = document.getElementById("mainKG").value;
  		var adjustment = newVal / standard;

  		var row = $("<tr>");
  		row.append($("<td>Number</td>"));
  		row.append($("<td>Ingredient</td>"));
  		row.append($("<td>Amount</td>"));
  		row.append($("<td>Measurement</td>"));
  		$("#MyTable").append(row);

  		for(i=0;i<counter;i++)
  		{
  			var adjustVal = amount[i] * adjustment;
  			var converted = convertValue(adjustVal, measurement[i]);
  			used[i] = converted;
  			var row = $("<tr>");
  			if(count==1)
  				row.append($("<td>" + count + "(main)</td>"));
  			else
  				row.append($("<td>" + count + "</td>"));

  			row.append($("<td>" + ingredient[i] + "</td>"));

  			if(converted<=stock[i])
  			{
  				row.append($("<td>" + adjustVal + "</td>"));
  				flag[i] = "false";
  				flag2 = "true";
  			}
  			else{
  				row.append($("<td style='color:red;'>" + adjustVal + "</td>"));
  				flag[i] = "true";
  			}
  			row.append($("<td>" + measurement[i] + "</td>"));

  			$("#MyTable").append(row);
  			count++;
  		}

	});


	$('#confirm').click(function(){

		if (confirm("Use Stock Ingredient?")) {

			if(flag2=="true")
			{

				if(confirm("Not enough stock. Do you still want to use ingredients that have enough amount?")){
					$("#loadAlert").load("steps.php",{
  						used:used,
  						ingredient: ingredient,
  						count: counter,
  						meas: meas,
  						flag: flag
      				});

  				}
  				else
  				{

  				}
			} else {
  				$("#loadAlert").load("steps.php",{
  					used:used,
  					ingredient: ingredient,
  					count: counter,
  					meas: meas,
  					flag: flag
      			});

			}
		}
		else {

		}

		//div for appending steps

		for(j=1;j<stepcounter;j++)
		{
			var divStep = "<div>Step " + j + ":" + caption[index] +"<br>" + desc[index] +"<br></div><br>";
			$("#steps").append(divStep);
			index++;
		}

      	
	});
  	
  	function convertValue(amount, meas)
  	{
  		var convert = 0;

  		if(meas == "pinch")
  		{
  			convert = amount/2795.56;
  		}
  		else if(meas == "tsp")
  		{
  			convert = amount/202.8841362;
  		}
  		else if(meas == "Tbsp")
  		{
  			convert = amount/67.6280454;
  		}
  		else if(meas == "cup")
  		{
  			convert = amount/4;
  		}
  		else if(meas == "ml" || meas == "g")
  		{
  			convert = amount/1000;
  		}
  		else
  			convert = amount;

  		return convert;
  	}
 
	});
	

</script>
</head>

<body>
<?php echo $recipe_name;?> <br>
<table border=1 id="MyTable">
	<tr>
		<td>Number</td>
		<td>Ingredient</td>
		<td>Amount</td>
		<td>Measurement</td>
	</tr>
<table>
Change Main Amount:<input type="number" id='mainKG' value=<?php echo json_encode($amount[0])?>><input type='button' id='adjust' value='Change'>
<input type='button' id='confirm' value='Start Cooking'>

<div id='loadAlert'>
	
</div>
<div id='steps'>

</div>

</body>
</html>
