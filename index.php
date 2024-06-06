<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get institution id from URL
$institution_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch institution details
$sql = "SELECT * FROM institutions WHERE id = $institution_id";
$result = $conn->query($sql);

// Check if institution exists
if ($result->num_rows > 0) {
    $institution = $result->fetch_assoc();
} else {
    echo "No institution found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Education Details</title>
    <style>
        .education-details {
            width: 60%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .education-details h2 {
            margin-top: 0;
        }
        .education-details p {
            margin: 10px 0;
        }
        .education-details a {
            color: blue;
            text-decoration: none;
        }
        .education-details a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="education-details">
        <h2><?php echo htmlspecialchars($institution['name']); ?></h2>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($institution['location']); ?></p>
        <p><strong>Established Year:</strong> <?php echo htmlspecialchars($institution['established_year']); ?></p>
        <p><strong>Website:</strong> <a href="<?php echo htmlspecialchars($institution['website']); ?>" target="_blank"><?php echo htmlspecialchars($institution['website']); ?></a></p>
        <p><strong>Description:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($institution['description'])); ?></p>
        <p><strong>Programs:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($institution['programs'])); ?></p>
    </div>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
