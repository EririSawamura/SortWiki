<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Test1</title>

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
      
      function validate() {
        for (let j=1; j<=6; j++){
          let input = document.getElementsByName("q"+j);
          let check = false;
          let i;
          for (i=0; i<input.length; i++){
            if (input[i].checked) check = true;
          }
          if (check === false){
            alert("You have not fulfilled the question "+j+"!");
            return false;
          }
        }

        for (i=7; i<=7; i++){
            if (!document.getElementById("q"+i+"a").checked)
            if (!document.getElementById("q"+i+"b").checked)
            if (!document.getElementById("q"+i+"c").checked)
            if (!document.getElementById("q"+i+"d").checked)
            if (!document.getElementById("q"+i+"e").checked)
            if (!document.getElementById("q"+i+"f").checked) {
                alert("You have not fulfilled the question "+i+"!");
                return false;
            }
        }
        return true;
      }
    </script>
</head>
<body>
    <div id="test1_nav" style="font-size: 24px">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <a class="navbar-brand" href="{{url('/')}}" style="font-size: 16px">Sorting</a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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

    <form method="post" action="{{url('/profile/oracle')}}" >
        {{csrf_field()}}
    <div style="width: 960px; margin: auto">
        <h1 class="display-3" style="text-align: center">Test1 for sorting algorithm</h1><br>
        <p style="font-size: 20px">Each question has 10 marks. Difficulty: ⭐</p>
        <!-- SCQ question-->
        <p style="font-size: 30px">Check the answer to each Single-choice question</p>

        <p>1. What is an external sorting algorithm?<br>
            <input type="radio" name="q1" id="q1a" value="q1a">a) Algorithm that uses tape or disk during the sort<br>
            <input type="radio" name="q1" id="q1b" value="q1b">b) Algorithm that uses main memory during the sort<br>
            <input type="radio" name="q1" id="q1c" value="q1c">c) Algorithm that involves swapping<br>
            <input type="radio" name="q1" id="q1d" value="q1d">d) Algorithm that are considered 'in place'<br>
        </p>


        <p>2. What is an internal sorting algorithm?<br>
            <input type="radio" name="q2" id="q2a" value="q2a">a) Algorithm that uses tape or disk during the sort<br>
            <input type="radio" name="q2" id="q2b" value="q2b">b) Algorithm that uses main memory during the sort<br>
            <input type="radio" name="q2" id="q2c" value="q2c">c) Algorithm that involves swapping<br>
            <input type="radio" name="q2" id="q2d" value="q2d">d) Algorithm that are considered 'in place'<br>
        </p>

        <p>3. Which one is an external sorting algorithm?<br>
            <input type="radio" name="q3" id="q3a" value="q3a">a) Insertion sort<br>
            <input type="radio" name="q3" id="q3b" value="q3b">b) Selection sort<br>
            <input type="radio" name="q3" id="q3c" value="q3c">c) Bubble sort<br>
            <input type="radio" name="q3" id="q3d" value="q3d">d) Merge sort<br>
        </p>

        Check the answer to each True or false question.

        <p>4. Insertion sort is an internal sorting algorithm.<br>
            <input type="radio" name="q4" id="q4t" value="q4t">True<br>
            <input type="radio" name="q4" id="q4f" value="q4f">False<br>
        </p>

        <p>5. Selection sort is an internal sorting algorithm.<br>
            <input type="radio" name="q5" id="q5t" value="q5t">True<br>
            <input type="radio" name="q5" id="q5f" value="q5f">False<br>
        </p>

        <p>6. Heap sort is an internal sorting algorithm.<br>
            <input type="radio" name="q6" id="q6t" value="q6t">True<br>
            <input type="radio" name="q6" id="q6f" value="q6f">False<br>
        </p>

        check the answer to each MCQ question

        <!-- MCQ questions-->
        <p>7. Which sorting algorithms are internal sorting algorithms?<BR>
            <input type="checkbox" name="q7a" id="q7a" value="1">a) Insertion sort<br>
            <input type="checkbox" name="q7b" id="q7b" value="1">b) Selection sort<br>
            <input type="checkbox" name="q7c" id="q7c" value="1">c) Bubble sort<br>
            <input type="checkbox" name="q7d" id="q7d" value="1">d) Heap sort<br>
            <input type="checkbox" name="q7e" id="q7e" value="0">e) Merge sort<br>
            <input type="checkbox" name="q7f" id="q7f" value="1">f) Quick sort<br>
        </p>
        <br>
        click on the "Send Form" button to submit the information.<br><br>
        <input type="hidden" name="test" id="test" value="test1">
        <input type="submit" class="btn btn-primary" value="Send answer" onclick="return validate()">
        <input type="reset" class="btn btn-primary" value="Clear answer">
        <input type="button" class="btn btn-primary" value="Back to main page" onclick="window.location='{{url('/')}}';" />
    </div>
    </form>
</body>
</html>