<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "internet_programming";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $remarks = $_POST['remarks'];

    // Display the collected data
    echo "<h2>Your Input:</h2>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Country: " . $country . "<br>";
    echo "Remarks: " . $remarks . "<br>";
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO project (name, email, country, remarks) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $country, $remarks);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    // Redirect after 5 seconds
    header("refresh:5;url=index.html" . $_SERVER['HTTP_REFERER']);
    exit();
}
?>