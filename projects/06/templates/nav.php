
    <!--BEGIN PAGE HEADER-->
    <header class="container">

        <!--BEGIN MAIN NAV-->
        <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-yin-yang fa-lg"></i>
                        </span>
                        <span>&nbsp;<?= $siteName ?></span>
                    </span>
                </a>
                <a class="navbar-burger" role="button" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="#">Home</a>
                    <a class="navbar-item" href="#">About</a>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a href="contact.php" class="button is-light">Contact Us</a>
                            <!-- BEGIN USER MENU -->
   <?php if (isset($_SESSION['loggedin'])) : ?>
      <div class="navbar-item has-dropdown is-hoverable">
         <a class="button navbar-link">
            <span class="icon">
               <i class="fas fa-user"></i>
            </span>
         </a>
         <div class="navbar-dropdown">
            <a href="profile.php" class="navbar-item">Profile</a>
            <hr class="navbar-divider">
            <a href="logout.php" class="navbar-item">Logout</a>
         </div>
      </div>
   <?php else : ?>
      <a href="login.php" class="button is-link">Login</a>
   <?php endif; ?>
<!-- END USER MENU -->
<!-- BEGIN ADMIN MENU -->
<?php if (isset($_SESSION['loggedin']) && $_SESSION['user_role'] == 'admin') : ?>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
            <span class="icon">
                <i class="fas fa-user-cog"></i>
            </span>
            <span>Admin</span>
        </a>
        <div class="navbar-dropdown">
            <a href="users_manage.php" class="navbar-item">
                Manage Users
            </a>
            <a href="articles.php" class="navbar-item">
                Manage Articles
            </a>
        </div>
    </div>
<?php endif; ?>
<!-- END ADMIN MENU -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!--END MAIN NAV-->
        <section><!--ONLY FOR SPACING PURPOSES --></section>
        <?php if ($_SERVER['PHP_SELF'] == '/index.php') : ?>
  <!-- BEGIN HERO -->
  <section class="hero is-info">
    <div class="hero-body">
      <p class="title">
        Do you want to bring peace and order to the Galaxy?
      </p>
      <p class="subtitle">
        The Empire has the resources to accomplish this goal
      </p>
      <a href="contact.php" class="button is-medium is-info is-light is-rounded">
        <span class="icon is-large">
          <i class="fab fa-2x fa-pagelines"></i>
        </span>
        <span>Enlist in the Empire today</span>
      </a>
    </div>
  </section>
  <!-- END HERO -->
<?php endif; ?>

        <!--START USER MESSAGE -->
        <?php if (!empty($_SESSION['messages'])) : ?>
            <section class="notification is-warning">
                <button class="delete"></button>
                <?php echo implode('<br>', $_SESSION['messages']);
                $_SESSION['messages'] = []; // Clear the user responses?>
            </section>
        <?php endif; ?>
        <!--END USER MESSAGE -->

    </header>
    <!--END PAGE HEADER-->

    <!--BEGIN MAIN PAGE CONTENT-->
    <main class="container">