<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BTOnline Login</title>
    <meta name="description" content="Bendigo TAFE BTOnline Login Page">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

<div class="logo-wrapper">
    <div class="container logo-container">
        <a href="index.html">
            <img src="images/logo.png" alt="logo" style="height: 100%" />
        </a>
    </div>
</div>


<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">BTOnline</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.html">Login</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container content-container">
    <div class="row">
        <div class="col-md-8">
            <h3>Welcome to BTOnline <small>Bendigo TAFE's Student Learning Management System</small></h3>
            <p>
                Online learning has many benefits. Learning is self-paced and self-directed, giving you the opportunity to learn at your own pace at times that suit you. You can access the learning from any computer with an internet connection. It helps put you in control of your learning.
            </p>
            <p>
                Bendigo TAFE offers some components of certain courses online, usually in conjunction with class work and practical activities held either on campus or in the workplace. We use BTOnline, a well-supported platform used by many education institutions around the world.
            </p>
            <p>
                Your course facilitator will provide you with details on how to access BTOnline. If you already have your username and password, you may enter these in the form on this page. All login details expire at the end of the year and a new password is required if you continue from one year to the next.
            </p>
            <p>
                To learn more about BTOnline please review the <a href="http://btonline.bendigotafe.edu.au/pluginfile.php/2/course/section/1/BTOnline%20Student%20Access%20Manual.pdf">BTOnline Access Manual</a> 598Kb. The manual contains important information about how to access and use BTOnline as well as how to check your computer settings to ensure it works effectively. You should check the manual before asking for help.
            </p>
            <p>
                If you are still having problems or require further information please email <a href="mailto:btonline@bendigotafe.edu.au">btonline@bendigotafe.edu.au</a>
            </p>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user"></i> Login</h3>
                </div>
                <div class="panel-body">
                    <div id="messages"></div>
                    <form method="POST" action="authenticate.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<footer>
    <div class="container">
        &copy 2015 <a href="http://www.bendigotafe.edu.au">Bendigo TAFE</a>
    </div>
</footer>

<script src="js/app.js"></script>

</body>

</html>