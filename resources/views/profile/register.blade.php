<?php
    /*if(empty($_POST)){
        exit("Your form is empty");
    }

    $password = $_POST['pwd'];
    $userName = $_POST['usr'];

    $userNameSQL = "select * from users where userName = '$userName'";
    getConnect();
    $resultSet = mysql_query($userNameSQL);
    $result_string = "";
    if (mysql_num_rows($resultSet) > 0) {
        $result_string = 'The username is used. Please select another username!';
    } else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $registerSQL = "insert into users (userName, password) values('$userName', '$hash')";
        mysql_query($registerSQL);
        $userSQL = "select userName from users where userName = '$userName'";
        $userResult = mysql_query($userSQL);
        $auser = mysql_fetch_array($userResult);
        if ($userName == $auser[0]) {
            $result_string = 'Register Success!';
        } else {
            $result_string = 'Register failure!';
        }
    }
    closeConnect();*/
?>
<html lang="en">
<head>
    <title>Register result</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles/dracula.css') }}">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</head>
<body>
<div id="nav" style="font-size: 24px">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <a class="navbar-brand" href="{{('/')}}" style="font-size: 16px">Sorting</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{('/profile/test')}}">Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{('/profile')}}">Profile</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div style="align-content: center; width: 640px; height: 480px; padding-top: 100px; margin: auto">
    <h4 class="display-5" style="margin: auto; text-align: center; padding-bottom: 40px" >{{$result_string}}</h4>
    <div style="justify-content: center; align-items: center; display: flex">
        <input type="button" style="margin-right: 20px;  display: flex" class="btn btn-primary" value="Register again" onclick="window.location='{{url("/register")}}';" />
        <input type="button" style="display: flex;" class="btn btn-primary" value="Go to login" onclick="window.location='{{url("/login")}}';" />
    </div>
</div>

</body>
</html>
