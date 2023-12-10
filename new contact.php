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

    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO contacts (title, first_name, last_name, email, telephone, company, type, assigned_to, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $first_name);
        $stmt->bindParam(3, $last_name);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $telephone);
        $stmt->bindParam(6, $company);
        $stmt->bindParam(7, $type);
        $stmt->bindParam(8, $assigned_to);

        $stmt->execute();

        echo "<span class='resMsg'>Contact created successfully!</span><br>";
    } catch (PDOException $e) {
        echo "Error creating contact: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} elseif ($_GET["load"] === "options") {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT user_id, username FROM users");
        $stmt->execute();

        $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($options as $option) {
            echo "<option value='{$option['user_id']}'>{$option['username']}</option>";
        }
    } catch (PDOException $e) {
        echo "Error loading options: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
