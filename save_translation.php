<?php
include("php/config.php");

// save translation : processing 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Accessing the data
    $sourceText = $data['sourceText'];
    $translatedText = $data['translatedText'];

    try {
        // Prepare SQL statement
        $sqlSaveStatement = 'INSERT INTO text (original_text, translated_text) VALUES (?, ?)';
        
        // Prepare and execute the statement
        $stmt = $con->prepare($sqlSaveStatement);
        $stmt->bind_param('ss', $sourceText, $translatedText);
        $stmt->execute();

        echo "Translation successfully saved!";
    } catch (Exception $e) {
        // Handle exceptions
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle the request method other than POST if needed
    echo "Invalid request method";
}
?>
