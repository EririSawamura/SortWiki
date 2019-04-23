<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login your account</title>
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
    <script src="{{ asset('/js/highlight.pack.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
        $(document).ready(function() {
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
    </script>
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
<div style="align-content: center; width: 640px; height: 480px; padding-top: 100px; margin: auto">
    <h4 class="display-2" style="margin: auto; text-align: center; padding-bottom: 40px" >Login</h4>
    <form class="px-4 py-3" action="{{url('/profile/login')}}" method="post" style="padding-top: 100px">
        {{csrf_field()}}
        <div class="form-group">
            <label for="usr">Username: </label>
            <input type="text" class="form-control" name="usr" id="usr" placeholder="username"  required>
            <small id="usrHelp" class="form-text text-muted">We'll never share your user name with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="pwd">Password: </label>
            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="password"  required>
        </div>
        <div class="form-group">
            <input type="submit" class="form-control" name="submit" value="submit" onclick="return validate()">
        </div>
        <div class="form-group" >
            <input type="reset" class="btn btn-primary" name="reset" value="reset" style="left: 0">
            <input type="button" class="btn btn-primary" value="Come back" onclick="window.location='{{url('/profile')}}'" />
        </div>
    </form>
</div>
</body>
</html>