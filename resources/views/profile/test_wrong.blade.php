<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Learn from mistakes</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/css/styles/darcula.css')}}">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet" type="text/css">

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
    <script src="{{asset('/js/main.js')}}"></script>
    <script src="{{asset('/js/highlight.pack.js')}}"></script>
    <script>
        hljs.initHighlightingOnLoad();
        $(document).ready(function () {
            $('pre code').each(function (i, block) {
                hljs.highlightBlock(block);
            });
        });

        function send() {

        }
    </script>
    @if(session()->has('alert'))
        <script>
            alert('{{ session()->get('alert') }}');
        </script>
    @endif
</head>

<body>
<!-- header -->
<div id="nav" style="font-size: 24px">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <a class="navbar-brand" href="{{url('/')}}" style="font-size: 16px">Sorting</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/profile/test')}}">Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/profile/profile')}}">Profile</a>
                </li>
            </ul>
        </div>
    </nav>
</div>


<div style="width: 960px; margin: auto">
    <?php
    if ($mode != 'AI' && (!isset($_GET['action']))) {
        echo "<h1 class=\"display-3\" style=\"text-align: center\">Mistakes appeared in your Tests</h1><br>";
        if ($mode == 'level1')
            echo "<p style=\"font-size: 20px\">Each question has 10 marks. Difficulty: ⭐</p><br>";
        else if ($mode == 'level2')
            echo "<p style=\"font-size: 20px\">Each question has 10 marks. Difficulty: ⭐⭐</p><br>";
        else if ($mode == 'all')
            echo "<p style=\"font-size: 20px\">Each question has 10 marks. Difficulty: ⭐⭐⭐</p><br>";
    } else if ($mode == 'AI' && (!isset($_GET['action']))) {
        echo "<h1 class=\"display-3\" style=\"text-align: center\">Special test for your weaknesses!</h1><br>";
        echo "<p style=\"font-size: 20px\">Each question has 10 marks. Difficulty: ⭐⭐⭐⭐⭐</p><br>";
    } else {
        echo "<h1 class=\"display-3\" style=\"text-align: center\">The answers to your last test!</h1><br>";
    }
    ?>

    <?php
    if (!isset($_GET['action']))
        echo "<p style=\"font-size: 30px\">Check the answer to each Single-choice question</p>";
    else
        echo "<p style=\"font-size: 30px\">You got $score scores in last test!</p>"
    ?>

    <div class="questions">
        <?php $count = 1;
        $index = 0; ?>
        <form action="{{url('/profile/oracle')}}" method="post">
            <input type="hidden" name="mode" id="mode" value="{{$mode}}">
            <input type="hidden" name="test" id="test" value="test3">
            {{csrf_field()}}
            <?php
                foreach ($result as $question) { ?>
                <?php echo '[' . $question->topic . ']' . $count . ". " . $question->content; ?><br>
                    <?php if ($mode != 'AI') {
                        echo '<strong>(Previously, you have done it incorrectly for ' . $question->count . ' times)</strong>';
                    }
                    ?><br>
                    <?php
                    $questionID = $question->qid;
                    $questionType = $question->type;
                    $q_branch1 = $question->A;
                    $q_branch2 = $question->B;
                    $q_branch3 = $question->C;
                    $q_branch4 = $question->D;
                    $q_branch5 = $question->E;
                    $q_branch6 = $question->F;
                    if ($questionType == 'SCQ') {
                        if ($q_branch1 != NULL)
                            echo "<input type='radio' value='A' name='SCQ_$questionID' required> a) $q_branch1 <br>";
                        if ($q_branch2 != NULL)
                            echo "<input type='radio' value='B' name='SCQ_$questionID' required> b) $q_branch2 <br>";
                        if ($q_branch3 != NULL)
                            echo "<input type='radio' value='C' name='SCQ_$questionID' required> c) $q_branch3 <br>";
                        if ($q_branch4 != NULL)
                            echo "<input type='radio' value='D' name='SCQ_$questionID' required> d) $q_branch4 <br>";
                        if ($q_branch5 != NULL)
                            echo "<input type='radio' value='E' name='SCQ_$questionID' required> e) $q_branch5 <br>";
                        if ($q_branch6 != NULL)
                            echo "<input type='radio' value='F' name='SCQ_$questionID' required> f) $q_branch6 <br>";
                    }
                    else if ($questionType == 'MCQ') {
                        $value_array = ['A', 'B', 'C', 'D', 'E', 'F'];
                        if ($q_branch1 != NULL && $q_branch2 != NULL && $q_branch3 != NULL && $q_branch4 != NULL
                            && $q_branch5 != NULL && $q_branch6 != NULL)
                        foreach($value_array as $value){
                            echo "<input type='checkbox' name='MCQ_".$questionID."[]' value='".$value."'><label>". $value . ") ". $question->$value. "</label><br>";
                        }
                        /*if ($q_branch1 != NULL)
                            echo "<input type='checkbox' value='A' name='' > a) $q_branch1 <br>";
                        if ($q_branch2 != NULL)
                            echo "<input type='checkbox' value='B' name='MCQ_$questionID' > b) $q_branch2 <br>";
                        if ($q_branch3 != NULL)
                            echo "<input type='checkbox' value='C' name='MCQ_$questionID' > c) $q_branch3 <br>";
                        if ($q_branch4 != NULL)
                            echo "<input type='checkbox' value='D' name='MCQ_$questionID' > d) $q_branch4 <br>";
                        if ($q_branch5 != NULL)
                            echo "<input type='checkbox' value='E' name='MCQ_$questionID'>  e) $q_branch5 <br>";
                        if ($q_branch6 != NULL)
                            echo "<input type='checkbox' value='F' name='MCQ_$questionID' > f) $q_branch6 <br>";*/
                    } else if ($questionType == 'BLANK') {
                        echo "<input type='text' name='BLANK_$questionID' required><br>";
                    } else {
                        echo "The question  type cannot be found.";
                    }
                    if ($flag1 == "done") {
                        echo "<p style='color: red; font-size: 18px'>$res[$index] The answer should be $answers[$index]!</p>";
                    }
                    $index++;
                    $count++;
                    }
                ?><br><br>

                <?php
                if ($flag1 != 'done')
                    echo "click on the \"Send Answer\" button to submit the information.<br><br>
                <input type=\"submit\" class=\"btn btn-primary\" value=\"Send answer\" onclick='send()'>
                <input type=\"reset\" class=\"btn btn-primary\" value=\"Clear answer\">"
                ?>
                <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                <input type="button" class="btn btn-primary" value="Back to previous page"
                       onclick="window.location='{{url('/profile/test')}}';"/>

        </form>
    </div>
</div>

</body>
</html>