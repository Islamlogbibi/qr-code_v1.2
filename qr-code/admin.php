<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <style>
        table{
            border: solid 1px black;
        }
        th{
            border: solid 1px black;
        }
        td{
            border: solid 1px black;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_SESSION["username"])) {
            require_once "db.php";
            
            ?>
            
            <button onclick="location.href='logout.php'">log out</button>
            <button onclick="location.href='insert.php'">insert</button>
            <div>
                            <table>
                                <tr>
                                    <th>id</th>
                                    <th>fullname</th>
                                    <th>serial number</th>
                                    <th>creation year</th>
                                    <th>wilaya</th>
                                    <th>assurance</th>
                                    <th>driving license</th>
                                    
                                </tr>
            
            <?php
            $sql = "SELECT * FROM users";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($result) {
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $fullname = $row["fullname"];
                        $serial_number = $row["serial_number"];
                        $creation_year = $row["creation_year"];
                        $wilaya = $row["wilaya"];
                        $assurance = $row["assurance"];
                        $driving_license = $row["driving_license"];
                        ?>
                        
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $serial_number; ?></td>
                                    <td><?php echo $creation_year; ?></td>
                                    <td><?php echo $wilaya; ?></td>
                                    <td><?php echo $assurance; ?></td>
                                    <td><?php echo $driving_license; ?></td>
                                </tr>
                            
                        <?php
    
                    }
                    ?>
                        </table>
                    </div>
                    <?php
                }
            }
                
        }
        else{
            header("location: login.php");
        }

?>
</body>
</html>