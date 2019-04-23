<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Introduction of merge sort</title>

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
            document.getElementById("sort_animation").src="{{asset('/img/merge-sort.gif')}}"
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
        <h2>Introduction of merge sort</h2>
        <p id="desc4" align="center" style="width: 750px; font-size: 20px">
            "In computer science, Like QuickSort, Merge Sort is a Divide and Conquer algorithm.
            It divides input array in two halves, calls itself for the two halves and then merges
            the two sorted halves."</p>
        <iframe align="center" width="960" height="720" style="margin: auto"
                src="http://www.youtube.com/embed/JSceec-wEyw" frameborder="0" allowfullscreen>
            Introduction to merge sort
        </iframe>
    </div>
</section>

<section class="content-section bg-light" id="animation">
    <div align="center">
        <h2 id="ani">Animation of sorting</h2>
        <p id="desc5" style="width: 700px; font-size: 20px">Initially, There are many strings which are arranged without
            order. When you click the 'merge sort' button, one of the strings will swap with each other
            until all strings are arranged in the ascending order. The arrow means the pointed string
            keeps moving to different places until it reaches the same position.</p>
        <button class="btn btn-primary" onclick="SortAnimation()">
            Merge Sort
        </button>
        <img id="sort_animation" src="{{asset('/img/origin.png')}}" alt="No photos here">
    </div>
</section>

<section class="content-section bg-light" id="sort_example">
    <div align="center">
        <h2 id="sorting_example">Code example of merge sort</h2>
        <p id="desc1" style="font-size: 20px">Conceptually, a merge sort works as follows: <br>
        1. Divide the unsorted list into n sublists, each containing one element (a list of one
        element is considered sorted). <br>
        2. Repeatedly merge sublists to produce new sorted sublists until there is only one sublist remaining. This
        will be the sorted list.</p>
        <pre><code id="hljs-http4">
    #include&ltstdlib.h&gt
    #include&ltstdio.h&gt

    // Merges two subarrays of arr[].
    // First subarray is arr[l..m]
    // Second subarray is arr[m+1..r]
    void merge(int arr[], int l, int m, int r)
    {
        int i, j, k;
        int n1 = m - l + 1;
        int n2 = r - m;

        /* create temp arrays */
        int L[n1], R[n2];

        /* Copy data to temp arrays L[] and R[] */
        for (i = 0; i < n1; i++)
            L[i] = arr[l + i];
        for (j = 0; j < n2; j++)
            R[j] = arr[m + 1+ j];

        /* Merge the temp arrays back into arr[l..r]*/
        i = 0; // Initial index of first subarray
        j = 0; // Initial index of second subarray
        k = l; // Initial index of merged subarray
        while (i < n1 && j < n2)
        {
            if (L[i] <= R[j])
            {
                arr[k] = L[i];
                i++;
            }
            else
            {
                arr[k] = R[j];
                j++;
            }
            k++;
        }

        /* Copy the remaining elements of L[], if there
        are any */
        while (i < n1)
        {
            arr[k] = L[i];
            i++;
            k++;
        }

        /* Copy the remaining elements of R[], if there
        are any */
        while (j < n2)
        {
            arr[k] = R[j];
            j++;
            k++;
        }
    }

    /* l is for left index and r is right index of the
    sub-array of arr to be sorted */
    void mergeSort(int arr[], int l, int r)
    {
        if (l < r)
        {
            // Same as (l+r)/2, but avoids overflow for
            // large l and h
            int m = l+(r-l)/2;

            // Sort first and second halves
            mergeSort(arr, l, m);
            mergeSort(arr, m+1, r);

            merge(arr, l, m, r);
        }
    }

    //The main function
    int main()
    {
        int arr[] = {5, 4, 3, 2, 1};
        int arr_size = sizeof(arr)/sizeof(arr[0]);

        mergeSort(arr, 0, arr_size - 1);
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
