<?php
$host = "localhost";
$dbname = "myapp";
$username = "app_user";   // ⚠️ Do NOT use root in production
$password = "strong_password_here";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Trim inputs
    $user = trim($_POST["username"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $pass = $_POST["password"] ?? '';

    // ✅ Basic Validation
    if (empty($user) || empty($email) || empty($pass)) {
        die("All fields are required.");
    }

    // ✅ Validate Email Format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // ✅ Enforce Strong Password
    if (strlen($pass) < 8) {
        die("Password must be at least 8 characters long.");
    }

    // Optional: Require numbers & letters
    if (!preg_match("/[A-Za-z]/", $pass) || !preg_match("/[0-9]/", $pass)) {
        die("Password must contain both letters and numbers.");
    }

    // 🔐 Hash Password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // Check if email already exists
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            die("Email already registered.");
        }

        // Insert user
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$user, $email, $hashed_password])) {
            echo "Registration successful!";
        } else {
            echo "Error registering user.";
        }

    } catch(PDOException $e) {
        echo "Something went wrong. Please try again later.";
    }
}
?>
