<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->


<head>
<!-- <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> -->

<?php
include "../backend/db.php";

 include "../backend/partials/previewMetaData.php" ?>

	<link rel="stylesheet" href="../front/public/css/fontawesome.min.css">
	<link rel="stylesheet" href="../front/public/css/line-awesome.min.css">
	<link rel="stylesheet" href="../front/public/css/business-icon.css">
	<link rel="stylesheet" href="../front/public/css/animate.min.css">
	<link rel="stylesheet" href="../front/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../front/public/css/slick.min.css">
	<link rel="stylesheet" href="../front/public/css/venobox.min.css">
	<link rel="stylesheet" href="../front/public/css/odometer.min.css">
	<link rel="stylesheet" href="../front/public/css/nice-select.css">
	<link rel="stylesheet" href="../front/public/css/splitting-cells.css">
	<link rel="stylesheet" href="../front/public/css/splitting.css">
	<link rel="stylesheet" href="../front/public/css/keyframe-animation.css">
	<link rel="stylesheet" href="../front/public/css/slider.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../front/public/css/header.css">
	<link rel="stylesheet" href="../front/public/css/footer.css">
	<link rel="stylesheet" href="../front/public/css/main.css">
	<link rel="stylesheet" href="../front/public/css/responsive.css">
	<script src="../front/public/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

    <!-- END QUILL JS  -->
     <!-- <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->

    <style>
        .footer-section a {
            color: #dbdadaa9;
        }
        .tab__nav {
            border-bottom: 1px solid #80078b;
        }
        .tab__nav li .active {
            background-color: #80078b;
            color: white;
        }
        .tab__nav li {
            display: inline-block;
            margin-bottom: .625rem;
        }
        .tab__nav a {
            font-weight: 600;
            border: none;
            padding: .625rem;
        }
        .doi-access-wrapper {
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        .rlist--inline {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .content-item-format-links .rlist--inline li {
            margin-right: 10px;
            font-weight: bold;
            color: #310357;
        }
        .content-item-format-links .rlist--inline li a {
            padding-right: 10px;
            color: #310357;
        }
        .comma p {
            color: #3b3b3b;
        }
        .issue-item__details {
            margin-top: 10px;
        }
        .section__mainHeader--mid {
            margin-top: 20px;
            font-size: 20px;
        }
        @media (min-width: 768px) {
            .col-md-8 {
                -ms-flex: 0 0 66.666667%;
                flex: 0 0 66.666667%;
                max-width: 100%;
            }
            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 100%;
            }
        }
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            z-index: 9999;
            display: none;
        }
        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #9834db;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin: auto;
            margin-top: 20%;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .errorpopup, .successpopup {
            position: fixed;
            top: 30%;
            right: 20px;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 0;
            outline: none;
            border: none;
            z-index: 9999999;
            transition: opacity 0.3s ease-in-out;
        }
        .errorpopup { background-color: #e22424; }
        .successpopup { background-color: #4CAF50; }
        .errorpopup.show, .successpopup.show { opacity: 1; }
        .errorpopup.hidden, .successpopup.hidden { display: none; }
        .share-options {
            background-color: white;
            border: 1px solid #ddd;
            padding: 10px;
            z-index: 1000;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .share-options ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .share-options li {
            margin: 5px 0;
            cursor: pointer;
            margin-right: 10px;
        }
        .share-options li:hover { color: #007bff; }
        .shareButton { cursor: pointer; }
        .doi-access-wrapper .articleSpan { margin-right: 20px; }
        
        @media screen and (max-width: 720px) {
            .doi-access-wrapper { font-size: 12px; }
            .doi-access-wrapper .articleSpan {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .editchoice { margin-left: 0px; }
            .issue-item__title { font-size: 16px; }
            .comma p { font-size: 12px; }
            .issue-item__details { font-size: 14px; }
            .content-item-format-links .rlist--inline li { font-size: 12px; }
        }
        .footer-widget p, .widget-links a { font-size: 1.3rem; }
        .widget-links .fa-square-full { display: none; }
    </style>
</head>

<body class="header-1 business">

    <?php include ("../components/top-navbar.php") ?>
    <?php include '../components/header.php'; ?>

   <style>

    iframe {
        width: 100%;
        height: 1000vh;
        overflow: visible;
        margin:0;
    }
   </style>
    <iframe src="" frameborder="0" id="frame"></iframe>

        <script>
        const searchParams = new URLSearchParams(window.location.search);
const hasParamSupplementId = searchParams.has('sid');
const frameBody = document.getElementById("frame")
if(hasParamSupplementId){
    const SearchId = searchParams.get("sid")
    const searchURL = `https://portal.asfirj.org/contentMap?sid=${SearchId}`
    // window.location.href = `https://portal.asfirj.org/content?sid=${SearchId}`
frameBody.setAttribute("src", searchURL)

}
    </script>

    <?php include ("../components/footer.php") ?>

</body>
</html>