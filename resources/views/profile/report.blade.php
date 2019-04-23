<html lang="en">
<head>
    <title>Report</title>
    <script type="text/javascript" src="{{asset('js/loader.js')}}"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.setOnLoadCallback (createChart);
        function createChart() {

            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string','Learning progress');
            dataTable.addColumn('number', 'Number of users');
            dataTable.addRows([['Not finish any test',{{$progress[0]}}],
                ['Have finished test1',{{$progress[1]}}], ['Finished all tests', {{$progress[2]}}]]);
            var chart = new google.visualization.ColumnChart(document.getElementById('Learnchart'));
            var options = {chartArea: {width: '50%'}, title: 'Learning progress of users'};
            chart.draw(dataTable, options);

            var dataTable1 = new google.visualization.DataTable();
            dataTable1.addColumn('string','Grade of test1');
            dataTable1.addColumn('number', 'Number of users');
            dataTable1.addRows([['0-19', {{$grade1[0]}}], ['20-39',{{$grade1[1]}}],
                ['40-59', {{$grade1[2]}}], ['60-70', {{$grade1[3]}}],
            ]);
            var chart1 = new google.visualization.ColumnChart(document.getElementById('Grade1chart'));
            options = {chartArea: {width: '50%'}, title: 'Grade of test1'};
            chart1.draw(dataTable1, options);

            var dataTable2 = new google.visualization.DataTable();
            dataTable2.addColumn('string','Grade of test2');
            dataTable2.addColumn('number', 'Number of users');
            dataTable2.addRows([['0-10', {{$grade2[0]}}], ['20', {{$grade2[1]}}],
                ['30', {{$grade2[2]}}], ['40', {{$grade2[3]}}],
            ]);
            var chart2 = new google.visualization.ColumnChart(document.getElementById('Grade2chart'));
            options = {chartArea: {width: '50%'}, title: 'Grade of test2'};
            chart2.draw(dataTable2, options);

            var dataTable3 = new google.visualization.DataTable();
            dataTable3.addColumn('string','Correctness of each test');
            dataTable3.addColumn('number', 'Average correctness');
            dataTable3.addRows([['Test1',{{$avg1}}], ['Test2',{{$avg2}}],]);
            var chart3 = new google.visualization.ColumnChart(document.getElementById('Testchart'));
            options = {chartArea: {width: '50%'}, title: 'Average correctness of each test (%)'};
            chart3.draw(dataTable3, options);

            var dataTable4 = new google.visualization.DataTable();
            dataTable4.addColumn('string','Total grade');
            dataTable4.addColumn('number', 'Number of users');
            dataTable4.addRows([['0-29', {{$grade[0]}}], ['30-59', {{$grade[1]}}],
                ['60-89', {{$grade[2]}}], ['90-110', {{$grade[3]}}],
            ]);
            var chart4 = new google.visualization.ColumnChart(document.getElementById('Gradechart'));
            options = {chartArea: {width: '50%'}, title: 'Total grade'};
            chart4.draw(dataTable4, options);

            var btn_save = document.getElementById("save");
            google.visualization.events.addListener(chart, 'ready', function () {
                btnSave.disabled = false;
            });

            btn_save.addEventListener('click', function () {
                var doc = new jsPDF();
                doc.setFontSize(22);
                doc.text(20, 10, 'Report');
                doc.addImage(chart.getImageURI(), -50, 20);
                doc.addImage(chart1.getImageURI(), -50, 70);
                doc.addImage(chart2.getImageURI(), -50, 120);
                doc.addImage(chart3.getImageURI(), -50, 170);
                doc.addImage(chart4.getImageURI(), -50, 220);
                doc.save('chart.pdf');
            }, false);
        }
    </script>
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
    <div id="test_nav" style="font-size: 24px">
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
    <div style="align-content: center; width: 1080px; height: 720px; padding-top: 70px; margin: auto">
        <h4 class="display-2" style="margin: auto; text-align: center; padding-bottom: 40px" >
            Welcome, {{ $username }} !
        </h4>
        <p style="text-align: center; font-size: 20px">Dear administrator, the following is the report.</p><br>
        <!-- div for our chart -->
        <div id="Learnchart" style="padding-bottom: 30px"></div>
        <div id="Grade1chart"></div>
        <div id="Grade2chart"></div>
        <div id="Testchart"></div>
        <div id="Gradechart"></div>
        <form class="px-4 py-3" method="post" style="padding-top: 100px">
            <div class="form-group" style="align-items: center; justify-content:center; display: flex">
                <input class="btn btn-primary" style="display: flex; margin-right: 20px" type="button" name="save" id="save" value="Save as PDF">
                <input class="btn btn-primary" style="display: flex; margin-right: 20px" type="button" name="print" id="print" value="Print" onclick="window.print();">
                <input type="button" style="display: flex" class="btn btn-primary" value="Profile page" onclick="window.location='{{url('/profile')}}';" />
            </div>
        </form>
    </div>
</body>
</html>
