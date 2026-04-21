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
                        <li><a href="<?php echo $base_url; ?>/careercorner" class='menu-item'>Career Corner</a></li>
                        <!-- <li><a href="<?php echo $base_url; ?>/terms.php" class='menu-item'>Terms</a></li> -->
                        <li><a href="<?php echo $base_url; ?>/contact.php" class='menu-item'>Contact Us</a></li>

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