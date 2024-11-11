<?php
// Include config.php file

// Secure and only allow 'admin' users to access this page

// Check if the $_GET['id'] exists; if it does, get the ticket record from the database and store it in the associative array $ticket. If a ticket with that ID does not exist, display the message "A ticket with that ID did not exist."

// Check if $_GET['confirm'] == 'yes'. This means they clicked the 'yes' button to confirm the removal of the record.
// If yes, prepare and execute an SQL DELETE statement to remove the ticket where id == the $_GET['id'].
// Also, delete all comments associated with that ticket.
// Else (meaning they clicked 'no'), return them to the tickets.php page.
?>

<?php include 'templates/head.php'; ?>
<?php include 'templates/nav.php'; ?>

<!-- BEGIN YOUR CONTENT -->
<section class="section">
    <h1 class="title">Delete Ticket</h1>
    <p class="subtitle">Are you sure you want to delete ticket: <?= htmlspecialchars_decode($ticket['title']) ?></p>
    <div class="buttons">
        <a href="?id=<?= $ticket['id'] ?>&confirm=yes" class="button is-success">Yes</a>
        <a href="tickets.php" class="button is-danger">No</a>
    </div>
</section>
<!-- END YOUR CONTENT -->

<?php include 'templates/footer.php'; ?>