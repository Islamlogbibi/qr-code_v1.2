<!-- Index.html file -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet"
		href="style.css">
	<title>QR Code Scanner
	</title>
    <style>
        /* style.css file*/
body {
	font-family: Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	height: 100vh;
	box-sizing: border-box;
	text-align: center;
	display: grid;
	grid-template-columns: repeat(2, auto);
	background: #f5f5f5;
	padding: 10px 20px 20px 50px;
}
.container {
	width: 600px;
	max-width: 500px;
	height: 450px;
	margin: 5px;
	display: flex;
	justify-content: center;
	align-items: center;
	display: grid;
	grid-template-rows: repeat(2, auto);
}

.container h1 {
	color: black;
	
}

.section {
	background-color: #ffffff;
	padding: 50px 30px;
	border: 1.5px solid #b2b2b2;
	border-radius: 0.25em;
	box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
}

#my-qr-reader {
	padding: 20px !important;
	border: 1.5px solid #b2b2b2 !important;
	border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
	display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
	width: 100px !important;
	height: 100px !important;
}

button {
	padding: 10px 20px;
	border: 1px solid #b2b2b2;
	outline: none;
	border-radius: 0.25em;
	color: white;
	font-size: 15px;
	cursor: pointer;
	margin-top: 15px;
	margin-bottom: 10px;
	background-color: #5AB2FF;
	transition: 0.3s background-color;
}

button:hover {
	background-color: #378CE7;
}

#html5-qrcode-anchor-scan-type-change {
	text-decoration: none !important;
	color: #1d9bf0;
}

video {
	width: 100% !important;
	border: 1px solid #b2b2b2 !important;
	border-radius: 0.25em;
}

    </style>
</head>

<body>
	<div class="container">
		<h1>Scan QR Codes</h1>
		<div class="section">
			<div id="my-qr-reader">
			</div>
		</div>
	</div>
	<script
		src="https://unpkg.com/html5-qrcode">
	</script>
	<script>
		function domReady(fn) {
			if (
				document.readyState === "complete" ||
				document.readyState === "interactive"
			) {
				setTimeout(fn, 1000);
			} else {
				document.addEventListener("DOMContentLoaded", fn);
			}
		}

		domReady(function () {

			
			function onScanSuccess(decodeText, decodeResult) {
				let id = decodeText;
				console.log(id);
				document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
				
				document.cookie = "id=" + id;
				setTimeout(function(){
				location.reload(); 
			}, 1);
			}

			let htmlscanner = new Html5QrcodeScanner(
				"my-qr-reader",
				{ fps: 10, qrbos: 250 }
			);
			htmlscanner.render(onScanSuccess);
		});

    </script>
    <?php
    
    include ("db.php");
	$no = "no";
    if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
		$no = "yes";
			if ($id != NULL) {
				$sql = "SELECT * FROM users WHERE id = ?";
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_bind_param($stmt, "s", $id);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$fullname = $row["fullname"];
					$number = $row["serial_number"];
					$year = $row["creation_year"];
					$wilaya = $row["wilaya"];
					$assurance = $row["assurance"];
					$license = $row["driving_license"];
					
				}else{
					echo "user not found";
					$no = "no";
					
				}
				
			}
    }

    if ($no == "yes") {
		?>
			<div>
				<button onclick="location.href='login.php'">login</button>
				<h1>nom et prénom: <?php echo $fullname ?></h1>
				<h1>matricule: <?php echo $number ?></h1>
				<h1>anné: <?php echo $year ?></h1>
				<h1>wilaya: <?php echo $wilaya ?></h1>
				<img src="images/<?php echo $assurance ?>" alt="" width="200px" height="200px">
				<img src="images/<?php echo $license ?>" alt="" width="200px" height="200px">
			</div>
		<?php
	}
	?>
</body>

</html>
