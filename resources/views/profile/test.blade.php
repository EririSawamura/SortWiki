<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Test of sorting algorithm</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles/dracula.css') }}">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/main.js') }}"></script>

    @if(session()->has('alert'))
        <script>
            alert('{{ session()->get('alert') }}');
        </script>
    @endif
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

<div style="align-content: center; width: 700px; height: 480px; padding-top: 100px; margin: auto">
    <h4 class="display-4" style="margin: auto; text-align: center; padding-bottom: 40px" >
        {{ $username }}, come to have a test!
    </h4>
    <h5 class="display-5" style="margin: auto; text-align: center; padding-bottom: 20px">
        Your learning progress: {{ $result_string }}
    </h5>
    <h5 class="display-5" style="margin: auto; text-align: center; padding-bottom: 20px">
        Your test1 grade: {{ $learn_grade1 }}
    </h5>
    <h5 class="display-5" style="margin: auto; text-align: center; padding-bottom: 20px">
        Your test2 grade: {{ $learn_grade2 }}
    </h5>
    <h5 class="display-5" style="margin: auto; text-align: center; padding-bottom: 20px">
        Your total grade: {{ $learn_grade1 + $learn_grade2 }}
    </h5>
    <form class="px-4 py-3" method="post" style="padding-top: 80px">
        <div class="form-group" style="align-items: center; justify-content:center; display: flex">
            <p style="font-size: 40px; text-align: center; padding-right: 20px">Test: </p>
            <input type="button" class="btn btn-primary" style="margin-right: 20px" id="test1" name="test1" value="Test1" onclick="window.location='{{url('/test/1')}}';">
            <input type="button" class="btn btn-primary" id="test2" name="test2" value="Test2" onclick="window.location='{{url('/test/2')}}';">
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $("#review_mistakes").hover(function () {
                $("#sliding_list").show(300);
            });
            $("#sliding_list").mouseleave(function () {
                $("#sliding_list").hide(300);
            });
        });

    </script>

    <form class="px-4 py-3" action="{{url('/profile/test_wrong')}}" method="get" style="padding-top: 0; ">
        {{csrf_field()}}
        <div class="form-group" style="align-items: center; justify-content:center; ">
            <p style="font-size: 24px; text-align: center; padding-right: 20px">Review your mistakes & Join customized
                test!</p>
            <input type="button" class="btn btn-primary" id="test3" name="test3" value="Customized Test"
                   style="margin-left: 180px" onclick="window.location='{{url('/profile/test_wrong/test3')}}';">
            <input type="button" class="btn btn-primary" id="review_mistakes" name="review_mistakes"
                   value="Review Mistakes">


            <ul id='sliding_list' style=" list-style-type: none;
                margin: 0;
                width: 150px;
                padding-left: 325px;
                display: none;">
                <li><input type="button" id="review_T1" name="review_T1" value="Review Mistakes of T1"
                   class="btn btn-primary" style="display: flow;margin-top: 1px" onclick="window.location='{{url('/profile/test_wrong/review_T1')}}';">
                </li>
                <li><input type="button" id="review_T2" name="review_T2" value="Review Mistakes of T2"
                   class="btn btn-primary" style="display: flow;margin-top: 1px" onclick="window.location='{{url('/profile/test_wrong/review_T2')}}';">
                </li>
                <li><input type="button" id="review_All" name="review_All" value="Review All Mistakes"
                   class="btn btn-primary" style="display:flow;margin-top: 1px" onclick="window.location='{{url('/profile/test_wrong/review_All')}}';">
                </li>
            </ul>
        </div>
    </form>

    <form class="px-4 py-3" method="post" style="padding-top: 80px">
        <div class="form-group" style="align-items: center; justify-content:center; display: flex">
            <p style="font-size: 40px; text-align: center; padding-right: 20px">No test now?</p>
            <input type="button" style="margin-left:20px; display: flex" class="btn btn-danger" value="Back to main page" onclick="window.location='{{url('/')}}';" />
        </div>
    </form>
</div>

</body>
</html>
