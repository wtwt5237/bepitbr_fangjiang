<?php include('./mainfuc.php') ?>

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


<!-- Header Starts -->
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
                        <li class="scroll-to-section" ><a href="./index.php">Home</a></li>
                        <li class="scroll-to-section" ><a href="./analysis.php" class="active">Analysis</a></li>
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
<!-- Header Ends -->

<!-- Analysis Starts-->
<section class="container" id="analysis">
    <div id="notice">
        <?php
        if (!empty($error) && count($error) > 0) {
            foreach ($error as $item) {
                echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> <b>Warning: </b> ' . $item . '</div>';
            }
        }
        ?>
    </div>
    <form method="post" enctype="multipart/form-data" id="analysis_form" style="margin-bottom: 210px">
        <!-- step1 -->
        <section class="row" id="step1" data-scroll-reveal="enter top move 30px over 0.4s after 0.2s">
            <div class="col-8 offset-2 step-block">
                <h1 class="mb-3 text-center">1. &nbsp; Input Your Information</h1>
                <hr class="mb-4">
                <div>
                    <div class="mb-3">
                        <label for="step1-input1">Input Your Institution Name (optional)
                            <a data-bs-toggle="tooltip" data-bs-placement="right"
                               title="only contain letters, numbers and spaces.">
                                <i class="fa fa-question-circle"></i></a>
                        </label>
                        <input type="text" name="inst" class="form-control" id="step1-input1"
                               placeholder="Institution">
                    </div>
                    <div class="mb-4">
                        <label for="">Input Your Email <span class="needed">*</span>
                            <a id="whyemail" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus"
                               title="Why email required?"
                               data-bs-content="The average waiting time for analysis would be 10 to 20 minutes. If you have
                           left your email, you don't need to keep the waiting page open. We'll send you a notification
                           email once it is finished."> Why email required?</a></label>
                        <input type="email" name="email" class="form-control" id="step1-input2"
                               placeholder="Email" required>
                    </div>
                    <!-- next button -->
                    <div class="text-center">
                        <a id="btn1" class="btn btn-success btn-lg mb-2" data-bs-toggle="collapse" data-bs-parent="false"
                           href="#step2" role="button" aria-expanded="true" aria-controls="step2">
                            NEXT STEP</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- step2 -->
        <section class="row collapse" id="step2">
            <div class="col-8 offset-2 step-block">
                <h1 class="text-center mb-3">2. &nbsp; Select an Analysis Mode</h1>
                <hr class="mb-4">
                <!-- checkbox -->
                <fieldset class="offset-3 offset-md-4 offset-xxl-5 mb-3">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="mode" id="epitope" value="epitope" checked>
                        <label class="form-check-label" for="epitope">
                            Epitope Mode
                            <a data-bs-toggle="tooltip" data-bs-placement="right"
                               title="Analyzes specific epitopes within proteins.">
                                <i class="fa fa-question-circle"></i></a>
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="mode" id="fullprotein" value="fullprotein">
                        <label class="form-check-label" for="fullprotein">
                            Full Protein Mode
                            <a data-bs-toggle="tooltip" data-bs-placement="right"
                               title="Identify potential B cell epitopes from a .fasta file containing multiple antigen protein sequences.">
                                <i class="fa fa-question-circle"></i></a>
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="mode" id="fasta" value="fasta">
                        <label class="form-check-label" for="fasta">
                            Fasta Mode
                            <a data-bs-toggle="tooltip" data-bs-placement="right"
                               title="Identify potential B cell epitopes from multiple antigen protein sequences.">
                                <i class="fa fa-question-circle"></i></a>
                        </label>
                    </div>
                </fieldset>
                <!-- next button-->
                <div class="text-center">
                    <a id="btn2" class="btn btn-success btn-lg mb-2" href="#step3" data-bs-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="step3">NEXT STEP</a>
                </div>
            </div>
        </section>

        <!-- step3 -->
        <section class="row pb-5 collapse" id="step3">
            <div class="col-8 offset-2 step-block">
                <!-- title -->
                <div id="uploadMsg">
                    <h1 class="text-center mb-3">3. &nbsp; Input Your Parameters </h1>
                    <hr class="mb-4">
                </div>

                <!-- epitope section-->
                <div class="mb-3" id="epitope-upload">
                    <!-- motif0_file input file-->
                    <label for="motif0_file" class="form-label">Epitope sequences (motif0_file) <span
                                class="needed">*</span></label>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" href="#Modal1" class="example">
                        Example
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="ModalLabel1"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel1"> Input File Format - motif0_file </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-3">
                                    <img class="modal-img mb-5" src="./resources/assets/images/motif0_file.png" alt="">
                                    <div class="mb-5">
                                        <h5 class="mb-3">Upload Format</h5>
                                        <p>Only txt file accepted.</p>
                                        <p>The maximum size is 5MB.</p>
                                    </div>
                                    <div>
                                        <h5>Example Download &nbsp; <a
                                                    href="./resources/example_inputs/epitope/Ind-positive.txt" download><i
                                                        class="fas fa-file-download"></i></a></h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" class="form-control upload-button btn1 mb-3" name="motif0_file" id="motif0_file"
                           required>

                    <!-- full0_file input file -->
                    <label for="formFile" class="form-label">Full antigen protein sequences (full0_file)
                        <span class="needed">*</span></label>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" href="#Modal2" class="example">
                        Example
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="ModalLabel2"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel2"> Input File Format - full0_file </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-3">
                                    <img class="modal-img mb-5" src="./resources/assets/images/full0_file.png" alt="">
                                    <div class="mb-5">
                                        <h5 class="mb-3">Upload Format</h5>
                                        <p>Only txt file accepted.</p>
                                        <p>The maximum size is 5MB.</p>
                                    </div>
                                    <div>
                                        <h5>Example Download &nbsp; <a
                                                    href="./resources/example_inputs/epitope/peptide_with_full_length.txt"
                                                    download>
                                                <i class="fas fa-file-download"></i></a></h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" class="form-control upload-button btn2 mb-3" name="full0_file" id="full0_file"
                           required>

                    <!-- thread input-->
                    <label for="epitope-thread" class="form-label">Thread <span class="needed">*</span>
                        <a data-bs-toggle="tooltip" data-bs-placement="right"
                           title="Number of CPU thread to use; System dependent.">
                            <i class="fa fa-question-circle"></i></a>
                    </label>
                    <input type="number" name="epitope-thread" class="form-control mb-3" id="epitope-thread" value="4"
                           min="1" max="10">
                </div>

                <!-- full protein section -->
                <div class="mb-4" id="full-upload">
                    <!-- full input file-->
                    <label for="formFile" class="form-label">Antigen protein sequence (full0) <span
                                class="needed">*</span></label>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" href="#Modal3" class="example">
                        Example
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel3"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel3"> Input File Format - full0 </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-3">
                                    <img class="modal-img mb-5" src="./resources/assets/images/full0.png" alt="">
                                    <div class="mb-5">
                                        <h5 class="mb-3">Upload Format</h5>
                                        <p>Only txt file accepted.</p>
                                        <p>The maximum size is 5MB.</p>
                                    </div>
                                    <div>
                                        <h5>Example Download &nbsp; <a
                                                    href="./resources/example_inputs/full/example_full.txt" download><i
                                                        class="fas fa-file-download"></i></a></h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" class="form-control upload-button mb-3" name="full0" id="full0" required>

                    <!-- length input -->
                    <label for="full-length" class="form-label">Length <span class="needed">*</span>
                        <a data-bs-toggle="tooltip" data-bs-placement="right"
                           title="Length of the B cell epitopes to scan in a moving window. Recommended length: 15.">
                            <i class="fa fa-question-circle"></i></a></label>
                    <input type="number" name="full-length" class="form-control mb-3" id="full-length" value="15"
                           min="5" max="25">
                    <!-- thread input -->
                    <label for="full-thread" class="form-label">Thread <span class="needed">*</span>
                        <a data-bs-toggle="tooltip" data-bs-placement="right"
                           title="Number of CPU thread to use; System dependent.">
                            <i class="fa fa-question-circle"></i></a></label>
                    <input type="number" name="full-thread" class="form-control mb-3" id="full-thread" value="8" min="1"
                           max="10">
                </div>

                <!-- fasta section -->
                <div class="mb-4" id="fasta-upload">
                    <!-- fasta input file -->
                    <label for="formFile" class="form-label">Protein sequence file in fasta format (fasta0) <span
                                class="needed">*</span></label>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" href="#Modal4" class="example">
                        Example
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="ModalLabel4"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel4"> Input File Format - fasta0 </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-3">
                                    <img class="modal-img mb-5" src="./resources/assets/images/fasta0.png" alt="">
                                    <div class="mb-5">
                                        <h5 class="mb-3">Upload Format</h5>
                                        <p>Only txt file accepted.</p>
                                        <p>The maximum size is 5MB.</p>
                                    </div>
                                    <div>
                                        <h5>Example Download &nbsp; <a
                                                    href="./resources/example_inputs/fasta/peptide_with_full_length.txt"
                                                    download><i class="fas fa-file-download"></i></a></h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" class="form-control upload-button mb-3" name="fasta0" id="fasta0" required>

                    <!-- length input -->
                    <label for="fasta-length" class="form-label">Length <span class="needed">*</span>
                        <a data-bs-toggle="tooltip" data-bs-placement="right"
                           title="Length of the B cell epitopes to scan in a moving window. Recommended length: 15.">
                            <i class="fa fa-question-circle"></i></a></label>
                    <input type="number" name="fasta-length" class="form-control mb-3" id="fasta-length" value="15"
                           min="5" max="25">
                    <!-- thread input -->
                    <label for="fasta-thread" class="form-label">Thread <span class="needed">*</span>
                        <a data-bs-toggle="tooltip" data-bs-placement="right"
                           title="Number of CPU thread to use; System dependent.">
                            <i class="fa fa-question-circle"></i></a></label>
                    <input type="number" name="fasta-thread" class="form-control mb-3" id="fasta-thread" value="4"
                           min="1" max="10">
                </div>
                <!-- submit and reset button -->
                <div class="d-grid gap-2 d-md-flex justify-content-center mt-4">
                    <button class="btn btn-success btn-lg mb-2" type="submit" id="submitform">Submit</button>
                </div>
            </div>
        </section>

    </form>

<!-- Spinner Starts -->
    <div id="json" class="waiting text-center mt-5">
    </div>

</section>
<!-- Spinner Ends -->
<!-- Analysis Ends-->

<!-- ***** Footer Starts ***** -->
<?php include('./footer.php') ?>
<!-- ***** Footer Ends ***** -->

<!-- jQuery -->
<script src="./resources/assets/js/jquery.min.js"></script>
<script src="./resources/assets/js/jquery.validate.min.js"></script>

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


<!--------------------
--- Main Functions ---
---------------------->
<script>
    const showStep2 = $('#step2');
    const btn1 = $('#btn1');

    // step1 form validation
    showStep2.on('show.bs.collapse', function (e) {
        if (!$('#step1-input1')[0].checkValidity()) {
            $('#step1-input1')[0].reportValidity()
            e.preventDefault();
        } else if (!$('#step1-input2')[0].checkValidity()) {
            $('#step1-input2')[0].reportValidity()
            e.preventDefault();
        }
    })

    showStep2.on('shown.bs.collapse', function () {
        $('#step1-input1').prop('disabled', true);
        $('#step1-input2').prop('disabled', true);
        btn1.attr('href', '');
        btn1.addClass('btn-secondary').removeClass('btn-success');
    })

    const showStep3 = $('#step3');

    const check1 = $('#epitope');
    const check2 = $('#fullprotein');
    const check3 = $('#fasta');

    const epitope = $('#epitope-upload');
    const full = $('#full-upload');
    const fasta = $('#fasta-upload');

    const motif0_file = $('#motif0_file');
    const full0_file = $('#full0_file');
    const full0 = $('#full0');
    const fasta0 = $('#fasta0');

    showStep3.on('show.bs.collapse', function () {
        if (check1.prop('checked')) {
            full.hide();
            full0.removeAttr('required');
            fasta.hide();
            fasta0.removeAttr('required');
        }
        if (check2.prop('checked')) {
            epitope.hide();
            motif0_file.removeAttr('required');
            full0_file.removeAttr('required');
            fasta.hide();
            fasta0.removeAttr('required');
        }
        if (check3.prop('checked')) {
            epitope.hide();
            motif0_file.removeAttr('required');
            full0_file.removeAttr('required');
            full.hide();
            full0.removeAttr('required');
        }
    })

    const btn2 = $('#btn2');
    const analysis = $('#analysis');

    showStep3.on('shown.bs.collapse', function () {
        $('#epitope').prop('disabled', true);
        $('#fullprotein').prop('disabled', true);
        $('#fasta').prop('disabled', true);
        btn2.attr('href', '');
        btn2.removeClass("btn-success").addClass("btn-secondary");
        analysis.css('paddingBottom', '1px');
    })

</script>

<!-- Initialize tooltip, popover and modal -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

</script>

<!-- main function for job status tracking -->
<script>
    // Setup global variables
    var jobid = '<?php echo $jobid; ?>';
    var status = '<?php echo $status; ?>';
    var ind = '<?php echo $success; ?>';

    var statusArr = {
        '0': 'New',
        '1': 'Done',
        '2': 'Running',
        '3': 'Jobid is empty',
        '4': 'Job ID is not found',
        '5': 'Database connection failed',
        '9': 'Server execution failed'
    };

    (function ($) {
        // Update status in ajax calling
        function updateStatus(n) {
            console.log("updateStatus: " + n);
            status = n;
        }

        // If n is a float, keep 2 decimal
        function ifFloat(n) {
            if (n % 1 !== 0) {
                n = Math.round(n * 100) / 100;
            }
            return n;
        }

        // Disable all the input elements and clear the existing result when submit form
        function disableForm() {
            $("#step1").prop('data-scroll-reveal', '');
            $("#step1").prop('data-scroll-reveal-id', '');
            $("#step1").prop('data-scroll-reveal-initialized', false);
            $("#step1").prop('data-scroll-reveal-com', false);
            $("#analysis_form").hide();
        }

        // check the analysis' status at the moment
        function inRunning(jobid) {
            console.log("inRunning jobid: " + jobid);
            console.log("inRunning status: " + status);
            $.ajax({
                url: 'progress.php?jobid=' + jobid,
                success: function (str) {
                    var res = JSON.parse(str);
                    updateStatus(res.status);

                    console.log('@@@@@@@@@@@@@@@@@@ PROGRESS');
                    console.log(res);


                    if (res.status == 1) { // Success
                        window.location.replace("https://dbai.biohpc.swmed.edu/bepitbr/result.php?jobid=" + jobid);
                    } else if (res.status == 0 || res.status == 2) { // Waiting or Running
                        var $html = '';
                        $html += '<div style="margin: 150px 0 120px">' +
                            '<div id="loading" class="spinner-border" role="status" style="width: 10rem; height: 10rem; margin: 0 10px 20px 0"> '+
                            '<span class="visually-hidden">Loading...</span></div>' +
                            '<h5 class="mt-4 mb-4 fs-2">Processing......</h5>' +
                            '<p class="mb-1">The average processing time is about 5-15 minutes depending on your input parameters.</p>' +
                            '<p class="mb-1">A notification email with the result link will be sent to you once the job completed.</p>' +
                            '</div>'
                        $("div.waiting").html($html);
                    } else if (res.status == 9) { // Failed
                        $("div#notice").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> <b>Warning: </b>Unexpected error</div>');
                    } else { // Other errors
                        var msg = '';
                        switch (res.status) {
                            case 3:
                                msg = 'Jobid empty';
                                break;
                            case 4:
                                msg = 'Job ID is not found';
                                break;
                            case 5:
                                msg = 'Database connection failed';
                                break;
                            default:
                                msg = 'Unexpected error';
                        }
                        $("div#notice").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> <b>Warning: </b> ' + msg + '</div>');
                    }
                },
                async: false
            });
        }

        // Setup analysis status checking by 3 sec
        function trackProgress(jobid) {
            var checkItOut = setInterval(
                function () {
                    console.log("Tracking jobid: " + jobid);
                    console.log("Tracking nowStatus: " + status);
                    inRunning(jobid);

                    if (status != 0 && status != 2) { // If job is waiting or running, keep monitoring; otherwise, jump out the iteration
                        console.log("Exit: " + status);
                        clearInterval(checkItOut);
                        // enableForm();
                    }
                }, 3000);
        }

        $(document).ready(function () {
            // Handle webpage action by POST/GET requst
            if (ind == 2) {
                location.href = "#analysis";
            }
            // Designed for GET request way of checking the analysis progress
            if (jobid != '') {
                console.log("jobid: " + jobid);
                console.log("status: " + status);

                if (status == 3 || status == 4 || status == 5 || status == 9) {
                    enableForm();
                    $("div#notice").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> <b>Warning: </b> ' + statusArr[status] + '</div>');
                    location.href = "#analysis";
                } else if (status == 0 || status == 2) {
                    disableForm();
                    var $html = '';
                    $html += '<div style="margin: 150px 0 120px">' +
                        '<div id="loading" class="spinner-border" role="status" style="width: 10rem; height: 10rem; margin: 0 10px 20px 0"> '+
                        '<span class="visually-hidden">Loading...</span></div>' +
                        '<h5 class="mt-4 mb-4 fs-2">Processing......</h5>' +
                        '<p class="mb-1">The average processing time is about 5-15 minutes depending on your input parameters.</p>' +
                        '<p class="mb-1">A notification email with the result link will be sent to you once the job completed.</p>' +
                        '</div>'
                    $("div.waiting").html($html);
                    location.href = "#analysis";
                    trackProgress(jobid);
                } else if (status == 1) {
                    window.location.replace("https://dbai.biohpc.swmed.edu/bepitbr/result.php?jobid=" + jobid);
                }
            }

            // enable inputs fields after submit
            $("#analysis_form").submit(function () {
                $('#step1-input1').prop('disabled', false);
                $('#step1-input2').prop('disabled', false);
                $('#epitope').prop('disabled', false);
                $('#fullprotein').prop('disabled', false);
                $('#fasta').prop('disabled', false);
                // return true
            });

        })
    })(jQuery);


</script>

</body>
</html>
