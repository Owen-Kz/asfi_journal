<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title> Author - Dashboard</title>
    <meta name="title" Content="Author - Dashboard">

    <meta name="description" content="asfiresearchjournal">
    <meta name="keywords" content="asfiresearchjournal">
    <link rel="shortcut icon" href="../../../assets/images/logoIcon/favicon.png" type="image/x-icon">

     
    <link rel="apple-touch-icon" href="../../../assets/images/logoIcon/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Author - Dashboard">
    
    <meta itemprop="name" content="Author - Dashboard">
    <meta itemprop="description" content="asfiresearchjournal">
    <meta itemprop="image" content="../../../assets/images/seo/65be1258275121706955352.png">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="ASFIRJ">
    <meta property="og:description" content="asfiresearchjournal">
    <meta property="og:image" content="../../../assets/images/seo/65be1258275121706955352.png"/>
    <meta property="og:image:type" content="png"/>
    <meta property="og:image:width" content="1180" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="../../../dashboard">
    
    <meta name="twitter:card" content="summary_large_image">
    <!-- Bootstrap CSS -->
    <link href="../../../assets/global/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="../../css/bootstrap.css" rel="stylesheet">
      
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet"> -->

    <link href="../../../assets/global/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../assets/global/css/line-awesome.min.css" />

    <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/main.css">

    <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/custom.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    
    
    <!-- <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/color.php?color=EB4830&secondColor="> -->
    <link rel="stylesheet" href="../../../front/public/css/header.css">
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>

<body>
    
    <div class="preloader">
        <div class="loader-p"></div>
    </div>

    <div class="body-overlay"></div>

    <div class="sidebar-overlay"></div>

    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    <div class="dashboard-fluid position-relative">
        <div class="dashboard-header">

            <div class="dashboard-header__inner">
                
                <div class="dashboard-header__left">
                    <a href="" class="sidebar-logo__link"> <img src="../../../assets/images/logoIcon/logo.png" alt="site-logo"></a>
                </div>
                <div class="dashboard-header__right">
                    <div class="user-info">
                        <div class="user-info__button">
                            <div class="user-info__info">
                                
                                <span class="fw-bold user_fullnameContainer">
                                 
                                </span>
        
                                <!-- <ul class="user-info-dropdown">
                                    <li class="user-info-dropdown__item"><a class="user-info-dropdown__link"
                                            href="../../user/profile-setting.html">Profile Setting</a></li>
                                    <li class="user-info-dropdown__item"><a class="user-info-dropdown__link"
                                            href="../../user/change-password.html">Change Password</a></li>
                                                                <li class="user-info-dropdown__item"><a class="user-info-dropdown__link"
                                            href="../../user/logout">Logout</a></li>
                                </ul>
                                <div class="user-info__content">
                                    <div class="d-flex justify-content-around">
                                        <span class="user-info__name" id="user_fullnameContainer"></span>
                                        <span><i class="las la-angle-down"></i></span>
                                    </div>
                                    <span class="user-info__link" id="user_emailContainer"> </span>
                                </div> -->
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-color: #310357;" id="navbarContainer">
             
            </div>
        <div class="dashboard__inner">
            <div class="sidebar-menu" id="userMenu">
                <div class="submission-header-dash" style="margin-top: 30px;">
                    <div style="text-align: center;"><span class="fw-bold" style="color: #404040;">Author Dashboard</span></div>
                    
                    
                    <ul class="submit-nav">
                        <a href="../manuscripts/"><li>   <span class="newSubmissionsCount">0</span> Submitted Manuscripts</li></a>
                        <a href="../coauth/"><li> <span class="coAuhtoredCount">0</span> Manuscripts I Have Co-Authored</li></a>
                        <a href="../submit/"><li>Submit New Manuscript</li></a>
                        <a href="" ><li style="background-color: #320359;"> <span class="inReviewCount">0</span> Manuscripts With Decisions</li></a>
                        <a href="../../../portal/logout/"><li>Logout</li></a>
                        
                    </ul>
                </div>
            </div>
            <!-- ========= Sidebar Menu End ================ -->
            <div class="dashboard__right">
                

<div class="dashboard-body__bar d-xl-none d-block mt-2 text-end">
    <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
</div>
                <div class="dashboard-body">
                    <section class="mt-3 mb-60">
        <div class="row justify-content-center mb-3">
    

        <div class="row gy-2 justify-content-center">
            <span style="font-size: 35px; color: #310357;">Manuscripts With Descisions</span>
            <div class="table_container">
                <table id="table-dash" class="">
                    <thead>
                        <tr class="section-title">
                            <th>Status</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody id="manuscriptsContainer">
                        <!-- <tr id="queue_0" name="queue_0" role="row" class="odd">
                          <td id="action">
                            <br>            
                        </td>          
               <td data-label="status">              
                        <div>
                            <p>
                                <a role="link" tabindex="0" data-title="test" id="contactJournalLnk" data-abstract="test" data-id="xik_HqzhLis2ey4NyZxowgCdfEwB7DoB64Umc9Bp7CgUjXzc" data-documentno="thoraxjnl-2020-215540.R2" data-toggle="modal" href="#contactJournal" onclick="" data-inviteemail="0" hidefocus="true" style="outline: none;"><i class="fa fa-envelope-o"></i> Contact Journal</a>
                            </p>
                        </div>
                        <ul>
                            <li>EPA: Bright Nwaru, Eman Soph</li>
                            <li>Minor revision (11-Sep-2024)</li>
                            <li>a revision has been submitted</li>
                            <li><i>Archiving completed on 10-Oct-2024</i></li>
                        </ul>
              
                      <br>
                         <a role="link" tabindex="0" href="" hidefocus="true" style="outline: none;">  
                             view decision letter
                         </a>    
                        
                    </td>
        
                    <td data-label="ID">ASFIRJ-2024-215540.R2
                    
                    </td>
                                          
                    <td data-label="title" style="white-space:pre-wrap">Does use of hormonal contraceptives impact on severe exacerbation in women with asthma? A 17-year population-based cohort study<br><em>Files Archived</em> <i class="fa fa-question-circle" data-content="The Journal has elected to delete the files associated with the draft revision/resubmission of this manuscript. In order to continue, you must click the &quot;create revision/resubmission&quot;" data-original-title="Files Archived" data-toggle="popover" style="font-size:small; vertical-align:middle;"></i>
                   
             </td>
                    <td class="whitespace-nowrap" data-label="submitted">21-Sep-2024
                    </td>
                    <td data-label="decisioned" class="whitespace-nowrap">25-Sep-2024</td>
               </tr> -->
            
                    </tbody>
                    
                </table>

            </div>
            

        </div>

       
        

        
    </section>
                </div>
            </div>
        </div>
    </div>
<div id="google_translate_element"></div>
        
    <script src="../../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>
<script type="module" src="../../../js/dashboards/inReview.js?v=<?= time(); ?>"></script>
            <script>
        'use strict';
        (function($) {
                    })(jQuery);
    </script>

    
    <link rel="stylesheet" href="../../../assets/global/css/iziToast.min.css">
<script src="../../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>



    <script src="../../../assets/global/js/firebase/firebase-8.3.2.js?v=<?= time(); ?>"></script>


    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "../change/" + $(this).val();
            });

            $('.policy').on('click', function() {
                $.get('../cookie/accept', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

        })(jQuery);
    </script>
      <script type="module" src="../../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
    
</body>

</html>