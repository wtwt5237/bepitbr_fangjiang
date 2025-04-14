<!DOCTYPE html>
<html lang="en">

<head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GKJXGKMXES"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GKJXGKMXES');
</script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BepiTBR</title>
    <!-- tab icon -->
    <link rel="icon" type="image/x-icon" href="./resources/assets/images/tabicon.png"/>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="./resources/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./resources/assets/css/font-awesome.css">
    <link rel="stylesheet" href="./resources/assets/css/templatemo-breezed.css">
    <link rel="stylesheet" href="./resources/assets/css/custom.css">

    <!-- DataTable Plugin -->
    <link rel="stylesheet" type="text/css" href="./resources/assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./resources/assets/css/buttons.dataTables.min.css">
    <style>

    </style>

</head>

<body>

<!-- Header Starts-->
<header class="header-area header-sticky background-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <div class="logo">
                        <a href="./index.php" style="padding-left: 8px; color: white;">BEPITBR</a>
                    </div>
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="./index.php">Home</a></li>
                        <li class="scroll-to-section"><a href="./analysis.php" class="active">Analysis</a></li>
                        <li class="scroll-to-section"><a href="./epitope.php">Document</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Ends-->

<!-- Preloader Starts -->
<!--<div id='loading' class="spinner-border" role="status" style="width: 10rem; height: 10rem; margin: 30vh 0 50vh 45vw">-->
<!--    <span class="visually-hidden">Loading...</span>-->
<!--</div>-->
<!-- Preloader Ends -->

<!-- Prepare a DOM with a defined width and height for ECharts -->
<div class="container position-relative">
    <div id="info" style="background-color: ghostwhite; position: absolute; display: none; z-index: 999; bottom: 0">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span class="pe-3" id="info-header"></span>
                <span class="close_window">X</span>
            </div>
            <div class="card-body" id="info-content">
            </div>
        </div>
    </div>
    <div style="margin-top: 120px">
        <div id="main" style="height:600px;"></div>
    </div>
</div>

<!-- Result Table Starts-->
<section class="dataTableHidden">
    <?php
    define('SYSPATH', 'objects');

    require_once SYSPATH . '/qbrc_cfg.php';
    require_once SYSPATH . '/qbrc_func.php';

    $jobid = '';
    $error = '';

    if (isset($_GET['jobid'])) {
        $jobid = escape($_GET["jobid"]);

        $db = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
        if ($db->connect_error) {
            die('Unable to connect to database: ' . $db->connect_error);
        }

        if ($result1 = $db->prepare("select Predictions from BepiResults where JobID = ?")) {
            $result1->bind_param("s", $jobid);
            $result1->execute();
            $result1->store_result();
            $result1->bind_result($res_file);
            $result1->fetch();
            $result1->close();
        }

        // convert binary blob to text format

        if ($result1 = $db->prepare("select Mode from BepiParameters where JobID = ?")) {
            $result1->bind_param("s", $jobid);
            $result1->execute();
            $result1->store_result();
            $result1->bind_result($mode);
            $result1->fetch();
            $result1->close();
        }

        if (isset($res_file)) {
            if ($mode !== 'fasta') {

                echo '<div class="jobid" data-service="' . $jobid . '" >';
                echo '<div class="mode" data-service="' . $mode . '" >';

                $char = array('_', '-', '.', '=');
                for ($i = 0; $i < strlen($res_file); $i++) {
                    if (!ctype_alpha($res_file[$i]) and !is_numeric($res_file[$i]) and !in_array($res_file[$i], $char)) {
                        $res_file[$i] = ' ';
                    }
                }

                echo '<table id="table" class="display nowrap" >';

                $res = explode(" ", $res_file);
                array_pop($res);
                $col_count = 2;

                foreach ($res as $word) {
                    if ($col_count <= 9) {
                        if ($col_count == 2) {
                            echo '<thead><tr><th>name</th>';
                            echo '<th>' . $word . '</th>';
                        } elseif ($col_count == 9) {
                            echo '<th>' . $word . '</th></tr></thead>';
                        } else {
                            echo '<th>' . $word . '</th>';
                        }
                    } else {
                        if ($col_count == 10) {
                            echo '<tbody><tr><td>' . $word . '</td>';
                        } elseif ($mode === 'epitope' and substr($word, 0, 8) === "Negative") {
                            echo '<tr><td>' . $word . '</td>';
                        } elseif ($mode === 'fullprotein' and substr($word, 0, 3) === "job") {
                            echo '<tr><td>' . $word . '</td>';
                        } elseif ($col_count % 9 == 0) {
                            echo '<td>' . $word . '</td></tr>';
                        } else {
                            echo '<td>' . $word . '</td>';
                        }
                    }
                    $col_count += 1;
                }
                echo '</tbody>';
                echo '</table>';

                $icon = '';
            } else {
                $icon = '<img src="./resources/assets/images/success.png" alt="" style="width: 200px; ">';
            }

            $db->close();
            $content = '<div class="mt-3 text-center row">
              <div class="col-12">' . $icon . '</div>
              <div style="margin-top: 30px; margin-bottom: 10vh" class="col-12">
              <a class="btn btn-success btn-lg" href="download.php?jobid=' . $jobid . '"' . '><i
                        class="fas fa-download"></i> Download Results</a>
              </div>
              </div>';
        } else {
            $content = '';
            echo '<div class="error"><h1>404</h1><p>Not Found</p><p>The resource requested could not be found.</p></div>';
        }
    } else {
        $content = '';
        echo '<div class="error"><h1>404</h1><p>Not Found</p><p>The resource requested could not be found.</p></div>';
    }

    ?>
</section>
<!-- Result Table -->

<!-- Results Starts-->
<section id="downloadBtn" class="container" style="display: none;">
    <?php echo $content; ?>
</section>
<!-- Results Ends-->

<!-- ***** Footer Starts ***** -->
<?php include('./footer.php') ?>
<!-- ***** Footer Ends ***** -->

<script src="resources/assets/js/echarts.min.js"></script>
<!-- jQuery -->
<!--<script src="./resources/assets/js/jquery.validate.min.js"></script>-->

<!-- DataTable Plugin -->
<script src="./resources/assets/js/jquery.min.js"></script>
<script src="./resources/assets/js/jquery.dataTables.min.js"></script>
<script src="./resources/assets/js/dataTables.buttons.min.js"></script>
<script src="./resources/assets/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable({
            "scrollX": true,
            "sScrollXInner": "100%",
            "columnDefs": [
                {"type": "natural", targets: 0}
            ],
            order: [[0, 'asc']],
            language: {search: ""},
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'colvis',
                    postfixButtons: ['colvisRestore']
                }
            ]
        });
        // preloader
        // $('#loading').delay(500).hide(0);
        setTimeout(function () {
            $('.dataTableHidden').removeClass('dataTableHidden');
            $('#downloadBtn').show();
        }, 500);

        $('#table_wrapper').css('text-align', 'center');
        $('#table_filter input').prop('placeholder', 'search......').css('padding', '4px');

    });
</script>
<script src="./resources/assets/js/natural.js"></script>

<!-- Bootstrap -->
<script src="./resources/assets/js/popper.min.js"></script>
<script src="./resources/assets/js/bootstrap.bundle.min.js"></script>

<!-- Plugins -->
<script src="resources/assets/js/owl-carousel.js"></script>
<script src="resources/assets/js/scrollreveal.min.js"></script>
<script src="resources/assets/js/waypoints.min.js"></script>
<script src="resources/assets/js/jquery.counterup.min.js"></script>
<script src="resources/assets/js/imgfix.min.js"></script>
<script src="resources/assets/js/slick.js"></script>
<script src="resources/assets/js/isotope.js"></script>

<!-- Global Init -->
<script src="resources/assets/js/custom.js"></script>

<!-- font-awesome icon kit -->
<script src="https://kit.fontawesome.com/5307596cb1.js" crossorigin="anonymous"></script>

<script type="text/javascript">
    var jobid = $('.jobid').data('service');
    var mode = $('.mode').data('service');
    console.log(jobid);
    console.log(mode);
    // import * as echarts from 'echarts';
    // var ROOT_PATH = 'https://echarts.apache.org/examples';
    var chartDom = document.getElementById('main');
    var myChart = echarts.init(chartDom);
    var option;

    myChart.showLoading();
    $.get('output/' + mode + '_' + jobid + '/data.json', function (graph) {
        myChart.hideLoading();
        graph.nodes.forEach(function (node) {
            if (node.name) {
                node.symbolSize = 20;
            } else {
                node.symbolSize = 30;
            }
        });
        option = {
            legend: [
                {
                    // selectedMode: 'single',
                    data: graph.categories.map(function (a) {
                        return a.name;
                    }),
                    selectedMode: false,
                    icon: 'circle',
                    textStyle: {
                        fontWeight: "bolder",
                        fontSize: 15
                    }
                }
            ],
            tooltip: {
                triggerOn: 'mousemove',
                enterable: true,
                alwaysShowContent: true,
                formatter: function (params) {
                    // $('#info').html(params.data['id']).show();
                    if (params.dataType === 'node') {
                        if (params.name === 'Epitope Record') {
                            return '<span class="fw-bold">IEDB Epitope Assay Record</span><br>' +
                                'assay:  ' + '<a href="' + params.data["assay"] + '">' + params.data["assay"] + '</a><br>';
                        }
                        if (params.name === 'Reference Record') {
                            return '<span class="fw-bold">IEDB Reference Record</span><br>' +
                                'reference:  ' + '<a href="' + params.data["reference"] + '">' + params.data["reference"] + '</a><br>';
                        }
                        return '<span class="fw-bold">BepiTBR prediction</span><br>' +
                            'epitope:  ' + params.data['epitope'] + '<br>' +
                            'base_bepipred1.0:  ' + params.data['base1.0'] + '<br>' +
                            'base_bepipred2.0:  ' + params.data['base2.0'] + '<br>' +
                            'base_LBEEP:  ' + params.data['base_LBEEP'] + '<br>' +
                            'enhanced_bepipred1.0:  ' + params.data['enhance1.0'] + '<br>' +
                            'enhanced_bepipred2.0:  ' + params.data['enhance2.0'] + '<br>' +
                            'enhanced_LBEEP:  ' + params.data['enhance_LBEEP'] + '<br>' +
                            'ensemble:  ' + params.data['ensemble'];

                    }
                },
            },
            series: [
                {
                    name: 'test graph',
                    type: 'graph',
                    layout: 'force',
                    data: graph.nodes,
                    links: graph.links,
                    categories: graph.categories,
                    roam: true,
                    draggable: true,
                    edgeSymbol: ['none', 'arrow'],
                    edgeSymbolSize: 7,
                    label: {
                        position: 'right'
                    },
                    force: {
                        repulsion: 200,
                        edgeLength: 30,
                        gravity: 0.2
                    },
                    emphasis: {
                        focus: 'adjacency',
                        lineStyle: {
                            width: 5
                        }
                    },
                }
            ]
        };
        myChart.setOption(option);

        myChart.on('click', function (params) {
            if (params.dataType === 'node') {
                let content = '';
                let header = '';
                if (params.name === 'Epitope Record') {
                    header += '<span class="fw-bold">DB Epitope Record</span>';
                    content += 'assay:  ' + '<a href="' + params.data["assay"] + '">' + params.data["assay"] + '</a><br>';
                } else if (params.name === 'Reference Record') {
                    header += '<span class="fw-bold">Reference Record</span>';
                    content += '<span class="fw-bold">IEDB Reference Record</span><br>' +
                        'reference:  ' + '<a href="' + params.data["reference"] + '">' + params.data["reference"] + '</a><br>';
                } else {
                    header += '<span class="fw-bold">BepiTBR prediction</span>';
                    content += 'epitope:  ' + params.data['epitope'] + '<br>' +
                        'base_bepipred1.0:  ' + params.data['base1.0'] + '<br>' +
                        'base_bepipred2.0:  ' + params.data['base1.0'] + '<br>' +
                        'base_LBEEP:  ' + params.data['base_LBEEP'] + '<br>' +
                        'enhanced_bepipred1.0:  ' + params.data['enhance1.0'] + '<br>' +
                        'enhanced_bepipred2.0:  ' + params.data['enhance2.0'] + '<br>' +
                        'enhanced_LBEEP:  ' + params.data['enhance_LBEEP'] + '<br>' +
                        'ensemble:  ' + params.data['ensemble'];
                }
                $('#info-header').html(header);
                $('#info-content').html(content);
                $('#info').show();
            }
        })
    });

    option && myChart.setOption(option);
</script>

<script>
    $('.close_window').on('click', function () {
        $('#info').hide();
    })
</script>

</body>
</html>
