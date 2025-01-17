<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is logged in and is an admin
$user_data = check_login($con);

if (!isset($user_data['is_admin']) || $user_data['is_admin'] != 1) {
    die("Access denied. Admins only.");
}

// Handle Add User
if (isset($_POST['add_user'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $query = "INSERT INTO users (user_id, user_name, password, is_admin) VALUES ('$user_id', '$user_name', '$password', '$is_admin')";
    mysqli_query($con, $query);
    header("Location: admin.php");
    exit();
}

// Handle Edit User
if (isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $query = "UPDATE users SET user_id='$user_id', user_name='$user_name', password='$password', is_admin='$is_admin' WHERE id='$id'";
    mysqli_query($con, $query);
    header("Location: admin.php");
    exit();
}

// Handle Delete User
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM users WHERE id='$id'";
    mysqli_query($con, $query);
    header("Location: admin.php");
    exit();
}

// Fetch all users
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #f4f4f9;
        }

        .actions a, .actions button {
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        .edit {
            background-color: #5cb85c;
        }

        .edit:hover {
            background-color: #4cae4c;
        }

        .delete {
            background-color: #d9534f;
        }

        .delete:hover {
            background-color: #c9302c;
        }

        .add-user {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #0275d8;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
        }

        .add-user:hover {
            background-color: #025aa5;
        }

        form {
            margin-top: 20px;
        }

        form input, form select, form button {
            padding: 10px;
            margin: 5px;
            width: calc(100% - 22px);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row input {
            width: 48%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>

        <!-- Add/Edit Form -->
        <form method="POST" action="admin.php">
            <input type="hidden" name="id" value="<?php echo isset($_GET['edit_id']) ? $_GET['edit_id'] : ''; ?>">
            <div class="form-row">
                <input type="text" name="user_id" placeholder="User ID" required value="<?php echo isset($_GET['edit_user_id']) ? $_GET['edit_user_id'] : ''; ?>">
                <input type="text" name="user_name" placeholder="Username" required value="<?php echo isset($_GET['edit_user_name']) ? $_GET['edit_user_name'] : ''; ?>">
            </div>
            <input type="password" name="password" placeholder="Password" required value="<?php echo isset($_GET['edit_password']) ? $_GET['edit_password'] : ''; ?>">
            <label>
                <input type="checkbox" name="is_admin" <?php echo isset($_GET['edit_is_admin']) && $_GET['edit_is_admin'] == 1 ? 'checked' : ''; ?>> Is Admin
            </label>
            <?php if (isset($_GET['edit_id'])): ?>
                <button type="submit" name="edit_user">Save Changes</button>
            <?php else: ?>
                <button type="submit" name="add_user">Add User</button>
            <?php endif; ?>
        </form>

        <!-- Users Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['is_admin'] == 1 ? 'Yes' : 'No'; ?></td>
                        <td class="actions">
                            <a href="admin.php?edit_id=<?php echo $row['id']; ?>&edit_user_id=<?php echo $row['user_id']; ?>&edit_user_name=<?php echo $row['user_name']; ?>&edit_password=<?php echo $row['password']; ?>&edit_is_admin=<?php echo $row['is_admin']; ?>" class="edit">Edit</a>
                            <a href="admin.php?delete_id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
