<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Introduction of heap sort</title>

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
            document.getElementById("sort_animation").src="{{asset('/img/heap-sort.gif')}}"
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
        <h2>Introduction of heap sort</h2>
        <p id="desc4" align="center" style="width: 800px; font-size: 20px">
            "In computer science, Heap sort is a comparison based sorting technique
            based on Binary Heap data structure. It is similar to selection sort where
            we first find the maximum element and place the maximum element at the end.
            We repeat the same process for remaining element."</p>
        <iframe align="center" width="960" height="720" style="margin: auto"
                src="http://www.youtube.com/embed/MtQL_ll5KhQ" frameborder="0" allowfullscreen>
            Introduction to heap sort
        </iframe>
    </div>
</section>

<section class="content-section bg-light" id="animation">
    <div align="center">
        <h2 id="ani">Animation of sorting</h2>
        <p id="desc5" style="width: 700px; font-size: 20px">Initially, There are many strings which are arranged without
            order. When you click the 'heap sort' button, one of the strings will swap with each other
            until all strings are arranged in the ascending order. The arrow means the pointed string
            keeps moving to different places until it reaches the same position.</p>
        <button class="btn btn-primary" onclick="SortAnimation()">
            Heap Sort
        </button>
        <img id="sort_animation" src="{{asset('/img/origin.png')}}" alt="No photos here">
    </div>
</section>

<section class="content-section bg-light" id="sort_example">
    <div align="center">
        <h2 id="sorting_example">Code example of Heap sort</h2>
        <p id="desc1" style="font-size: 20px">In the heap sort algorithm, <br>
        1. Build a max heap from the input data. <br>
        2. At this point, the largest item is stored at the root of the heap. Replace it
        with the last item of the heap followed by reducing the size of heap by 1. Finally
        , heapify the root of tree. <br>
        3. Repeat above steps while size of heap is greater than 1.</p>
        <pre><code id="hljs-http5">
    #include&ltstdio.h&gt

    // To heapify a subtree rooted with node i which is
    // an index in arr[]. n is size of heap
    void swap(int *xp, int *yp)
    {
        int temp = *xp;
        *xp = *yp;
        *yp = temp;
    }

    void heapify(int arr[], int n, int i)
    {
        int largest = i; // Initialize largest as root
        int l = 2*i + 1; // left = 2*i + 1
        int r = 2*i + 2; // right = 2*i + 2

        // If left child is larger than root
        if (l < n && arr[l] > arr[largest])
            largest = l;

        // If right child is larger than largest so far
        if (r < n && arr[r] > arr[largest])
            largest = r;

        // If largest is not root
        if (largest != i)
        {
            swap(&arr[i], &arr[largest]);

            // Recursively heapify the affected sub-tree
            heapify(arr, n, largest);
        }
    }

    // main function to do heap sort
    void heapSort(int arr[], int n)
    {
        // Build heap (rearrange array)
        int i;
        for (i = n / 2 - 1; i >= 0; i--)
            heapify(arr, n, i);

        // One by one extract an element from heap
        for (i=n-1; i>=0; i--)
        {
            // Move current root to end
            swap(&arr[0], &arr[i]);

            // call max heapify on the reduced heap
            heapify(arr, i, 0);
        }
    }

    // The main function
    int main()
    {
        int arr[] = {5,4,3,2,1};
        int n = sizeof(arr)/sizeof(arr[0]);

        heapSort(arr, n);
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
