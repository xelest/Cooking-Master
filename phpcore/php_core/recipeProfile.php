<?php
include_once('connects.php');
$rec_id = $_POST['rec_id'];

$string = "SELECT recipe.kilogram as kilogram, recipe.recipe_id as rec_id , recipe.recipe_name as name, recipe.main_ingr as main, recipe.rating as rate, recipe.image as img, recipe_steps.date_created as date_created,recipe.type_ingr as type, recipe_steps.steps_id as step_id FROM recipe INNER JOIN recipe_steps ON recipe.recipe_id = recipe_steps.rec_id WHERE recipe.recipe_id = '$rec_id'";

$result = mysqli_query($con,"SELECT steps_id FROM recipe_steps WHERE rec_id = '$rec_id'");
$row = mysqli_fetch_assoc($result);
$steps_id  = $row['steps_id'];

$ingrString = "SELECT * FROM ingredients_steps WHERE steps_id = '$steps_id'";

?>

<html>
<body>


<?php
	$result = mysqli_query($con,$string);
	$row = mysqli_fetch_assoc($result);
?>
Recipe Name: <?php echo $row['name']; ?> <br>
Main Ingredient: <?php echo $row['main']; ?> <br>
Rating: <?php echo $row['rate']; ?> <br>
Date Created: <?php echo $row['date_created']; ?> <br>
Ingredients:<br>
<?php echo $row['main'] . " " . $row['type'] . " " . $row['kilogram'] . " kg"; ?> <br>
<?php
	$result = mysqli_query($con,$ingrString);

	while($extract = mysqli_fetch_array($result))
	{
		echo $extract['ingredient'] . "  " . $extract['amount'] . "  " . $extract['measurement'] . "<br>";
	}
?>
<form action='cookRecipe.php' method='post'>
<input type="hidden" name="rec_id" value=<?php echo json_encode($rec_id) ?>>
<input type="submit" value="Cook Recipe">
</form>

</body>
</html>
