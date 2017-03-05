<?php
	$server = "localhost";
	$username = "shady";
	$password = "hello";
	$db = "learn_php";
	$conn = mysqli_connect($server, $username, $password, $db);
	
	
	
	
?>
<html>
	<head>
		<title>Become A Professional Web Developer</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
	</head>
	
	<body>
		<!--<form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
			<label for="username">Enter Your Name</label>
			<input type="text" placeholder = "Insert User Name" name = "username"><br>
			<label for="password">Enter password</label>
			<input type="password" name = "password" placeholder = "enter Your password">
			<input type="submit" name = "submit">
		</form><br><br><br><br>-->
		
		<div class="container">
			<div class="jumbotron">
				<h2>Simple Crud (PHP with MYSQL)</h2>
			</div>
			<?php
				if(isset($_GET['edit_id'])){
					$sql = "SELECT * FROM users WHERE u_id = '$_GET[edit_id]'";
					$run = mysqli_query($conn, $sql);
					while($rows = mysqli_fetch_assoc($run)){
						$user = $rows['name'];
						$email = $rows['email'];
						$password = $rows['password'];
						$contactnumber = $rows['contact_number'];
						
					}
					?>
					
					<h2>Edit User</h2>
					<form action="" class = "col-md-6" method = "post">
						<div class="form-group">
						<label for="edit_user">User Name :</label>
						<input name = "edit_user_new" type="text" class="form-control" value = "<?php echo $user;?>" required>
						
						
						</div>
						<div class="form-group">
						<label for="edit_email">Email Address :</label>
						<input name = "edit_email_new" type="email" class="form-control" value = "<?php echo $email;?>" required>
						
						
						</div>
						<div class="form-group">
						<label for="edit_password">Password :</label>
						<input name = "edit_password_new" type="password" class="form-control" value = "<?php echo $password;?>" required>
						
						<script>
							
						</script>
						</div>
						<div class="form-group">
						<label for="edit_contactnumber">Contact Number :</label>
						<input name = "edit_contactnumber_new" type="text" class="form-control" value = "<?php echo $contactnumber;?>" >
						
						
						</div>
						<div class="form-group">
						<input name = "edit_user_id" value = "<?php echo $_GET['edit_id'];?>" type="hidden"">
						
						<input value = "Done Editing" type="submit" class="btn btn-primary" name = "edit_button">
						
						</div>
					</form>
		<?php	}else{?>
					<h2>Insert New User</h2>
					<form action="" class = "col-md-6" method = "post">
						<div class="form-group">
						<label for="user">User Name :</label>
						<input name = "user" type="text" class="form-control" required>
						</div>
						<div class="form-group">
						<label for="email">Email Address :</label>
						<input name = "email" type="email" class="form-control" required>
						</div>
						<div class="form-group">
						<label for="password">Password :</label>
						<input name = "password" type="password" class="form-control" required>
						</div>
						<div class="form-group">
						<label for="contact_number">Contact Number :</label>
						<input name = "contactnumber" type="text" class="form-control">
						</div>
						<div class="form-group">
						<input name = "submit_user" type="submit" value = "submit" class="btn btn-primary">
						</div>
					</form>
			<?php	}
			?>
			
			<?php
				$sql = "SELECT * FROM users";
				$run = mysqli_query($conn, $sql);
				echo "
				<table class = 'table'>
					<thead>
						<tr>
							<th>S.No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>ContactNumber</th>
							<th>Date</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
				";
				while($rows = mysqli_fetch_assoc($run)){
					echo "
					<tr>
						<td>".$rows['u_id']."</td>
						<td>".$rows['name']."</td>
						<td>".$rows['email']."</td>
						<td>".$rows['password']."</td>
						<td>".$rows['contact_number']."</td>
						<td>".$rows['date']."</td>
						<td><a href='index.php?edit_id=$rows[u_id]' class = 'btn btn-success'>Edit</a></td>
						<td><a href='index.php?del_id=$rows[u_id]' class = 'btn btn-danger'>Delete</a></td>
					</tr>
					";
				}
				echo "
					</tbody>
				</table>
				";
				
			?>
		</div>
		
	</body>
</html>
<?php
	if(isset($_POST['submit_user'])){
		$user = mysqli_real_escape_string($conn, strip_tags($_POST['user']));
		$email = mysqli_real_escape_string($conn, strip_tags($_POST['email']));
		$password = mysqli_real_escape_string($conn, strip_tags($_POST['password']));
		if(isset($_POST['contactnumber'])){
			$contactnumber = mysqli_real_escape_string($conn, strip_tags($_POST['contactnumber']));
		}
		$date = date('Y/m/d');
		$ins_sql = "INSERT INTO users (name, email, password, contact_number, date) VALUES ('$user', '$email', '$password', '$contactnumber', '$date')";
		if(mysqli_query($conn, $ins_sql)){ ?>
			<script>
				window.location = "index.php";
			</script>
			
			<?php
				
			
		}
	}
	if(isset($_GET['del_id'])){
		$del_sql = "DELETE FROM users WHERE u_id = '$_GET[del_id]'";
		if(mysqli_query($conn, $del_sql)){?>
			<script>
				window.location = "index.php";
			</script>
			
			<?php
		}
	}
	
	if(isset($_POST['edit_button'])){
		$edit_user = mysqli_real_escape_string($conn, strip_tags($_POST['edit_user_new']));
		$edit_email = mysqli_real_escape_string($conn, strip_tags($_POST['edit_email_new']));
		$edit_password = mysqli_real_escape_string($conn, strip_tags($_POST['edit_password_new']));
		$edit_contactnumber = mysqli_real_escape_string($conn, strip_tags($_POST['edit_contactnumber_new']));
		$edit_id = $_POST['edit_user_id'];
		$edit_sql = "UPDATE users SET name = '$edit_user', email = '$edit_email', password = '$edit_password', contact_number = '$dedit_contactnumber' WHERE u_id = '$edit_id'";
		if(mysqli_query($conn, $edit_sql)){?>
			<script>
				window.location = "index.php";
			</script>
		<?php
		}
	}
	
?>
