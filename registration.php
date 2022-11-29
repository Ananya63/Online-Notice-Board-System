<?php
require('connection.php');
extract($_POST);
if(isset($save))
{
//check user alereay exists or not
$sql=mysqli_query($conn,"select * from user where email='$e'");

$r=mysqli_num_rows($sql);

if($r==true)
{
$err= "<font color='red'>This user already exists</font>";
}
else
{
//dob
$dob=$yy."-".$mm."-".$dd;

//hobbies
$hob=implode(",",$hob);

//image
$imageName=$_FILES['img']['name'];


//encrypt your password
$pass=md5($p);


$query="insert into user values('','$n','$e','$pass','$mob','$gen','$hob','$imageName','$dob',now())";
mysqli_query($conn,$query);

//upload image

mkdir("images/$e");
move_uploaded_file($_FILES['img']['tmp_name'],"images/$e/".$_FILES['img']['name']);


$err="<font color='blue'>Registration successfull !!</font>";

}
}




?>
<h2><b>REGISTRATION FORM</b></h2>
		<form method="post" enctype="multipart/form-data">
			<table class="table table-bordered">
	<Tr>
		<Td colspan="2"><?php echo @$err;?></Td>
	</Tr>

				<tr>
					<td>Your Name: </td>
					<Td><input  type="text"  class="form-control" name="n" required/></td>
				</tr>
				<tr>
					<td>Your Email: </td>
					<Td><input type="email"  class="form-control" name="e" required/></td>
				</tr>

				<tr>
					<td>Your Password: </td>
					<Td><input type="password"  class="form-control" name="p" required/></td>
				</tr>

				<tr>
					<td>Your Mobile No.: </td>
					<Td><input  class="form-control" type="number" name="mob" required/></td>
				</tr>

				<tr>
					<td>Select Your Gender: </td>
					<Td>
				Male<input type="radio" name="gen" value="m" required/>
				Female<input type="radio" name="gen" value="f"/>
					</td>
				</tr>

				<tr>
					<td>Choose Your Hobbies: </td>
					<Td>
					Reading<input value="reading" type="checkbox" name="hob[]"/>
					Singing<input value="singin" type="checkbox" name="hob[]"/>

					Playing<input value="playing" type="checkbox" name="hob[]"/>
					</td>
				</tr>


				<tr>
					<td>Upload Your Image </td>
					<Td><input class="form-control" type="file" name="img" required/></td>
				</tr>

				<tr>
					<td>Date of Birth: </td>
					<Td>
					<select name="yy" required>
					<option value="">Year</option>
					<?php
					for($i=1950;$i<=2016;$i++)
					{
					echo "<option>".$i."</option>";
					}
					?>

					</select>

					<select name="mm" required>
					<option value="">Month</option>
					<?php
					for($i=1;$i<=12;$i++)
					{
					echo "<option>".$i."</option>";
					}
					?>

					</select>


					<select name="dd" required>
					<option value="">Date</option>
					<?php
					for($i=1;$i<=31;$i++)
					{
					echo "<option>".$i."</option>";
					}
					?>

					</select>

					</td>
				</tr>

				<tr>


<Td colspan="2" align="center">
<input type="submit" class="btn btn-success" value="Save" name="save"/>
<input type="reset" class="btn btn-success" value="Reset"/>

					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
