<!-- app/views/layouts/admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php echo Asset::css('bootstrap.css'); ?>

</head>
<body>
    <!-- Admin Header -->
    <header>
        <h1>Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="/admin/dashboard">Dashboard</a></li>
                <li><a href="/admin/users">Manage Users</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Admin Content -->
    <div id="content">
  
        <?php echo $content; ?>
    </div>

    <!-- Admin Footer -->
    <footer>
        <p>&copy; 2024 My Website</p>
    </footer>
</body>
</html>
