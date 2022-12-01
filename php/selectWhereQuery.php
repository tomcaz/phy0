<!doctype html>
<!-- (C) Vision Realestate -->
<html>
<head>
    <title>Display Records of a table</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <?php
    $servername = "localhost";
    $dbname = "realestate";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green'>Connection Was Successful</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'> Connection Failed: " . $err->getMessage() . "</p>\r\n";
    }

    try {
        $sql = "SELECT PropertyID,PropDescription,Zipcode,ListingPrice FROM Property WHERE ListingPrice < $_POST[ListingPrice]";
        $stmnt = $conn->prepare($sql);

        $stmnt->execute();

        $row = $stmnt->fetch();
        if ($row) {
            echo '<table>';
            do {
                echo "<tr><td>$row[PropertyID]</td><td>$row[PropDescription]</td><td>$row[Zipcode]</td><td>$row[ListingPrice]</td><td>";
            } while ($row = $stmnt->fetch());
            echo '</table>';
        } else {
            echo "<p> No Record Found!</p>";
        }
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Retrieval Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>
</body>

</html>