<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Classification of sorting algorithm</title>

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

    <section class="content-section bg-light" id="classification">
    <div align="center">
        <h2 class="display-5" align="center" id="cla">Classification of sorting algorithms: stability and complexity</h2>
        <p id="desc2" style="font-size: 20px">
            <b>Stability</b>: A sorting algorithm is said to be stable if two objects with equal keys appear in the
            same order in sorted output as they appear in the input array to be sorted.
        </p>
        <p id="desc3" style="font-size: 20px">
            <b>Complexity</b>: (Wikipedia)In computer science, the computational complexity, or simply complexity of
            an algorithm is the amount of resources required for running it. The computational complexity of a problem
            is the minimum of the complexities of all possible algorithms for this problem (including the unknown
            algorithms).
        </p>
        <table class="table" id="clatable">
            <thead class="thead-dark">
            <tr>
                <th scope="col" rowspan="2">Name</th>
                <th scope="col" rowspan="2">Stability</th>
                <th scope="col" colspan="3">Complexity</th>
            </tr>
            <tr>
                <th>Best case</th>
                <th>Average case</th>
                <th>Worst case</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Insertion Sort</td>
                <td>√</td>
                <td>O(n)</td>
                <td>O(n<sup>2</sup>)</td>
                <td>O(n<sup>2</sup>)</td>
            </tr>
            <tr>
                <td>Selection Sort</td>
                <td>×</td>
                <td>O(n<sup>2</sup>)</td>
                <td>O(n<sup>2</sup>)</td>
                <td>O(n<sup>2</sup>)</td>
            </tr>
            <tr>
                <td>Bubble Sort</td>
                <td>√</td>
                <td>O(n)</td>
                <td>O(n<sup>2</sup>)</td>
                <td>O(n<sup>2</sup>)</td>
            </tr>
            <tr>
                <td>Merge Sort</td>
                <td>√</td>
                <td>O(nlgn)</td>
                <td>O(nlgn)</td>
                <td>O(nlgn)</td>
            </tr>
            <tr>
                <td>Heap Sort</td>
                <td>×</td>
                <td>O(nlgn)(All keys distinct)</td>
                <td>O(nlgn)</td>
                <td>O(nlgn)</td>
            </tr>
            <tr>
                <td>Quick Sort</td>
                <td>Typical in-place sort is not stable; stable versions exist.</td>
                <td>O(nlgn)</td>
                <td>O(nlgn)</td>
                <td>O(n<sup>2</sup>)</td>
            </tr>
            </tbody>
        </table>
    </div>

    <br><br><br>
    <div align="center">
        <h2 align="center" id="cla1">Classification of sorting algorithms: </h2>
        <h2 align="center" id="cla2">External sorting algorithm and internal sorting algorithm</h2>
        <p id="desc1" style="font-size: 20px">
            <b>Internal sorting algorithm</b>: An internal sort is any data sorting process that takes place entirely
            within the main memory of a computer. This is possible whenever the data to be sorted is small enough to
            all be held in the main memory. For sorting larger data sets, it may be necessary to hold only a chunk of
            data in memory at a time, since it won’t all fit.
        </p>
        <p id="desc4" style="font-size: 20px">
            <b>External sorting algorithm</b>: External sorting is a class of sorting algorithms that can handle massive
            amounts of data. External sorting is required when the data being sorted do not fit into the main memory of
            a computing device (usually RAM) and instead they must reside in the slower external memory, usually a hard
            disk drive.
        </p>
        <table class="table" id="clatable1" style="width: 1000px">
            <thead class="thead-dark">
            <tr>
                <th scope="col" >Name</th>
                <th scope="col" >Type of sorting algorithm</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Insertion Sort</td>
                <td>Internal sorting algorithm</td>
            </tr>
            <tr>
                <td>Selection Sort</td>
                <td>Internal sorting algorithm</td>
            </tr>
            <tr>
                <td>Bubble Sort</td>
                <td>Internal sorting algorithm</td>
            </tr>
            <tr>
                <td>Merge Sort</td>
                <td>External sorting algorithm</td>
            </tr>
            <tr>
                <td>Heap Sort</td>
                <td>Internal sorting algorithm</td>
            </tr>
            <tr>
                <td>Quick Sort</td>
                <td>Internal sorting algorithm</td>
            </tr>
            </tbody>
        </table>
        </div>
</section>
</body>
</html>