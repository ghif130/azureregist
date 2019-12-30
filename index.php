<html>
	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>			
		<center>
		<p style="margin-top:150 "></p>
		<div class="col-md-7" style="background-color:white">
		<form  class="form-horizontal" method="post" action="index.php" enctype="multipart/form-data" >	
			<h1 style="text-align:center">REGISTER</h1>
			<p style="text-align:center">Fill in your name and email address, then click <strong>Submit</strong> to register.</p>			
			<div class="form-group">
				<label class="control-label" for="nama">Name : </label>
				<input type="text" class="form-control col-md-4" id="nama" placeholder="Input Name" name="name" id="name"/>
			</div>
			<div class="form-group">
			<label class="control-label" for="nama">Email : </label>
			<input type="text" class="form-control col-md-4" id="nama" placeholder="Input Email" name="email" id="email"/>
			</div>
			<label class="control-label" for="nama">Job : </label>
			<input type="text" class="form-control col-md-4" id="nama" placeholder="Input Job" name="job" id="job"/><br>
			<div class="form-group">
			<input class="btn btn-secondary" type="submit" name="submit" value="Submit" />
			<input class="btn btn-secondary" type="submit" name="load_data" value="Load Data" />			
			</div>
		</form>
		</div>
		</center>
	<?php
		$servername = "https://dicodingappsserver1.database.windows.net";
		$username = "admin96";
		$password = "AbdiGhif96";
		$dbname = "dicodingdb";
		
		$conn = new mysqli($servername, $dbname, $username, $password);		
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $job = $_POST['job'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO dbo.regist(name, email, job, date) VALUES('$name','$email','$job','date')";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name); 
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $job);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM dbo.regist";
            $stmt = $conn->query($sql_select);
            $regist = $stmt->fetchAll(); 
            if(count($regist) > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Job</th>";
                echo "<th>Date</th></tr>";
                foreach($regist as $regist) {
                    echo "<tr><td>".$regist['name']."</td>";
                    echo "<td>".$regist['email']."</td>";
                    echo "<td>".$regist['job']."</td>";
                    echo "<td>".$regist['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
	?>
	</body>
</html>