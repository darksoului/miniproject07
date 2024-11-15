<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "password_manager"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete Record
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM passwords WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        header("Location: display_data.php"); // Redirect to the display page after deletion
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

// Update Record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $website = $_POST["website"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "UPDATE passwords SET website = ?, username = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $website, $username, $password, $update_id);

    if ($stmt->execute()) {
        header("Location: display_data.php"); // Redirect to the display page after update
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

$sql = "SELECT * FROM passwords";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* CSS styles for enhanced UI */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p {
            text-align: center;
            color: #555;
        }

        form {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
    <title>Display and Manage Passwords</title>
</head>
<body>
    <h1>Stored Passwords</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Website</th>
                <th>Username</th>
                <th>Password</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['website']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><a href="display_data.php?edit_id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="display_data.php?delete_id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No passwords found.</p>
    <?php endif; ?>

    <?php if (isset($_GET['edit_id'])): ?>
        <?php
        $edit_id = $_GET['edit_id'];
        $sql = "SELECT * FROM passwords WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $edit_result = $stmt->get_result();
        $edit_row = $edit_result->fetch_assoc();
        ?>

        <form method="post" action="display_data.php">
            <h2>Edit Password</h2>
            <input type="hidden" name="update_id" value="<?php echo $edit_id; ?>">
            <label for="website">Website:</label>
            <input type="text" id="website" name="website" value="<?php echo $edit_row['website']; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $edit_row['username']; ?>">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="<?php echo $edit_row['password']; ?>">
            <button type="submit">Update Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
