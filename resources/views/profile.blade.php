<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User profile</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles/dracula.css') }}">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <? php:
        if ( isset( $_COOKIE["username"] ) ) {
            header( 'Location:php/login.php' );
            exit;
        }
    ?>
</head>
<body>
    <div id="nav" class="nav">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{url('/')}}">Sorting</a>
                    </li>
                    <li class="nav-item dropdown" style="">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Algorithms
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ url('/algorithms/bubble_sort') }}">Bubble sort</a>
                            <a class="dropdown-item" href="{{ url('/algorithms/heap_sort') }}">Heap sort</a>
                            <a class="dropdown-item" href="{{ url('/algorithms/insertion_sort') }}">Insertion sort</a>
                            <a class="dropdown-item" href="{{ url('/algorithms/merge_sort') }}">Merge sort</a>
                            <a class="dropdown-item" href="{{ url('/algorithms/quick_sort') }}">Quick sort</a>
                            <a class="dropdown-item" href="{{ url('/algorithms/selection_sort') }}">Selection sort</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/classification')}}">Classification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{('/profile/test')}}">Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/profile')}}">Profile</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div style="align-content: center; width: 860px; height: 640px; padding-top: 100px; margin: auto">
        <h4 class="display-3" style="margin: auto; text-align: center; padding-bottom: 40px" >Have a test after login!</h4>
        <form class="px-4 py-3" method="get" style="padding-top: 100px">
            <div class="form-group" style="align-items: center; justify-content: center; display: flex">
                <input type="button" style="display: flex; margin-right: 20px" class="btn btn-primary" value="Come to login" onclick="window.location='{{url('/login')}}';" />
                <input type="button" style="display: flex" class="btn btn-primary" value="New user? Come to register" onclick="window.location='{{url('/register')}}';" />
            </div>
        </form>
    </div>

</body>
</html>