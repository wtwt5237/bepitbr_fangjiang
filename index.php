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

<body>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky background-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->

                    <div class="logo">
                        <a href="./index.php" style="padding-left: 8px; color: white;">BEPITBR</a>
                    </div>
                    <ul class="nav">
                        <li class="scroll-to-section" ><a href="./index.php" class="active">Home</a></li>
                        <li class="scroll-to-section" ><a href="./analysis.php">Analysis</a></li>
                        <li class="scroll-to-section" ><a href="./epitope.php">Document</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner header-text mt-3" id="top">
    <div class="Modern-Slider">
        <div class="item">
            <div class="img-fill">
                <img src="./resources/assets/images/mainImg.jpg" alt="">
                <div class="text-content">
                    <h3>BepiTBR</h3>
                    <h5>A prediction model that leverages T-B reciprocity to enhance B cell epitopes prediction</h5>
                    <a href="./analysis.php" class="main-stroked-button">online analysis</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="scroll-down scroll-to-section"><a href="#intro"><i class="fa fa-arrow-down fa-2x" style="margin-top: 18px"></i></a></div>
<!-- ***** Main Banner Area End ***** -->

<!-- ***** Intro Start ***** -->
<section id="intro" class="container">
    <div class="intro-block">
        <h1 class="mt-2 mb-3">Introduction</h1>
        <hr class="mb-4">
        <div class="row" data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
            <div class="col-12">
                <div class="text-center">
                    <img src="./resources/assets/images/intro-img1.png" id="intro-img" alt="">
                    <img src="./resources/assets/images/intro-img2.png" id="intro-img" alt="">
                </div>
            </div>
            <div class="col-12 pb-sm-2" id="intro-text">
                <p>
                    The ability to predict B cell epitopes from antigen sequences is critical for biomedical research
                    and many clinical applications. However, despite substantial efforts over the past 20 years,
                    the performance of even the best B cell epitope prediction software is still modest. Based on the
                    idea of T-B reciprocity, BepiTBR is a B cell epitope prediction model that demonstrates improved
                    performance by incorporating prediction of nearby CD4+ T cell epitopes close to the B cell epitopes.
                </p>
                <br>
            </div>
        </div>
    </div>
</section>
<!-- ***** Intro End ***** -->

<!-- ***** Authors Starts ***** -->
<section id="authors" class="container mb-5">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="author-block">
                <h1 class="mb-3">Author</h1>
                <hr class="mb-4" style="margin-right: 35px">
                <div class="row mb-3 mb-xl-0" data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
                    <div class="row col-12">
                        <div class="col-12 col-sm-3">
                            <a href=""><img class="author-img mb-md-3 mb-xl-4" src="./resources/assets/images/jameszhu.jpg" alt=""></a>
                        </div>
                        <div class="col">
                            <div class="mt-3">
                                <p class="mb-1"><i class="fa fa-user mb-1"></i> : &nbsp; James Zhu</p>
                                <p class="mb-1"><i class="fa fa-envelope"></i> : &nbsp; <a href="mailto:James.Zhu@UTSouthwestern.edu">James.Zhu@UTSouthwestern.edu</a></p>
                                <p><i class="fab fa-github"></i> : &nbsp; <a href="https://github.com/zzhu33/BepiTBR">GitHub</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="row ps-2" style="padding-right: 12px">
                <div class="col-12 citation-block">
                    <h1 class="mb-3">Citation</h1>
                    <hr class="mb-4">
                    <div class="mb-4" data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
                        <p class="mb-1">If you use BepiTBR in your publication, please cite the following paper: </p>
                        <p style="font-style: italic">"Zhu, James et al. (2022) BepiTBR: T-B reciprocity enhances B cell epitope prediction. iScience, Volume 25, Issue 2, 103764"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Authors Ends ***** -->

<!-- ***** Footer Starts ***** -->
<?php include('./footer.php') ?>
<!-- ***** Footer Ends ***** -->

<!-- jQuery -->
<script src="./resources/assets/js/jquery.min.js"></script>

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

<!-- Global Init -->
<script src="./resources/assets/js/custom.js"></script>

<!--font-awesome icon kit-->
<script src="https://kit.fontawesome.com/5307596cb1.js" crossorigin="anonymous"></script>


</body>
</html>
