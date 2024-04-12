<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit();
}

// Include the database connection file
include_once "php/config.php";

// Fetch data from the 'texts' table
$sql = "SELECT * FROM `text` WHERE `Id` IS NOT NULL"; // Query to fetch all rows with non-null Id
$result = mysqli_query($con, $sql);

// Check for errors in query execution
if (!$result) {
  // If there's an error, display an error message and terminate execution
  echo "Error: " . mysqli_error($con);
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard </title>
    <!-- Include any necessary CSS styles -->
    <link rel="stylesheet" href="style/style.css">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        
.logo {
    /* Push the logo to the left */
    margin-right: auto; /* Auto margin pushes the logo to the left */
}

.logout {
    /* Push the logout button to the right */
    margin-left: auto; /* Auto margin pushes the logout button to the right */
}
        .navbar-left {
            display: flex;
            align-items: center;
        }

        .navbar-left h1 {
            margin: 0;
            padding: 0;
            font-size: 24px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .navbar-right a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }

        .profile-box {
            position: relative;
        }

        .profile-box .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }

        .profile-box:hover .dropdown-content {
            display: block;
        }

        /* Centering text areas */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .profile-image {
            width: 30px; /* Adjust the width as needed */
            height: 30px; /* Adjust the height as needed */
            border-radius: 50%; /* Makes the boundary circular */
            object-fit: cover; /* Ensures the image covers the entire container */
        }

        textarea {
            width: 50%;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            width: 50%;
            margin-bottom: 20px;
        }

        button {
            width: 48%;
        }
         /* Additional CSS for the white box background */
        #translatedTextContainer {
            width: 50%;
            margin-top: 20px;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #translatedText {
            width: 50%;
            text-align: center;
        }

        table {
    border-collapse: separate;
    border-spacing: 10px; /* Adjust spacing between cells */
    width: 90%; /* Make the table wider */
    background-color: #fff; /* White background */
       }

       th, td {
    border: 1px solid #ccc; /* Grey border */
    padding: 12px; /* Padding around cell content */
    text-align: left;
       }

     th {
    background-color: #333;
    color: #fff;
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="nav">
        <div class="logo">
            <p><a href="admin_dashboard.php"> Luolink</a></p>
        </div>
              <div class="logout">
        <a href="php/logout.php"><button class="btn">Log Out</button></a>
    </div>
    </div>
    <div class="container">
        <h2>History</h2>
        <?php
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Output table headers
            echo "<table>";
            echo "<tr><th>User ID</th><th>Text ID</th><th>Original Text</th><th>Translated Text</th><th>Date Posted</th></tr>";

            // Output data for each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>"; // Assuming 'Id' refers to the user Id
                echo "<td>" . $row['text_id'] . "</td>";
                echo "<td>" . $row['original_text'] . "</td>";
                echo "<td>" . $row['translated_text'] . "</td>";
                echo "<td>" . $row['date_posted'] . "</td>";
                echo "</tr>";
            }

            // Close the table
            echo "</table>";
        } else {
            // If no rows are returned, display a message
            echo "No history found.";
        }
        ?>
    </div>
</body>
</html>