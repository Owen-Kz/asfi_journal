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
  <meta property="og:image" content="../../../assets/images/seo/65be1258275121706955352.png" />
  <meta property="og:image:type" content="png" />
  <meta property="og:image:width" content="1180" />
  <meta property="og:image:height" content="600" />
  <meta property="og:url" content="../../dashboard">

  <meta name="twitter:card" content="summary_large_image">
  <!-- Bootstrap CSS -->
  <link href="../../../assets/global/css/bootstrap.min.css" rel="stylesheet">

  <link href="../../../assets/global/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../../assets/global/css/line-awesome.min.css" />

  <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/main.css">

  <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/custom.css">
  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">



  <!-- <link rel="stylesheet" href="../../../assets/templates/metro_hyip/css/color.php?color=EB4830&secondColor="> -->
  <link rel="stylesheet" href="../../../front/public/css/header.css">
  <link rel="stylesheet" href="../../../front/public/css/loader.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js?v=<?= time(); ?>"></script>

  <script src="../../../js/forms/headerMessages.js?v=<?= time(); ?>"> </script>

  <script src="../../../js/forms/submissionHeader.js?v=<?= time(); ?>"> </script>
  <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <style>
    
.popup {
    position: fixed;
    top: 30%; /* Adjust top spacing as needed */
    right: 20px; /* Adjust right spacing as needed */
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    opacity: 0;
    outline: none;
    border: none;
    z-index: 9999999;
    transition: opacity 0.3s ease-in-out;
}

.popup.show {
    opacity: 1;
}

.popup.hidden {
    display: none;
}

@keyframes slideIn {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(0);
    }
}

.popup.slide-in {
    animation: slideIn 0.3s forwards;
}


.errorpopup {
    position: fixed;
    top: 30%; /* Adjust top spacing as needed */
    right: 20px; /* Adjust right spacing as needed */
    padding: 10px 20px;
    background-color: #e22424;
    color: white;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    opacity: 0;
    outline: none;
    border: none;
    z-index: 9999999;
    transition: opacity 0.3s ease-in-out;
}

.errorpopup.show {
    opacity: 1;
}

.errorpopup.hidden {
    display: none;
}

@keyframes slideIn {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(0);
    }
}

.errorpopup.slide-in {
    animation: slideIn 0.3s forwards;
}
  </style>
</head>

<body id="formNotSubmitted" style="color:black;">

  <div class="preloader">
    <div class="loader-p"></div>
  </div>
  <div class="overlayX">
    <div class="spinn"></div>
    <div style="font-weight: bold; color:black">Uploading Documents...please wait...</div>
  </div>
  <div id="progressSavedPopup" class="popup hidden">
    Progress has been saved!
</div>
<div id="errorPopup" class="errorpopup hidden">
  
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
              <a href="../manuscripts/">
                <li>    <span class="newSubmissionsCount">0</span> Submitted Manuscripts</li></a>
              <a href="../coauth/">
                <li>  <span class="coAuhtoredCount">0</span> Manuscripts I Have Co-Authored</li></a>
              <a href="../submit/">
                <li> Submit New Manuscript</li>
              </a>
              <a href="../inreview/">
                <li> <span class="inReviewCount">0</span> Manuscripts With Decisions</li></a>
              </a>
              <li class="active">Submit Edit
                <ul class="submit-nav" id="sectionNav">
                  <a href="javascript:void(0)" id="article_type_nav">
                    <li> <i class="material-icons">lock</i>Article Type</li>
                  </a>
                  <a href="javascript:void(0)" id="upload_manuscript_nav">
                    <li><i class="material-icons">lock</i>Upload Manuscript</li>
                  </a>
                  <a href="javascript:void(0)" id="title_nav">
                    <li><i class="material-icons">lock</i>Title</li>
                  </a>
                  <a href="javascript:void(0)" id="abstract_nav">
                    <li><i class="material-icons">lock</i>Abstract</li>
                  </a>
                  <a href="javascript:void(0)" id="keywords_nav" onclick="NavigationNext('keywords', 'keywords_nav', 'author_information_nav', 4)">
                    <li><i class="material-icons">lock</i>Keywords</li>
                  </a>
                  <a href="javascript:void(0)" id="author_information_nav">
                    <li><i class="material-icons">lock</i>Authors</li>
                  </a>
                  <a href="javascript:void(0)" id="suggest_reviewers_nav" onclick="NavigationNext('suggest-reviewers', 'suggest_reviewers_nav', 'disclosures_nav', 6)">
                    <li><i class="material-icons">lock</i>Suggest Reviewers</li>
                  </a>
                  <a href="javascript:void(0)" id="disclosures_nav" onclick="NavigationNext('disclosures', 'disclosures_nav', 'review_submit_nav', 7)">
                    <li><i class="material-icons">lock</i>Disclosures</li>
                  </a>
                  <a href="javascript:void(0)" id="review_submit_nav">
                    <li><i class="material-icons">lock</i>Review & Submit</li>
                  </a>

                </ul>
              </li>

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
              <div class="row gy-2 justify-content-center">

                <div class="submit-container">
                  <div class="submit-body">
                    <div class="submit-start" id="headerMessage">


                    </div>


                    <form id="uploadForm">
                      <div class="message" id="message_container">
                      </div>
                      <div id="article-type" class="form-section">
                        <!-- Manuscript ID  -->
                        <input type="hidden" id="manuscript_id" name="manuscript_id">
                        <!-- End Manuscrupt Id  -->
                        <h3 class="manu_head">Article Type & Discipline</h3>
                        <span class="manu_head">Choose Article Type:</span>

                        <select name="article_type" id="article_type" class="form-control">
                          <option value="">Select an Option</option>
                          <option value="Original Article">Original Article</option>
                          <option value="Review">Narrative Review</option>
                          <option value="Systematic Review">Systematic Review</option>
                          <option value="Letter to Editor">Letter to Editor</option>
                          <option value="Editorial">Editorial</option>
                          <option value="Commentary">Commentary</option>
                          <option value="Protocol">Protocol</option>
                          <option value="Perspectives"> Perspectives</option>
                          <option value="Data">Data</option>
                          <option value="Opinion">Opinion</option>
                          <option value="Learning Corner">Learning Corner</option>
                          <option value="Field Story">Field Story</option>
                          <option value="Insight">Insight</option>
                           <option value="Correspondence">Correspondence</option>
                        </select>
                        <label for="discipline">Discipline</label>
                        <select id="discipline" name="discipline" class="form-control">
                          <option value="">Select a Discipline</option>
                          <option value="Agricultural sciences">Agricultural sciences</option>
                          <option value="Allied Health Sciences">Allied Health Sciences</option>
                          <option value="Anthropology">Anthropology</option>
                          <option value="Arts">Arts</option>
                          <option value="Biology">Biology</option>
                          <option value="Chemistry">Chemistry</option>
                          <option value="Climate Change">Climate Change</option>
                          <option value="Computer and Information Sciences">Computer and Information Sciences</option>
                          <option value="Earth Sciences">Earth Sciences</option>
                          <option value="Engineering and Technology">Engineering and Technology</option>
                          <option value="Environmental Sciences">Environmental Sciences</option>
                          <option value="Epidemiology">Epidemiology</option>
                          <option value="Humanities">Humanities</option>
                          <option value="Leadership and Management">Leadership and Management</option>
                          <option value="Life Sciences">Life Sciences</option>
                          <option value="Materials Science">Materials Science</option>
                          <option value="Mathematics">Mathematics</option>
                          <option value="Medicine">Medicine</option>
                          <option value="Physics and Astronomy">Physics and Astronomy</option>
                          <option value="Politics">Politics</option>
                          <option value="Public & Global Health">Public & Global Health</option>
                          <option value="Social and Behavioral Sciences">Social and Behavioral Sciences</option>
                          <option value="Statistics">Statistics</option>
                          <option value="Theology">Theology</option>
                          <option value="Other">Other (please specify)</option>
                        </select>

                        
                         <label for="">Has this manuscript been submitted previously to ASFIRJ?</label> <br>
Yes <input type="radio" name="prevsub" id="prevsub_yes" onclick="toggleInputField()"> <br>
No <input type="radio" name="prevsub" id="prevsub_no" onclick="toggleInputField()"> <br>

<div id="manuscriptIDField" style="display: none;">
    <label for="">Please provide the manuscript ID</label>
    <input type="text" name="previous_id" id="" class="form-control"> <br>
</div> 

                        <div id="disciplineContainer"></div>
                        <button type="button" class="submit-next nextManuscript" onclick="showNext('upload-manuscript', 'article-type', 'article_type_nav', 'upload_manuscript_nav', 0, 1)" disabled>Save & Continue</button>




                      </div>

                      <div id="upload-manuscript" class="form-section hidden">
                        <h3 class="manu_head">Upload Manuscript Files</h3> <br>

                        <div id="manuscriptFileContainer">
                          <label for="">Main Manuscript File:</label>
                          <input type="file" class="form-control" name="manuscript_file">
                        </div>

                        <div id="coverLetterContainer">
                          <label for="">Cover Letter:</label>
                          <input type="file" class="form-control" name="cover_letter">
                        </div>

                        <div id="tablesContainer">
                          <label for="">Tables:</label>
                          <input type="file" class="form-control" name="tables">
                        </div>

                        <div id="figuresContainer">
                          <label for="">Figuresx:</label>
                          <input type="file" class="form-control" name="figures">
                        </div>

                        <div id="supplementaryMaterialContainer">
                          <label for="">Supplementary Material:</label>
                          <input type="file" class="form-control" name="supplementary_materials">
                        </div>

                        <div id="graphicAbstractContainer">
                          <label for="">Point-by-Point Response to Reviewers (for revised manuscripts):</label>
                          <input type="file" class="form-control" name="graphic_abstract">
                        </div>
                        <div id="trackedRevisedmanuscriptContainer">
                          <label for="">Main Manuscript File with Tracked Changes (for revised manuscripts):</label>
                          <input type="file" class="form-control" name="tracked_revisedmanuscript_file">
                        </div> <br>


                        <div style="display: flex; justify-content: space-around;">
                          <!-- back button  -->
                          <button type="button" class="submit-next" onclick="NavigationNext('article-type', 'article_type_nav','upload_manuscript_nav',0)">Back</button>
                          <!-- end back button  -->
                          
                          <!-- next button  -->
                          <button type="button" class="submit-next nextManuscript" onclick="checkRequiredFiles()">Save & Continue</button>
                          <!-- end next button  -->
                        </div>

                      </div>



                      <div id="title" class="form-section hidden">
                        <b style="text-align: center;">Manuscript Title</b>
                        <input type="text" class="form-control" placeholder="Full Title" name="manuscript_full_title" id="manuscript_full_title"> <br>

                        <div style="display: flex; justify-content: space-around;">
                          <!-- back button  -->
                          <button type="button" class="submit-next" onclick="NavigationNext('upload-manuscript', 'upload_manuscript_nav', 'title_nav',1)">Back</button>
                          <!-- end back button  -->

                          <!-- next button  -->
                          <button type="button" class="submit-next nextManuscript" onclick="showNext('abstract', 'title', 'title_nav', 'abstract_nav', 'upload-manuscript', 3,3)" >Save & Continue</button>
                          <!-- end next button  -->
                        </div>

                      </div>


                      <div id="abstract" class="form-section hidden">
                        <div>

                          <h3 class="manu_head">Abstract</h3><br>

                          <!-- Main toolbar -->
                          <div class="bg-body border rounded-bottom h-400px overflow-hidden quill-editor" id="quilleditor" style="height: 500px;">
                          </div>
                          <div id="word-count" class="wordCount"></div><span id="limit-exceed"> </span>
                        </div> <br>



                        <div style="display: flex; justify-content: space-around;">
                          <!-- back button  -->
                          <button type="button" class="submit-next" onclick="NavigationNext('title', 'title_nav', 'abstract_nav', 2)">Back</button>
                          <!-- end back button  -->

                          <!-- next button  -->
                          <button type="button" class="submit-next nextManuscript" onclick="showNext('keywords', 'abstract', 'abstract_nav', 'keywords_nav', 'title', 4,4)" >Save & Continue</button>
                          <!-- end next button  -->
                        </div>
                      </div>

                      <div id="keywords" class="form-section hidden">
                        <h3 class="manu-head">Keywords</h3>
                        <div>
                          <label for="">Keyword 1</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 2</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 3</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 4</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 5</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 6</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 7</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div>
                          <label for="">Keyword 8</label>
                          <input type="text" class="form-control keyword-input" name="keyword[]">
                        </div>
                        <div style="display: flex; justify-content: space-around;">
                          <!-- back button  -->
                          <button type="button" class="submit-next" onclick="NavigationNext('abstract', 'abstract_nav', 'keywords_nav', 3)">Back</button>
                          <!-- end back button  -->

                          <!-- next button  -->
                          <button type="button" class="submit-next nextManuscript" id="nextButton" >Save & Continue</button>
                          <!-- end next button  -->
                        </div>
                    </div>

                    <div id="author-information" class="form-section hidden">
                      <h3 class="manu_head">Author's Information</h3>

                      <div id="addAuthor" style="width: 100%;">
                        <div class="authorinfoContainer">
                          <div class="authorname">
                            <div style="margin-right: 10px;">
                              <label for="prefix">Prefix:</label>
                              <input name="loggedIn_authors_prefix" class="form-control hd" id="author_information_prefix" readonly />
                            </div>

                            <div style="margin-right: 10px;">
                              <label for="">First Name:</label>
                              <input type="text" class="form-control hd" placeholder="First Name..." name="loggedIn_authors_first_name" id="loggedIn_firstname" readonly>
                            </div>
                              <!-- <div style="display: flex;"> -->
                            <div style="margin-right: 10px;">
                                    <label for="">MiddleName:</label>
                                      <input type="text" class="form-control" placeholder="Middle name" name="loggedIn_authors_other_name" id="loggedIn_othername" readonly>
                                    <!-- </div> -->
                            </div>
                            <div style="margin-right: 10px;">
                                <label for="">Last Name:</label>
                                <input type="text" class="form-control hd" placeholder="Last Name..." name="loggedIn_authors_last_name" id="loggedIn_lastname" readonly>
                            </div>
                          </div>  
                          
                          <div class="authorinfo">
                            <div style="margin-right: 10px;">
                                <label for="">ORCID ID”:</label>
                                <input type="text" class="form-control hd orcidID" placeholder="ORCID ID..." name="loggedIn_authors_ORCID" id="loggedIn_orcid">
                            </div>
                        

                            <div style="margin-right: 10px;">
                              <label for="">Affiliation(s):</label>
                              <input type="text" class="form-control hd" placeholder="Affiliation..." name="loggedIn_affiliation" id="loggedIn_affiliation" readonly>
                          </div>
                          <div style="margin-right: 10px;">
                            <label for="">City:</label>
                            <input type="text" class="form-control hd" placeholder="City..." name="loggedIn_affiliation_city" id="loggedIn_affiliation_city"  readonly>
                          </div>
                          <div style="margin-right: 10px;">
                            <label for="">Country:</label>
                            <input type="text" class="form-control" placeholder="Country..." name="loggedIn_affiliation_country" id="loggedIn_affiliation_country" readonly>
                          </div>
                        </div>
                        <div>
                          <label for="">Email:</label>
                          <input type="email" class="form-control hd" placeholder="Email..." name="loggedIn_author" id="logged_email" readonly>
                        </div>
                        <div>
                          <label for="">ASFI Membership ID:</label>
                          <input type="text" class="form-control hd" placeholder="Membership ID..." name="membership_id[]" >
                        </div>
                          <div>
                              <label for="">Corresponding Author's Email:</label>
                              <input type="email" class="form-control hd" placeholder="Corresponding Author Email..." name="corresponding_author" id="loggedIn_email">
                          </div>
                        </div>
                         <br>
                      </div>
                        
                          <div class="addauthorSearch">
                            <span>Add Author:</span><input type="search" placeholder="Enter Email of Author..." class="search-space" id="authorSearch">
                            <button type="button" class="add-author-btn" id="searchAuthor">
                              <span class="searchText">Search</span><span class="searchloader"></span>
                            </button>
                          </div>
                       
                         <br>

                        <div style="display: flex; justify-content: space-around;">
                          <!-- back button  -->
                          <button type="button" class="submit-next" onclick="NavigationNext('keywords', 'keywords_nav','author_information_nav', 4)">Back</button>
                          <!-- end back button  -->

                          <!-- next button  -->
                          <button type="button" class="submit-next nextManuscript" onclick="showNext('suggest-reviewers', 'author-information', 'author_information_nav', 'suggest_reviewers_nav', 'keywords', 6,6)" >Save & Continue</button>
                          <!-- end next button  -->
                        </div>  
                    </div>

                    <div id="suggest-reviewers" class="form-section hidden">
                      <h3 class="manu_head">Suggest Reviewers</h3>
                      <div id="suggestReviewer" style="width: 100%; overflow-x: scroll; margin-bottom: 10px; padding-bottom: 20px;">
                    
                   
               
             
                      </div>


                      <div style="display: flex; justify-content: space-around;">
                        <!-- back button  -->
                        <button type="button" class="submit-next" onclick="NavigationNext('author-information', 'author_information_nav','suggest_reviewers_nav', 5)">Back</button>
                        <!-- end back button  -->

                        <!-- next button  -->
                        <button type="button" class="submit-next nextManuscript" id="suggestNextButton" >Save & Continue</button>
                        <!-- end next button  -->
                      </div>

                    </div>

                    <div class="form-section hidden" id="disclosures">


                      <h3 class="manu_head">Disclosures</h3><br>

                      <!-- Main toolbar -->
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id=""><span>I confirm that the manuscript has been submitted solely to ASFIRJ and is not published, in press,
                          or submitted elsewhere, with exception of submission to preprint servers.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name=""><span>I am aware that ASFIRJ requires that all authors disclose all potential sources of conflict of
                          interest in regarding the submitted manuscript and I confirm that all authors have done so.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id=""><span>I confirm that the research that yielded the manuscript being submitted meets the ethical
                          guidelines and adheres to all legal research requirements of the study country.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id=""><span>I have prepared my manuscript and files, including text, tables, and figures, in accordance with
                          ASFIRJ’s style and formatting requirements as described at: <a href="https://asfirj.org/authors.html" style="color: blueviolet;">asfirj.org/authors.html</a>.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id=""><span>I confirm that each of the co-authors acknowledges their participation in the research that yielded
                          the manuscript being submitted and agrees to the submission of the manuscript to ASFIRJ.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id=""><span>I confirm that the contributions each author made to the manuscript are specified in the authors’
                          contribution section of the manuscript.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id=""><span>I confirm that the manuscript being submitted and the data it contains are unpublished and
                          original.</span>
                      </div>
                      <div class="bg-body border rounded-bottom">
                        <input type="checkbox" class="disclosure-checkbox" name="" id="disclosure_confirm"><span>I confirm that I am willing to pay ASFIRJ’s APC for the submitted manuscript if it is accepted for
                          publication in the journal as indicated at <a href="https://asfirj.org/aboutus.html" style="color:blueviolet;">asfirj.org/aboutus.html</a>.</span>
                      </div>
                      <br>


                      <div style="display: flex; justify-content: space-around;">
                         <!-- back button  -->
                         <button type="button" class="submit-next" onclick="NavigationNext('suggest-reviewers', 'suggest_reviewers_nav', 'disclosures_nav', 6)">Back</button>
                         <!-- end back button  -->

                        <!-- next button  -->
                        <button type="button" class="submit-next" style="width: 30%; padding: 10px;" onclick="reviewAll(8)">Review & Submit</button>
                        <!-- end next button  -->
                      </div>


                        <input type="hidden" name="review_status">
                        <input type="submit" id="submitForm" hidden>
                      
                       <div style="display: flex; justify-content: space-between;">
                        <button type="button" name="review_stat" style="margin: 20px; background-color: blueviolet; border: none; padding: 15px 20px 15px 20px; border-radius: 8px; color: white; font-weight: bold; text-align: center;" onclick="setStatus('saved_for_later')" hidden> 
                          Save For Later 
                      </button> 
                      <button style="border: none; background-color: transparent;">or</button>
                      <button type="button" name="review_stat" style="margin: 20px; background-color: blueviolet; border: none; padding: 15px 20px 15px 20px; border-radius: 8px; color: white; font-weight: bold;" onclick="setStatus('submitted')" hidden>
                          Submit
                      </button>
                       </div>
                        

                        
                        
                 
                      </div>




                    </form>
                  </div>
                </div>


              </div>



            </section>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal -->
<div id="myModal" class="addauthormodal">

  <!-- Modal content -->
  <div class="addauthormodal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <form id="authorForm">
   
    </form>
  </div>

</div>

<div id="google_translate_element"></div>

    <script src="../../../assets/global/js/jquery-3.6.0.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/global/js/bootstrap.bundle.min.js?v=<?= time(); ?>"></script>
    <script src="../../../assets/templates/metro_hyip/js/main.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/forms/addAuthorForModal.js?v=<?= time(); ?>"></script>

    <script>
      'use strict';
      (function($) {})(jQuery);
    </script>


    <link rel="stylesheet" href="../../../assets/global/css/iziToast.min.css">
    <script src="../../../assets/global/js/iziToast.min.js?v=<?= time(); ?>"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>

    <script type="module" src="../../../js/forms/quill.js"></script>
    <script>
function toggleInputField() {
    var manuscriptIDField = document.getElementById("manuscriptIDField");
    var isYesChecked = document.getElementById("prevsub_yes").checked;
    
    // Show the input field if "Yes" is selected, hide otherwise
    manuscriptIDField.style.display = isYesChecked ? "block" : "none";
}
</script>
    <script>
      const authorsArray = document.getElementById("authorsArray")
      var app = new Vue({
        el: '#app',
        data: {
          keywords: [],
          saisie: "",
        },
        methods: {
          removeFromArray: function(index) {

            authorsArray.value.split(",").filter(x => {

            });

            this.keywords.splice(index, 1);
            this.saisie = this.keywords;
          },
        },
        watch: {
          saisie: function() {
            this.keywords = this.saisie.split(",").filter(x => {
              return x.trim() != '';
            });
          }
        }
      });
      // Initialize SortableJS
document.addEventListener('DOMContentLoaded', function() {
    var sortable = new Sortable(document.getElementById('suggestReviewer'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        handle: '.drag-handle'
    });
});
    </script>
      <script>
        // Get the modal
      var modal = document.getElementById('myModal');
    
    // Function to open the modal
    function openModal() {
      modal.style.display = "block";
    }
    
    // Function to close the modal
    function closeModal() {
      modal.style.display = "none";
    }
    
    
    
      // Close the modal after submission (optional)
      closeModal();
        </script>

    <script src="../../../js/forms/updateDraft.js?v=<?= time(); ?>" type="module"></script>

    <script src="../../../js/forms/checkField.js?v=<?= time(); ?>" type="module"></script>
    <script type="module" src="../../../js/dashboards/author.js?v=<?= time(); ?>"></script>
    <script type="module" src="../../../js/dashboards/countItems.js?v=<?= time(); ?>"></script>
</body>

</html>