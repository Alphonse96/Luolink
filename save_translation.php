<?php
include("php/config.php");

// save translation : processing 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Accessing the data
    $userId = $data['userId'];
    $sourceText = $data['sourceText'];
    $translatedText = $data['translatedText'];

    try {
        // Prepare SQL statement
        $sqlSaveStatement = 'INSERT INTO text (Id, original_text, translated_text) VALUES (?, ?, ?)';
        
        // Prepare and execute the statement
        $stmt = $con->prepare($sqlSaveStatement);
        $stmt->bind_param('iss', $userId, $sourceText, $translatedText);
        $stmt->execute();
    } catch (Exception $e) {
        // Handle exceptions
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle the request method other than POST if needed
    echo "Invalid request method";
}
