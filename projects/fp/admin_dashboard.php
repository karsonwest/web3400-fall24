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

// sql queries to pull kpi data:
// KPI Queries
$kpiQueries = [
    'total_articles_count' => 'SELECT COUNT(*) AS total_articles_count FROM articles',
    'unpublished_articles_count' => 'SELECT COUNT(*) AS unpublished_articles_count FROM articles WHERE is_published = 0',
    'published_articles_count' => 'SELECT COUNT(*) AS published_articles_count FROM articles WHERE is_published = 1',
    'featured_articles_count' => 'SELECT COUNT(*) AS featured_articles_count FROM articles WHERE is_featured = 1',
    'total_user_interactions' => 'SELECT COUNT(*) FROM `user_interactions`',
    'average_likes_per_article' => 'SELECT ROUND(AVG(likes_count), 2) AS average_likes_per_article FROM articles',
    'average_favs_per_article' => 'SELECT ROUND(AVG(favs_count), 2) AS average_favs_per_article FROM articles',
    'average_comments_per_article' => 'SELECT ROUND(AVG(comments_count), 2) AS average_comments_per_article FROM articles',
    'total_tickets_count' => 'SELECT COUNT(*) AS total_tickets_count FROM tickets',
    'open_tickets_count' => 'SELECT COUNT(*) AS open_tickets_count FROM tickets WHERE status = "Open"',
    'in_progress_tickets_count' => 'SELECT COUNT(*) AS open_tickets_count FROM tickets WHERE status = "In Progress"',
    'closed_tickets_count' => 'SELECT COUNT(*) AS closed_tickets_count FROM tickets WHERE status = "Closed"',
    'total_user_count' => 'SELECT COUNT(*) AS user_count FROM users WHERE role = "user"',
    'most_active_user' => "SELECT CONCAT(u.full_name, ': ', COUNT(ui.id), ' interactions') AS user_interactions FROM users u JOIN user_interactions ui ON u.id = ui.user_id WHERE u.role = 'user' GROUP BY u.full_name ORDER BY COUNT(ui.id) DESC LIMIT 1",
];

$kpiResults = [];
foreach ($kpiQueries as $kpi => $query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $kpiResults[$kpi] = $stmt->fetchColumn();
}

$stmt = $pdo->prepare('SELECT * FROM contact_us ORDER BY submitted_at DESC LIMIT 5');
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Admin Dashboard</h1>
</section>
<!-- PKI column boxes -->

    <!-- Articles -->
<section class="section">
    <div class="columns is-multiline">


        <div class="column">
            <div class="box">
                <div class="heading"><a href="articles.php">Articles</a></div>
                <div class="title">Count: <?= $kpiResults["total_articles_count"] ?></div>
                <div class="level">
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Unublished</div>
                            <div class="title is-5"><?= $kpiResults["unpublished_articles_count"] ?></div>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Published</div>
                            <div class="title is-5"><?= $kpiResults["published_articles_count"] ?></div>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Featured</div>
                            <div class="title is-5"><?= $kpiResults["featured_articles_count"] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <!-- Tickets -->
        <div class="column">
            <div class="box">
                <div class="heading"><a href="tickets.php">Tickets</a></div>
                <div class="title">Count: <?= $kpiResults["total_tickets_count"] ?></div>
                <div class="level">
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Open</div>
                            <div class="title is-5"><?= $kpiResults["open_tickets_count"] ?></div>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="">
                            <div class="heading">In Progress</div>
                            <div class="title is-5"><?= $kpiResults["in_progress_tickets_count"] ?></div>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Closed</div>
                            <div class="title is-5"><?= $kpiResults["closed_tickets_count"] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- Users -->
        <div class="column">
            <div class="box">
                <div class="heading"><a href="users_manage.php">Users</a></div>
                <div class="title">Count: <?= $kpiResults["total_user_count"] ?></div>
                <div class="level">
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Most Active User</div>
                            <div class="title is-5"><?= $kpiResults["most_active_user"] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Interactions -->


        <div class="column">
            <div class="box">
                <div class="heading">Interactions</div>
                <div class="title">Count: <?= $kpiResults["total_user_interactions"] ?></div>
                <div class="level">
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Likes</div>
                            <div class="title is-5"><?= $kpiResults["average_likes_per_article"] ?></div>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="">
                            <div class="heading">FAVS</div>
                            <div class="title is-5"><?= $kpiResults["average_favs_per_article"] ?></div>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="">
                            <div class="heading">Comments</div>
                            <div class="title is-5"><?= $kpiResults["average_comments_per_article"] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- QUICK FORMS -->

<div class="columns">
    <div class="column is-6">
        <!-- Quick Article Add Form -->
        <div class="panel is-info">
         <p class="panel-heading"> Article - Quick Add </p>
         <div class="panel-block">
            <form action="article_add.php" method="post">
            <!-- Title -->
                 <div class="field">
                    <label class="label">Title</label>
                    <div class="control">
                        <input class="input" type="text" name="title" required>
                    </div>
                 </div>
            <!-- Content -->
                 <div class="field">
                    <label class="label">Content</label>
                    <div class="control">
                        <textarea class="textarea" id="content" name="content" required></textarea>
                    </div>
                 </div>
            <!-- Submit -->
                <div class="field is grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Add Post</button>
                    </div>
                    <div class="control">
                        <a href="articles.php" class="button is link is-light">Cancel</a>
                    </div>
                </div>
            </form>
         </div>
    </div>
    </div>
    <div class="column is-6">
        <!-- Quick Ticket Add Form -->
         <div class="panel is-primary">
            <p class="panel-heading">Ticket - Quick Add </p>
            <div class="panel-block">
                <form action="ticket_create.php" method="post">
                    <div class="field">
                        <label class="label">Title</label>
                        <div class="control">
                            <input class="input" type="text" name="title" placeholder="Ticket title" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Description</label>
                        <div class="control">
                            <textarea class="textarea" name="description" placeholder="Ticket description" required></textarea>
                        </div>
                    </div>
                   <div class="field">
                    <label class="label">Priority</label>
                        <div class="control">
                            <div class="select">
                                <select name="priority">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                </select>
                            </div>
                        </div>
                   </div>
                   <div class="field is-grouped">
                        <div class="control">
                            <button type="submit" class="button is-link">Create Ticket</button>
                        </div>
                        <div class="control">
                            <button type="submit" class="button is-link is-light">Cancel</button>
                        </div>
                   </div>
                   </div>
                </form>
            </div>
         </div>
    </div>

    <div class="column is-6">
        <!-- Quick Ticket Add Users -->
         <div class="panel">
            <p class="panel-heading">Users - Quick Add</p>
            <div class="panel-block">
                <form action="user_add.php" method="post">
                    <!-- Full Name -->
                    <div class="field">
                        <label class="label">Full Name</label>
                        <div class="control">
                            <input class="input" type="text" name="full_name" required>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="email" name="email" required>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control">
                            <input class="input" type="password" name="password" required>
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="field">
                        <label class="label">Phone</label>
                        <div class="control">
                            <input class="input" type="tel" name="phone" required>
                        </div>
                    </div>
                    <!-- Role -->
                    <div class="field">
                        <label class="label">Role</label>
                        <div class="control">
                            <div class="select">
                                <select name="role">
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="field">
                        <label class="label">Submit</label>
                        <div class="control">
                            <button type="submit" class="button is-link">Add User</button>
                        </div>
                        <div class="control">
                            <a href="users_manage.php" class="button is_link is-light">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
         </div>
    </div>
    <div class="column is-6">
    <div class="panel">
    <p class="panel-heading">Contact Us Messages</p>
    <div class="panel-block">
        <table class="table is-bordered is-striped is-hoverable is full-width">
            <!-- Table headers and rows for messages -->
             <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
            <!-- Fetch users from Database and Populate Table Rows Dynamically-->
             </thead>
             <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($message['name']); ?></td>
                            <td><?php echo htmlspecialchars($message['email']); ?></td>
                            <td><?php echo htmlspecialchars($message['message']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
    </div>
    </div>
    </div>
</div>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>