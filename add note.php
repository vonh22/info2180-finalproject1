<?php

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_input($input) {
    return htmlspecialchars(strip_tags($input));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $contact_id = isset($_POST["contact_id"]) ? intval($_POST["contact_id"]) : 0;

    $note_content = sanitize_input($_POST["note_content"]);

    
    $update_contact_query = "UPDATE contacts SET updated_at = NOW() WHERE id = $contact_id";
    $conn->query($update_contact_query);

    $insert_note_query = "INSERT INTO contact_notes (contact_id, note_content, created_at, updated_at) VALUES ($contact_id, '$note_content', NOW(), NOW())";
    $conn->query($insert_note_query);
}

$conn->close();
?>
