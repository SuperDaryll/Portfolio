<?php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Login
    if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];
        
        // Check credentials against the database
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password (assuming you hashed it when storing)
            if (password_verify($password, $user['password'])) {
                echo "Login successful for: " . htmlspecialchars($email);
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
    }

    // Handle Signup
    if (isset($_POST['signupName']) && isset($_POST['signupEmail']) && isset($_POST['signupPassword'])) {
        $name = $_POST['signupName'];
        $email = $_POST['signupEmail'];
        $password = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT); // Hash the password

        // Insert user into the database
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            echo "Signup successful for: " . htmlspecialchars($name);
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Handle Game Selection
    if (isset($_POST['gameSelect'])) {
        $selectedGame = $_POST['gameSelect'];
        echo "You have selected: " . htmlspecialchars($selectedGame);
    }
}

// Close the connection
$conn->close();
?>