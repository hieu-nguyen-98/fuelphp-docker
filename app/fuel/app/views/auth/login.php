<h2>Login</h2>
<?php if (Session::get_flash('error')): ?>
    <p style="color:red;"><?php echo Session::get_flash('error'); ?></p>
<?php endif; ?>

<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Login</button>
</form>
