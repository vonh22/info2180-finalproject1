<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST["title"]);
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $company = htmlspecialchars($_POST["company"]);
    $type = htmlspecialchars($_POST["type"]);
    $assigned_to = intval($_POST["assigned_to"]); 

     
    $conn = new mysqli("localhost", "root", "password123", "MySQL");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO contacts (title, first_name, last_name, email, telephone, company, type, assigned_to, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("ssssssis", $title, $first_name, $last_name, $email, $telephone, $company, $type, $assigned_to);

    if ($stmt->execute()) {
        
        echo "Contact created successfully!";
    } else {
        
        echo "Error creating contact: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
