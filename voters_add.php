<?php
	
	session_start();
	$conn = new mysqli('localhost', 'root', '', 'votesystem');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}	

	if(isset($_POST['add'])){
		$nidno = $_POST['nidno'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$filename);	
		}
		// //generate voters id
		// $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// $voter = substr(str_shuffle($set), 0, 15);

		$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo) VALUES ('$nidno', '$password', '$firstname', '$lastname', '$filename')";
		if($conn->query($sql)){
			echo("<script>console.log('successful');</script>");
			header('location: index.php');
		}
		

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	
?>