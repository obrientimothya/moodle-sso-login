<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <meta name="description" content="Login Page">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <form class="form-signin" method="POST" action="authenticate.php">
            <h2 class="form-signin-heading">Log In</h2>
            <div id="messages"></div>
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="username" required="" autofocus="" autocomplete="off">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="password" required="" autocomplete="off">

            <button class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>
        </form>
    </div>

    <script src="js/app.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>