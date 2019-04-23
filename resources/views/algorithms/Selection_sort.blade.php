<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Introduction of selection sort</title>

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

        function SortAnimation() {
            document.getElementById("sort_animation").src="{{asset('/img/selection-sort.gif')}}"
        }
    </script>

</head>

<body id="page-top">
<div id="nav" class="nav">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{('/')}}">Sorting</a>
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
                    <a class="nav-link" href="#introduction">Introduction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#animation">Animation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sort_example">CodeExample</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{('/classification')}}">Classification</a>
                </li>
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

<section class="content-section bg-light" id="introduction">
    <div align="center" style="width: 960px; margin: auto" >
        <h2>Introduction of selection sort</h2>
        <p id="desc4" align="center" style="width: 750px; font-size: 20px">
        "In computer science,The selection sort algorithm sorts an array by repeatedly finding
        the minimum element (considering ascending order) from unsorted part and putting it at
        the beginning. The algorithm maintains two subarrays in a given array.<br>
        1. The subarray which is already sorted.<br>
        2. Remaining subarray which is unsorted."</p>
        <iframe align="center" width="960" height="720" style="margin: auto"
                src="http://www.youtube.com/embed/xWBP4lzkoyM" frameborder="0" allowfullscreen>
            Introduction to selection sort
        </iframe>
    </div>
</section>

<section class="content-section bg-light" id="animation">
    <div align="center">
        <h2 id="ani">Animation of sorting</h2>
        <p id="desc5" style="width: 700px; font-size: 20px">Initially, There are many strings which are arranged without
            order. When you click the 'selection sort' button, one of the strings will swap with each other
            until all strings are arranged in the ascending order. The arrow means the pointed string
            keeps moving to different places until it reaches the same position.</p>
        <button class="btn btn-primary" onclick="SortAnimation()">
            Selection Sort
        </button>
        <img id="sort_animation" src="{{asset('/img/origin.png')}}" alt="No photos here">
    </div>
</section>

<section class="content-section bg-light" id="sort_example">
    <div align="center">
        <h2 id="sorting_example">Code example of selection sort</h2>
        <p id="desc1" style="font-size: 20px">The algorithm divides the input list into two parts: the sublist of items already
        sorted, which is built up from left to right at the front (left) of the list, and the sublist of
        items remaining to be sorted that occupy the rest of the list. <br>
        1. Initially, the sorted sublist is empty and the unsorted sublist is the entire input list.
        2. The algorithm proceeds by finding the smallest (or largest, depending on sorting order) element
        in the unsorted sublist. <br>
        3. Exchange (swapping) it with the leftmost unsorted element (putting it in sorted order), and
        moving the sublist boundaries one element to the right.</p>
        <pre><code id="hljs-http2">
    #include &ltstdio.h&gt

    void swap(int *xp, int *yp)
    {
        int temp = *xp;
        *xp = *yp;
        *yp = temp;
    }

    //The sorting function
    void selectionSort(int arr[], int n)
    {
        int i, j, min_idx;

        // One by one move boundary of unsorted subarray
        for (i = 0; i < n-1; i++)
        {
            // Find the minimum element in unsorted array
            min_idx = i;
            for (j = i+1; j < n; j++)
              if (arr[j] < arr[min_idx])
                min_idx = j;

            // Swap the found minimum element with the first element
            swap(&arr[min_idx], &arr[i]);
        }
    }

    // The main function
    int main()
    {
        int arr[] = {5, 4, 3, 2, 1};
        int n = sizeof(arr)/sizeof(arr[0]);

        selectionSort(arr, n);
        return 0;
    }
            </code></pre>

    </div>
    <div style="width: 760px; margin: auto" align="left">
        <p style="font-size: 20px"><b>Note</b>: If you are: 1. similar with <b>C language</b>. 2. willing to try arbitrary
            numbers. 3. looking for step-by-step transitions of the numbers during the sorting process. Let's copy the
            code and click the button to have a try!&nbsp;&nbsp;<a type="button" class="btn btn-primary" target="_blank"
            href="https://www.onlinegdb.com/online_c_compiler">Online C compiler</a></p>
    </div>
    <div style="width: 760px; margin: auto; align-self: auto; padding-top: 20px" >
        <iframe src="https://tool.lu/coderunner/embed/6rq.html" width="650" height="550" frameborder="0" mozallowfullscreen webkitallowfullscreen allowfullscreen></iframe>
    </div>
</section>

</body>

</html>
