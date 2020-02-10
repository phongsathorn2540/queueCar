
<?php
include('inc/db.php');
if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['user_pass'] ) ) {
        $user_pass = $_POST['user_pass'];
        $sql = "SELECT user_name , user_pass FROM member where user_name = '$user_pass'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            echo $row['user_pass'];
        }
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
</head>
<body>
    <form method="POST">
        Username : <input type="text" name="username">
        Password : <input type="text" name="user_pass">
    <input type="submit" value="Login">
</form>
</body>
</html>
