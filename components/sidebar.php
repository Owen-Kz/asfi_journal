<div class="gutterless--xs gutterless--sm gutterless--md col-md-3">
    <div data-widget-def="ux3-layout-widget" data-widget-id="ee7a3430-1136-4dfb-922e-2ee614f121aa" class="journal-sidebar">
        <div>
            <div>
                <a href="">
                    <button style="background-color: #80078b; color: white; height: 50px; width: 100%; margin: auto; margin-top: 20px; font-size: 15px; border: none; border-radius: 8px; cursor: pointer;">
                        <i aria-hidden="true" class="fas fa-bell"></i> Announcements
                    </button>
                </a>
                <br><br>

                <!-- Announcement Container -->
                <div id="announcement-container"></div>
                <br>

                <div id="etoc-signup" role="status" aria-atomic="true" class="alert-sign-up">
                    <div class="alert-sign-up__box pb-0">
                        <i aria-hidden="true" class="fas fa-envelope"></i>
                        <h3>Sign up for email alerts</h3>
                    </div>
                    <div class="alert-sign-up__content form-content">
                        <div class="subscribe-form">
                            <form class="subscribe-form newsLetterForm" id="newsLetterForm">
                                <p class="form-instructions small">Enter your email to receive alerts when new articles and issues are published.</p>
                                <input class="form-control" style="border: 1px solid #ddd; color: #333; padding: 10px; width: 100%; border-radius: 6px;" type="email" name="email" placeholder="Email... " required id="subscribeEmail">
                                <button class="submit" style="background-color: #80078b; color: white; border: none; padding: 10px 15px; border-radius: 6px; margin-top: 10px; cursor: pointer;">Subscribe<i class="fas fa-paper-plane" style="margin-left: 8px;"></i></button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="journal-side-section journal-actions-container">
                <a href="/portal">
                    <button style="background-color: #80078b; color: white; height: 60px; width: 100%; margin: auto; margin-top: 20px; font-size: 20px; border: none; border-radius: 8px; cursor: pointer;">
                        <i aria-hidden="true" class="fas fa-book"></i> Submit Manuscript
                    </button>
                </a>
            </div>
            <br>

            <div data-widget-def="UX3HTMLWidget" data-widget-id="5e6f26aa-d597-4688-9154-94c250dbfcf6" class="card--bordered my-4 sidebar-society-logo">
                <div id="societyText">
                    <p>Official journal of the African Science Frontiers Initiatives (ASFI)</p>
                    <a href="https://africansciencefrontiers.com/" target="_blank">
                        <img style="width:80%" alt="null" src="https://africansciencefrontiers.com/images/logo2.png">
                    </a>
                </div>
            </div>

            <!-- Prof. Nwaru's Career Corner Section -->
            <div class="career-corner-section" style="margin: 20px 0; padding: 15px; background: linear-gradient(135deg, #f8f5fc 0%, #fff 100%); border-radius: 12px; border-left: 4px solid #ffbf00;">
                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; margin-bottom: 15px;">
                    <div style="width: 40px; height: 40px; background: #80078b; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-briefcase" style="color: #ffbf00; font-size: 20px;"></i>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700; color: #80078b; margin: 0;">Prof. Nwaru's Career Corner</h2>
                </div>
                <p style="font-size: 13px; color: #666; margin-bottom: 15px; line-height: 1.5;">Practical career advice, research tips, and professional development insights from Prof. Bright Nwaru.</p>
                
                <?php
                // Fetch the most recent Career Corner article (filter by Career Corner)
                // Remove is_old_publication column since it doesn't exist
                $careerQuery = "SELECT buffer, manuscript_full_title, manuscript_file, date_published, date_uploaded, manuscriptPhoto 
                               FROM journals 
                               WHERE is_publication = 'yes' 
                               AND article_type = 'LEARNING CORNER' 
                               ORDER BY id DESC 
                               LIMIT 1";
                $careerResult = $con->query($careerQuery);
                
                if ($careerResult && $careerResult->num_rows > 0):
                    $career = $careerResult->fetch_assoc();
                    $careerTitle = htmlspecialchars($career['manuscript_full_title']);
                    $careerBuffer = htmlspecialchars($career['buffer']);
                    
                    // Get cover image - simplified
                    $careerPhoto = $career['manuscriptPhoto'] ?? null;
                    if (!empty($careerPhoto)) {
                        $careerImage = "https://asfirj.org/useruploads/article_images/" . $careerPhoto;
                    } else {
                        $careerImage = "https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg";
                    }
                    
                    // Check if file exists on server, if not use default
                    $careerImageUrl = $careerImage;
                    
                    // Format date
                    $careerDate = !empty($career['date_published']) ? $career['date_published'] : $career['date_uploaded'];
                    $formattedDate = date("j M Y", strtotime($careerDate));
                ?>
                <div class="career-preview" style="background: white; border-radius: 10px; overflow: hidden; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <a href="/content?sid=<?php echo $careerBuffer; ?>">
                        <img src="<?php echo $careerImageUrl; ?>" alt="<?php echo $careerTitle; ?>" style="width: 100%; height: 120px; object-fit: cover;">
                    </a>
                    <div style="padding: 12px;">
                        <span style="font-size: 10px; color: #ffbf00; font-weight: 600; text-transform: uppercase;"><?php echo $formattedDate; ?></span>
                        <h3 style="font-size: 14px; font-weight: 600; margin: 5px 0 10px; line-height: 1.4;">
                            <a href="/content?sid=<?php echo $careerBuffer; ?>" style="color: #333; text-decoration: none; transition: color 0.2s;">
                                <?php echo $careerTitle; ?>
                            </a>
                        </h3>
                        <a href="/content?sid=<?php echo $careerBuffer; ?>" style="font-size: 12px; color: #80078b; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 5px;">
                            Read More <i class="fas fa-arrow-right" style="font-size: 10px;"></i>
                        </a>
                    </div>
                </div>
                <?php else: ?>
                <div class="career-preview" style="background: white; border-radius: 10px; padding: 15px; text-align: center; margin-bottom: 15px;">
                    <i class="fas fa-newspaper" style="font-size: 30px; color: #ccc; margin-bottom: 10px;"></i>
                    <p style="font-size: 13px; color: #999;">New career tips coming soon!</p>
                </div>
                <?php endif; ?>
                
                <a href="./careercorner" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #80078b; color: white; text-decoration: none; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 600; transition: all 0.2s;">
                    <span class="text-white">See More Career Resources</span>
                    <i class="fas fa-arrow-right text-white" style="font-size: 11px;"></i>
                </a>
            </div>

            <section data-widget-def="general-rich-text" data-widget-id="266c820e-8d8d-4461-b70a-ed001b1d9e7e" class="tabs--default-style">
                <h2 class="section__mainHeader--small" style="color: #80078b; font-size: 18px; font-weight: 600;">ASFIRJ Author Resources</h2>
                <div id="rich-text-266c820e-8d8d-4461-b70a-ed001b1d9e7e" class="pb-rich-text">
                    <p style="color: #555; font-size: 13px; line-height: 1.5;">When preparing their submission, authors are encouraged to make use of the below resources which have been developed specifically for&nbsp;<em>Asfirj&nbsp;</em>authors.&nbsp;</p>
                    <p><br>a. <a href="./authors.html#ob" style="color: #80078b; text-decoration: none;">What is the submission process?</a></p>
                    <p>b. <a href="./authors.html#sr" style="color: #80078b; text-decoration: none;">How to revise a manuscript?</a></p>
                    <p>c. <a href="./authors.html#pp" style="color: #80078b; text-decoration: none;">How to organize a manuscript?</a></p>
                    <p>d. <a href="./authors.html#fig" style="color: #80078b; text-decoration: none;">Guidelines for specific manuscripts</a></p>
                    <hr>
                </div>
            </section>

            <div data-widget-def="general-html-asset" data-widget-id="e4a898a9-7e70-47da-bc1a-640268219765" class="mt-4 mb-4">
                <div data-widget-def="UX3HTMLWidget" data-widget-id="56014d6b-bbc8-4ca7-ac51-490639ea3450" class="my-4">
                    <h2 class="section__mainHeader--small" style="color: #80078b; font-size: 18px; font-weight: 600;">More from this journal</h2>
                    <div class="journal-side-section journal-resources">
                        <ul class="unordered-bordered-list" style="list-style: none; padding-left: 0;">
                            <li style="margin-bottom: 10px;"><a href="./editors.html" style="color: #80078b; text-decoration: none;">Meet the Editors</a></li>
                            <li style="margin-bottom: 10px;"><a href="https://asfischolar.org" target="_blank" style="color: #80078b; text-decoration: none;">ASFI Scholar</a></li>
                            <!-- ASFIScholar image - clickable -->
                            <!-- <div class="DST-iframe-nojobs" style="margin: 10px 0;">
                                <a href="https://asfischolar.org" target="_blank">
                                    <img src="https://res.cloudinary.com/diml8ljwa/image/upload/v1775046499/WhatsApp_Image_2026-04-01_at_1.19.56_PM_1_rcq8ij.jpg" 
                                         alt="ASFIScholar" 
                                         style="width:100%; border-radius: 15px; transition: transform 0.2s ease; cursor: pointer;"
                                         onmouseover="this.style.transform='scale(1.02)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                </a>
                            </div> -->
                            <!-- <li style="margin-bottom: 10px;"><a href="https://africansciencefrontiers.com/" target="_blank" style="color: #80078b; text-decoration: none;">African Science Frontiers Initiatives</a></li> -->
                            <!-- ASFI image - clickable -->
                            <!-- <div class="DST-iframe-nojobs" style="margin: 10px 0;">
                                <a href="https://africansciencefrontiers.com/" target="_blank">
                                    <img src="https://res.cloudinary.com/diml8ljwa/image/upload/v1775046499/WhatsApp_Image_2026-04-01_at_1.19.56_PM_kfvxun.jpg" 
                                         alt="African Science Frontiers Initiatives" 
                                         style="width:100%; border-radius: 15px; transition: transform 0.2s ease; cursor: pointer;"
                                         onmouseover="this.style.transform='scale(1.02)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                </a>
                            </div> -->
                            <!-- <li style="margin-bottom: 10px;"><a href="https://asfischolar.net" target="_blank" style="color: #80078b; text-decoration: none;">ASFI Meet</a></li> -->
                            <!-- ASFIMeet image - clickable -->
                            <!-- <div class="DST-iframe-nojobs" style="margin: 10px 0;">
                                <a href="https://asfischolar.net" target="_blank">
                                    <img src="https://res.cloudinary.com/diml8ljwa/image/upload/v1775046499/WhatsApp_Image_2026-04-01_at_1.19.56_PM_2_mahwpn.jpg" 
                                         alt="ASFI Meet" 
                                         style="width:100%; border-radius: 15px; transition: transform 0.2s ease; cursor: pointer;"
                                         onmouseover="this.style.transform='scale(1.02)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                </a>
                            </div> -->
                            <!-- <li style="margin-bottom: 10px;"><a href="./event2.html" style="color: #80078b; text-decoration: none;">ASFI 2024 Virtual Multidisciplinary Conference & Boot Camp</a></li> -->
                            <!-- <div class="DST-iframe-nojobs" style="margin: 10px 0;">
                                <img src="./images/event2025.jpeg" alt="" style="width:100%; border-radius: 15px;">
                            </div> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Fix link colors in sidebar */
    .journal-sidebar a {
        color: #80078b !important;
        text-decoration: none !important;
        transition: color 0.2s ease;
    }
    
    .journal-sidebar a:hover {
        color: #5a1f4e !important;
        text-decoration: underline !important;
    }
    
    .journal-sidebar ul li a {
        color: #80078b !important;
    }
    
    .career-corner-section a {
        color: #80078b !important;
    }
    
    .career-corner-section a:hover {
        color: #5a1f4e !important;
    }
    
    /* Career corner hover effect */
    .career-preview a:hover h3 {
        color: #80078b !important;
    }
</style>