<?php
// Step 1: Include config.php file
include 'config.php';

// Step 2: Secure and only allow 'admin' users to access this page
if (!isset($_SESSION['loggedin']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect user to login page or display an error message
    $_SESSION['messages'][] = "You must be an administrator to access that resource.";
    header('Location: login.php');
    exit;
}

// Step 3: Prepare the SQL query template to select all users from the database
// ex. $stmt = $pdo->prepare('SQL GOES HERE...');
    $stmt = $pdo->prepare('SELECT * FROM `users` WHERE 1');

// Step 4: Execute the query
// ex. $stmt->execute();
    $stmt->execute();

// Step 5: Fetch and store the results in the $users associative array
// ex. $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Step 6: Check if the query returned any rows. If not, display the message: "There are no user records in the database."
// ex. if (!$users) {...}

// Check if there were rows returned (!$users) means if no users, then display session message, and return to admin_dashboard
if (!$users) {
    $_SESSION['messages'][] = "There are no user records in the database.";
    header('Location: admin_dashboard.php');
    exit; 
// by exiting, goes to html code below, which includes the type of user data that can be managed. 
    
}

?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Manage Users</h1>
    <!-- Add User Button -->
    <div class="buttons">
        <a href="user_add.php" class="button is-link">Add User</a>
    </div>
    <!-- User Table -->
    <table class="table is-bordered is-striped is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fetch Users from Database and Populate Table Rows Dynamically -->
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['full_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td>
                        <!-- Edit User Link -->
                        <a href="user_edit.php?id=<?= $user['id'] ?>" class="button is-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete User Form -->
                        <a href="user_delete.php?id=<?= $user['id'] ?>" class="button is-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>
