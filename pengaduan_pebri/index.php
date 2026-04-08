<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <form action="proses_login.php" method="POST">
        <input type="text" name="username" placeholder="Masukkan Username / NIS" required>
        <input type="password" name="password" placeholder="Password (kosongkan jika siswa)">
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>