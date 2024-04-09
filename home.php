<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Translation App</title>
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-left">
            <h1>LuoLink</h1>
        </div>
        <div class="navbar-right">
            <div class="navbar-left">
                <a href="history.php">History</a>
            </div>
            <div class="navbar-right">
             <a href="#">
                 <img src="images/profile-icon.jpg" alt="Profile Picture" class="profile-image">
             </a>

                <div class="profile-box">
                    <div class="dropdown-content">
                        <a href="#">My Profile</a>
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Translation form -->
    <div class="container">
        <label for="englishText">Enter English Text:</label>
        <textarea id="englishText" rows="4" cols="50"></textarea>
        <div class="button-group">
            <button onclick="translate()">Translate</button>
            <button onclick="saveTranslation()">Save</button>
        </div>
         <!-- White box background for translated text -->
         <div id="translatedTextContainer">
            <h2>Translated Text:</h2>
            <!-- Move the label above the white box -->
            <p id="translatedText"></p>
        </div>
    </div>

    <!-- Include any necessary JavaScript code -->
    <script>
        async function query(data) {
            const response = await fetch(
                "translate.php",
                {
                    headers: { "Content-Type": "application/json" },
                    method: "POST",
                    body: JSON.stringify(data),
                }
            );
            const result = await response.json();
            return result;
        }

        function translate() {
            var englishText = document.getElementById("englishText").value;
            var data = { "inputs": englishText };

            query(data).then((response) => {
                document.getElementById("translatedText").innerText = response.outputs;
            }).catch((error) => {
                console.error('Error:', error);
            });
        }

        function saveTranslation() {
            // Implement functionality to save translation
            // You may need AJAX to send data to server-side PHP script
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
