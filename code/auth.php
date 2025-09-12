

<?php
session_start();
require "config.php"; // include database connection

// REGISTER
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email    = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $cm_password = $_POST['cm_password'];
    if ($password !== password_hash($cm_password, PASSWORD_DEFAULT)) {
        $_SESSION['alert'] = [
            'status' => 'error',
            'message' => '❌ Passwords do not match.'
        ];
        header("Location: index.php");
        exit();
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql)) {
           $_SESSION['alert'] = [
        'status' => 'success',
        'message' => 'Your registration was successful now you can login.'
    ];        
    } 
    else {
        $_SESSION['alert'] = [
        'status' => 'error',
        'message' => 'Registration failed. Please try again.'
    ];
    }
    header("Location: index.php");
    exit();
}

// LOGIN
// LOGIN
if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            // Set a success alert for login
            $_SESSION['alert'] = [
                'status' => 'success',
                'message' => 'Login successful. Welcome back!'
            ];
        } else {
            // Set an error alert for wrong password
            $_SESSION['alert'] = [
                'status' => 'error',
                'message' => '❌ Wrong password.'
            ];
        }
    } else {
        // Set an error alert for user not found
        $_SESSION['alert'] = [
            'status' => 'error',
            'message' => '❌ User not found.'
        ];
    }
    // Always redirect to the index page after processing
    header("Location: index.php");
    exit();
}
?>
