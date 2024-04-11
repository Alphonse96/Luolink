<?php
include("php/config.php");

// save translation : processing 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Accessing the data
    $sourceText = $data['sourceText'];
    $translatedText = $data['translatedText'];

    $sqlSaveStatement = 'INSERT INTO text (original_text, translated_text) VALUES ("$sourceText","$translatedText")';
    if ($con->execute_query($sqlSaveStatement)){
        echo "<script> alert(\"Translation successfully saved !\"); </script>";
    }
} else {
    // Handle the request method other than POST if needed
    echo "Invalid request method";
}

