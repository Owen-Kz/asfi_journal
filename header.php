<!-- <?php include("includes/spam_detector.php"); ?> -->

<?php
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base_url = $scheme . '://' . $_SERVER['HTTP_HOST'] . '' ;
?>
<header class="header header-one">
    <div class="primary-header-one primary-header">
        <div class="container">
            <div class="primary-header-inner" style="display:flex; flex-direction:column; align-items: start;"
                style="display:flex; flex-direction:column; align-items: start;">
                <div class="header-logo show-logo">
                    <a href="https://asfirj.org/">
                        <img src="<?php echo $base_url; ?>/assets/images/logoIcon/logo.png" alt="Logo" /></a>
                </div><!-- /.header-logo -->



                <div class="header-menu-wrap" style="width: 100%;" style="width: 100%;">
                    <ul class="dl-menu ">
                        <!-- Menu Item -->
                        <li><a href="<?php echo $base_url; ?>/" class='menu-item'>Home</a></li>
                        <li><a href="<?php echo $base_url; ?>/aboutus.php" class='menu-item dropdown'>About</a>
                            <ul class="dropdown-menu aboutDropDown">
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#ASFI" class='menu-item'>
                                        African Science Frontiers Initiatives</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#aims" class='menu-item'>
                                        ASFIRJ's AIMS & SCOPE</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#values" class='menu-item'>
                                        ASFIRJ Values</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#prompt" class='menu-item'>
                                        Prompt Decisions and Rapid Publication Timelines</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#why-section" class='menu-item'>
                                        Why Publish in ASFIRJ?</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#open-access" class='menu-item'>
                                        Open Access and Author Licensing</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#indexing" class='menu-item'>Indexing</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#fees" class='menu-item'>Article Publication Fee</a>
                                </li>
                                <li><a href="<?php echo $base_url; ?>/aboutus.php#advert-policy" class='menu-item'>ASFIRJ Advertising Policy</a>
							</li>
                            		<li><a href="<?php echo $base_url; ?>/aboutus.php#archiving" class='menu-item'>Archiving and Digital Preservation</a>
							</li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class='menu-item'>Browse Issues</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $base_url; ?>/issues" class='menu-item'>Issues</a></li>
                                <li><a href="<?php echo $base_url; ?>/supplements" class='menu-item'>Supplements</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $base_url; ?>/editors.php" class='menu-item'>Meet The Editors</a></li>
                        <li class="dropdown">
                            <a href="#" class="menu-item">Authors / Reviewers</a>
                            <ul class="dropdown-menu">


                                <li><a href="<?php echo $base_url; ?>/authors.php" class='menu-item'>For Authors</a></li>
                                <li><a href="<?php echo $base_url; ?>/reviewers.php" class='menu-item'>For Reviewers</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="<?php echo $base_url; ?>/ethics.php" class="menu-item">Ethics and Malpractice Statement</a>
                            <ul class="dropdown-menu" style="max-height: 70vh; overflow-y: auto; min-width: 320px;">
                                <li><a href="<?php echo $base_url; ?>/ethics.php#commitment" class='menu-item'>Our commitment to publication ethics</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#publisher" class='menu-item'>Responsibilities of the Publisher</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#editor" class='menu-item'>Responsibilities of the Editor-in-Chief</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#authors" class='menu-item'>Responsibilities of Authors</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#authorship" class='menu-item'>Authorship and contributorship</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#originality" class='menu-item'>Originality, plagiarism and duplicate publication</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#fabrication" class='menu-item'>Fabrication and research misconduct</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#peer-review-ethics" class='menu-item'>Peer-review ethics</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#conflicts" class='menu-item'>Conflicts of interest</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#ethical-approval" class='menu-item'>Ethical approval</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#informed-consent" class='menu-item'>Informed consent and privacy</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#data-integrity" class='menu-item'>Data integrity and reproducibility</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#ai" class='menu-item'>Use of AI and AI-assisted technologies</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#citation" class='menu-item'>Citation ethics</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#editorial-independence" class='menu-item'>Editorial independence</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#complaints" class='menu-item'>Complaints and appeals</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#allegations" class='menu-item'>Allegations of misconduct</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#corrections" class='menu-item'>Corrections, retractions and expressions</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#post-publication" class='menu-item'>Post-publication concerns</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#whistleblowers" class='menu-item'>Protection of whistleblowers</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#confidentiality" class='menu-item'>Editorial and peer-review confidentiality</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#peer-review-malpractice" class='menu-item'>Malpractice in peer review</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#editorial-misconduct" class='menu-item'>Editorial misconduct</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#research-integrity" class='menu-item'>Research integrity beyond publication</a></li>
                                <li><a href="<?php echo $base_url; ?>/ethics.php#continuous-improvement" class='menu-item'>Commitment to continuous improvement</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo $base_url; ?>/special-issues" class='menu-item'>Special Issues</a></li>
                        <li><a href="<?php echo $base_url; ?>/theses.php" class='menu-item'>ASFIRJ Theses</a></li>

                    </ul>
                    <div class="header-right">
                        <a class="header-btn" href="/portal">
                            <p>Submit Manuscript</p>
                        </a>
                    </div>
                </div><!-- /.header-menu-wrap -->


                <!-- Burger menu -->
                <div class="mobile-menu-icon">
                    <div class="burger-menu">
                        <div class="line-menu line-half first-line"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu line-half last-line"></div>
                    </div>
                </div>
            </div><!-- /.header-right -->
        </div><!-- /.primary-header-one-inner -->
    </div>
    </div><!-- /.primary-header-one -->
</header><!-- /.header-one -->