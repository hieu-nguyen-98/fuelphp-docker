<!-- app/views/layouts/user.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <?php echo Asset::css('bootstrap.css'); ?>
</head>
<body>
    <!-- User Header -->
    <header>
        <h1>Welcome, <?php echo $user_name; ?></h1>
        <nav>
            <ul>
                <li><a href="/user/profile">Profile</a></li>
                <li><a href="/user/settings">Settings</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- User Content -->
    <div id="content">
        <!-- The content will be injected here -->
        <?php echo $content; ?>
    </div>

    <!-- User Footer -->
    <footer>
        <p>&copy; 2024 My Website</p>
    </footer>
</body>
</html>
