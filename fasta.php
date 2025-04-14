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

</head>


<!-- header -->
<header class="header-area header-sticky background-header">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->

                    <div class="logo">
                        <a href="./index.php" style="padding-left: 8px; color: white;">BEPITBR</a>
                    </div>
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="./index.php">Home</a></li>
                        <li class="scroll-to-section"><a href="./analysis.php">Analysis</a></li>
                        <li class="scroll-to-section"><a href="./epitope.php" class="active">Document</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- analysis -->

<section class="container" style="margin-top: 120px">
    <nav id="breadnav" aria-label="breadcrumb">
        <ol class="breadcrumb nav-block">
            <li class="breadcrumb-item"><a href="./epitope.php">Epitope Mode</a></li>
            <li class="breadcrumb-item"><a href="./fullprotein.php">Full Protein Mode</a></li>
            <li class="breadcrumb-item"><a class="active" href="./fasta.php">Fasta Mode</a></li>
        </ol>
    </nav>
    <div class="row mb-5" id="content">
        <div class="col-9">
            <div class="content-block" data-bs-target="#sidebar" data-bs-offset="0" class="scrollspy-example"
                 tabindex="0">
                <div id="description">
                    <h1>Description</h1>
                    <div data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
                        <p class="mb-3">The ability to predict B cell epitopes from antigen sequences is critical for biomedical research
                            and many clinical applications. However, despite substantial efforts over the past 20 years,
                            the performance of even the best B cell epitope prediction software is still modest. Based on
                            the idea of T-B reciprocity, BepiTBR is a B cell epitope prediction model that demonstrates
                            improved performance by incorporating prediction of nearby CD4+ T cell epitopes close to the B
                            cell epitopes.</p>
                        <p><strong>Fasta Mode</strong> identifies potential B cell epitopes from a .fasta file containing
                            multiple antigen protein sequences. This mode requires protein sequence file in fasta format.</p></p>
                        <hr>
                    </div>
                </div>
                <div id="usage">
                    <h1>Usage</h1>
                    <div data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
                        <div class="mb-3">
                            <p>Example command using provided example files:</p>
                            <p>(replace paths with appropriate paths according to user's particular installation)</p>
                        </div>
                        <pre style="border: 1px solid #ccc;">

<code>raku BepiTBR.raku \</code>
<code>--fasta0=examples/test_data_BepiTBR_fasta/peptide_with_full_length.txt \</code>
<code>--length=15 \</code>
<code>--bepipred2=bp2/bin/activate \</code>
<code>--bepipred1=/home/exampleUser/bp1/bepipred-1.0/bepipred \</code>
<code>--LBEEP=/home/exampleUser/LBEEP/ \</code>
<code>--MixMHC2pred=/home/exampleUser/MixMHC2pred/MixMHC2pred_unix \</code>
<code>--netMHCIIpan=NA \</code>
<code>--dir=/home/exampleUser/BepiTBR/examples/test_output_BepiTBR \</code>
<code>--thread=4</code>
                    </pre>
                        <hr>
                    </div>
                </div>
                <div id="arguments">
                    <h1>Arguments</h1>
                    <div data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Explanation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">fasta0</th>
                                <td colspan="2">protein sequence file in fasta format</td>

                            </tr>
                            <tr class="table-primary">
                                <th scope="row">length</th>
                                <td colspan="2">length of the B cell epitopes to scan in a moving window. Recommended length: 15</td>

                            </tr>
                            <tr>
                                <th scope="row">bepipred2</th>
                                <td colspan="2">the conda environment activation file for BepiPred 2.0</td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">bepipred1</th>
                                <td colspan="2">path to the BepiPred 1.0 executable</td>

                            </tr>
                            <tr>
                                <th scope="row">LBEEP</th>
                                <td colspan="2">path to the LBEEP directory</td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">MixMHC2pred</th>
                                <td colspan="2">path to the MixMHC2pred executable. </td>

                            </tr>
                            <tr>
                                <th scope="row">netMHCIIpan</th>
                                <td colspan="2">path to the NetMHCIIpan 3.2 executable</td>
                            </tr>
                            <tr class="table-primary">
                                <th scope="row">dir</th>
                                <td colspan="2">output directory</td>

                            </tr>
                            <tr>
                                <th scope="row">thread</th>
                                <td colspan="2">number of CPU thread to use; system dependent</td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
                <div id="details" class="mb-3">
                    <h1>Details</h1>
                    <div data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
                        <p class="mb-3">1. Required tools <strong>(BepiPred 1.0, BepiPred 2.0, LBEEP 1.0, NetMHCIIpan 3.2,
                                MixMHC2pred)</strong> must be installed before executing model. For more details about
                            installation and other dependencies, please visit our <a href="https://github.com/zzhu33/BepiTBR">GitHub</a>.</p>
                        <p class="mb-3">2. For BepiPred 2.0, this tool requires an isolated python virtual environment <strong>(python 2.7)</strong>.
                            After installation, It is recommended to move the bp2 env directory into the BepiTBR main directory.</p>
                        <p>3. It is recommended to set <strong>netMHCIIpan</strong> to NA for better run speed.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div id="sidebar" class="list-group text-center">
                <a class="list-group-item list-group-item-action active" href="#description">Description</a>
                <a class="list-group-item list-group-item-action" href="#usage">Usage</a>
                <a class="list-group-item list-group-item-action" href="#arguments">Arguments</a>
                <a class="list-group-item list-group-item-action" href="#details">Details</a>

                <a class="btn btn-primary mt-2" href="https://github.com/zzhu33/BepiTBR"><i class="fab fa-github"></i>&nbsp; GitHub</a>
            </div>
        </div>
    </div>
</section>


<!-- ***** Footer Starts ***** -->
<?php include('./footer.php') ?>
<!-- ***** Footer Ends ***** -->

<!-- jQuery -->
<script src="./resources/assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="./resources/assets/js/popper.min.js"></script>
<script src="./resources/assets/js/bootstrap.bundle.min.js"></script>

<!-- Plugins -->
<script src="./resources/assets/js/owl-carousel.js"></script>
<script src="./resources/assets/js/scrollreveal.min.js"></script>
<script src="./resources/assets/js/waypoints.min.js"></script>
<script src="./resources/assets/js/jquery.counterup.min.js"></script>
<script src="./resources/assets/js/imgfix.min.js"></script>
<script src="./resources/assets/js/slick.js"></script>
<script src="./resources/assets/js/isotope.js"></script>

<!-- Global Init -->
<script src="./resources/assets/js/custom.js"></script>

<!--font-awesome icon kit-->
<script src="https://kit.fontawesome.com/5307596cb1.js" crossorigin="anonymous"></script>


<script>
    $('.list-group-item').on('click', function () {
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
    });
</script>

</body>
</html>
