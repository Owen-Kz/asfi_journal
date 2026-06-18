<div class="w-full  px-4">
    <div class="journal-sidebar space-y-6">
        <!-- Announcements Button -->
        <div>
            <a href="#" class="block">
                <button class="w-full h-12 bg-[#80078b] text-white text-sm font-medium rounded-lg hover:bg-[#6a0674] transition-colors duration-200 cursor-pointer border-none flex items-center justify-center gap-2">
                    <i class="fas fa-bell"></i> Announcements
                </button>
            </a>
        </div>

        <!-- Announcement Container -->
        <div id="announcement-container"></div>

        <!-- Submit Manuscript Button -->
        <div>
            <a href="/portal" class="block">
                <button class="w-full h-14 bg-[#80078b] text-white text-lg font-medium rounded-lg hover:bg-[#6a0674] transition-colors duration-200 cursor-pointer border-none flex items-center justify-center gap-2">
                    <i class="fas fa-book"></i> Submit Manuscript
                </button>
            </a>
        </div>

        <!-- Society Logo -->
        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-600 text-center mb-3">Official journal of the African Science Frontiers Initiatives (ASFI)</p>
            <a href="https://africansciencefrontiers.com/" target="_blank" class="block text-center">
                <img class="w-3/4 mx-auto" alt="ASFI Logo" src="https://africansciencefrontiers.com/images/logo2.png">
            </a>
        </div>

        <!-- Prof. Nwaru's Career Corner Section -->
        <div class="bg-gradient-to-br from-[#f8f5fc] to-white rounded-xl p-4 border-l-4 border-[#ffbf00] shadow-sm">
            <div class="flex flex-col items-center gap-2.5 mb-4">
                <div class="w-10 h-10 bg-[#80078b] rounded-full flex items-center justify-center">
                    <i class="fas fa-briefcase text-[#ffbf00] text-xl"></i>
                </div>
                <h2 class="text-lg font-bold text-[#80078b] m-0">Prof. Nwaru's Career Corner</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4 leading-relaxed">Practical career advice, research tips, and professional development insights from Prof. Bright Nwaru.</p>

            <?php
            // Fetch the most recent Career Corner article
            $careerQuery = "SELECT buffer, is_old_publication, manuscript_full_title, manuscript_file, date_published, date_uploaded, manuscriptPhoto 
                           FROM journals 
                           WHERE is_publication = 'yes' 
                           AND (UPPER(article_type) = 'LEARNING CORNER' OR UPPER(article_type) = 'CAREER CORNER')
                           ORDER BY id DESC 
                           LIMIT 1";
            $careerResult = $con->query($careerQuery);

            if ($careerResult && $careerResult->num_rows > 0):
                $career = $careerResult->fetch_assoc();
                $careerTitle = htmlspecialchars($career['manuscript_full_title']);
                $careerBuffer = htmlspecialchars($career['buffer']);
                $careerPhoto = getCoverImage($career);
                $careerImageUrl = $careerPhoto;
                $careerDate = !empty($career['date_published']) ? $career['date_published'] : $career['date_uploaded'];
                $formattedDate = date("j M Y", strtotime($careerDate));
                ?>
                <div class="bg-white rounded-xl overflow-hidden mb-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <a href="/content?sid=<?php echo $careerBuffer; ?>">
                        <img src="<?php echo $careerImageUrl; ?>" alt="<?php echo $careerTitle; ?>" class="w-full h-[120px] object-cover">
                    </a>
                    <div class="p-3">
                        <span class="text-[10px] text-[#ffbf00] font-semibold uppercase"><?php echo $formattedDate; ?></span>
                        <h3 class="text-sm font-semibold mt-1 mb-2 leading-relaxed">
                            <a href="/content?sid=<?php echo $careerBuffer; ?>" class="text-gray-800 hover:text-[#80078b] transition-colors duration-200 no-underline">
                                <?php echo $careerTitle; ?>
                            </a>
                        </h3>
                        <a href="/content?sid=<?php echo $careerBuffer; ?>" class="text-xs text-[#80078b] font-medium no-underline hover:text-[#5a1f4e] transition-colors duration-200 inline-flex items-center gap-1">
                            Read More <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-xl p-4 text-center mb-4">
                    <i class="fas fa-newspaper text-3xl text-gray-300 mb-2"></i>
                    <p class="text-sm text-gray-400">New career tips coming soon!</p>
                </div>
            <?php endif; ?>

            <a href="./careercorner" class="flex items-center justify-center gap-2 bg-[#80078b] text-white no-underline py-2.5 px-4 rounded-lg text-sm font-semibold hover:bg-[#6a0674] transition-colors duration-200">
                <span>See More Career Resources</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Special Issues Section -->
        <div class="bg-gradient-to-br from-[#f8f5fc] to-white rounded-xl p-4 border-4 border-[#4a2b8a] shadow-sm">
            <div class="flex flex-col items-center gap-2.5 mb-4">
                <div class="w-10 h-10 bg-[#80078b] rounded-full flex items-center justify-center">
                    <i class="fas fa-briefcase text-[#ffbf00] text-xl"></i>
                </div>
                <h2 class="text-lg font-bold text-[#80078b] m-0">Special Issues</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4 leading-relaxed">Explore our latest special issues and exclusive content.</p>

            <?php
            // Fetch the most recent Special Issue article
            $specialQuery = "SELECT buffer, is_old_publication, manuscript_full_title, manuscript_file, date_published, date_uploaded, manuscriptPhoto 
                           FROM journals 
                           WHERE (UPPER(article_type) = 'SPECIAL ISSUE' OR is_special_issue = 'yes')
                           ORDER BY id DESC 
                           LIMIT 1";
            $specialResult = $con->query($specialQuery);

            if ($specialResult && $specialResult->num_rows > 0):
                $special = $specialResult->fetch_assoc();
                $specialTitle = htmlspecialchars($special['manuscript_full_title']);
                $specialBuffer = htmlspecialchars($special['buffer']);
                $specialPhoto = getCoverImage($special);
                $specialImageUrl = $specialPhoto;
                $specialDate = !empty($special['date_published']) ? $special['date_published'] : $special['date_uploaded'];
                $formattedDate = date("j M Y", strtotime($specialDate));
                ?>
                <div class="bg-white rounded-xl overflow-hidden mb-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <a href="/content?sid=<?php echo $specialBuffer; ?>">
                        <img src="<?php echo $specialImageUrl; ?>" alt="<?php echo $specialTitle; ?>" class="w-full h-[120px] object-cover">
                    </a>
                    <div class="p-3">
                        <span class="text-[10px] text-[#ffbf00] font-semibold uppercase"><?php echo $formattedDate; ?></span>
                        <h3 class="text-sm font-semibold mt-1 mb-2 leading-relaxed">
                            <a href="/content?sid=<?php echo $specialBuffer; ?>" class="text-gray-800 hover:text-[#80078b] transition-colors duration-200 no-underline">
                                <?php echo $specialTitle; ?>
                            </a>
                        </h3>
                        <a href="/content?sid=<?php echo $specialBuffer; ?>" class="text-xs text-[#80078b] font-medium no-underline hover:text-[#5a1f4e] transition-colors duration-200 inline-flex items-center gap-1">
                            Read More <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-xl p-4 text-center mb-4">
                    <i class="fas fa-newspaper text-3xl text-gray-300 mb-2"></i>
                    <p class="text-sm text-gray-400">More Special Issues Coming soon!</p>
                </div>
            <?php endif; ?>

            <a href="./special-issues" class="flex items-center justify-center gap-2 bg-[#80078b] text-white no-underline py-2.5 px-4 rounded-lg text-sm font-semibold hover:bg-[#6a0674] transition-colors duration-200">
                <span>See More Special Issues</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- ASFIRJ Theses Section -->
        <div class="bg-gradient-to-br from-[#f8f5fc] to-white rounded-xl p-4 border-l-4 border-[#6e1f75] shadow-sm">
            <div class="flex flex-col items-center gap-2.5 mb-4">
                <div class="w-10 h-10 bg-[#80078b] rounded-full flex items-center justify-center">
                    <i class="fas fa-briefcase text-[#ffbf00] text-xl"></i>
                </div>
                <h2 class="text-lg font-bold text-[#80078b] m-0">ASFIRJ Theses</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4 leading-relaxed">Where academic theses are permanently made visible, citable, thereby enhancing their impact to science and society.</p>

            <?php
            // Fetch the most recent Theses article
            $thesesQuery = "SELECT buffer, is_old_publication, manuscript_full_title, manuscript_file, date_published, date_uploaded, manuscriptPhoto 
                           FROM journals  
                           WHERE is_publication = 'yes' 
                           AND (UPPER(article_type) = 'ASFIRJ THESES' OR UPPER(article_type) = 'THESES') 
                           ORDER BY id DESC 
                           LIMIT 1";
            $thesesResult = $con->query($thesesQuery);

            if ($thesesResult && $thesesResult->num_rows > 0):
                $theses = $thesesResult->fetch_assoc();
                $thesesTitle = htmlspecialchars($theses['manuscript_full_title']);
                $thesesBuffer = htmlspecialchars($theses['buffer']);
                $thesesPhoto = getCoverImage($theses);
                $thesesImageUrl = $thesesPhoto;
                $thesesDate = !empty($theses['date_published']) ? $theses['date_published'] : $theses['date_uploaded'];
                $formattedDate = date("j M Y", strtotime($thesesDate));
                ?>
                <div class="bg-white rounded-xl overflow-hidden mb-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <a href="/content?sid=<?php echo $thesesBuffer; ?>">
                        <img src="<?php echo $thesesImageUrl; ?>" alt="<?php echo $thesesTitle; ?>" class="w-full h-[120px] object-cover">
                    </a>
                    <div class="p-3">
                        <span class="text-[10px] text-[#ffbf00] font-semibold uppercase"><?php echo $formattedDate; ?></span>
                        <h3 class="text-sm font-semibold mt-1 mb-2 leading-relaxed">
                            <a href="/content?sid=<?php echo $thesesBuffer; ?>" class="text-gray-800 hover:text-[#80078b] transition-colors duration-200 no-underline">
                                <?php echo $thesesTitle; ?>
                            </a>
                        </h3>
                        <a href="/content?sid=<?php echo $thesesBuffer; ?>" class="text-xs text-[#80078b] font-medium no-underline hover:text-[#5a1f4e] transition-colors duration-200 inline-flex items-center gap-1">
                            Read More <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-xl p-4 text-center mb-4">
                    <i class="fas fa-newspaper text-3xl text-gray-300 mb-2"></i>
                    <p class="text-sm text-gray-400">New theses coming soon!</p>
                </div>
            <?php endif; ?>

            <a href="./asfirj-theses" class="flex items-center justify-center gap-2 bg-[#80078b] text-white no-underline py-2.5 px-4 rounded-lg text-sm font-semibold hover:bg-[#6a0674] transition-colors duration-200">
                <span>See More Theses</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- Author Resources -->
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold text-[#80078b] mb-3">ASFIRJ Author Resources</h2>
            <div class="space-y-2 text-sm text-gray-600">
                <p class="text-sm text-gray-600 leading-relaxed mb-3">When preparing their submission, authors are encouraged to make use of the below resources which have been developed specifically for <em>Asfirj</em> authors.</p>
                <p><a href="./authors.html#ob" class="text-[#80078b] no-underline hover:text-[#5a1f4e] hover:underline transition-colors duration-200">a. What is the submission process?</a></p>
                <p><a href="./authors.html#sr" class="text-[#80078b] no-underline hover:text-[#5a1f4e] hover:underline transition-colors duration-200">b. How to revise a manuscript?</a></p>
                <p><a href="./authors.html#pp" class="text-[#80078b] no-underline hover:text-[#5a1f4e] hover:underline transition-colors duration-200">c. How to organize a manuscript?</a></p>
                <p><a href="./authors.html#fig" class="text-[#80078b] no-underline hover:text-[#5a1f4e] hover:underline transition-colors duration-200">d. Guidelines for specific manuscripts</a></p>
            </div>
        </div>

        <!-- More from this journal -->
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold text-[#80078b] mb-3">More from this journal</h2>
            <ul class="space-y-2.5 list-none p-0">
                <li><a href="./editors.html" class="text-[#80078b] no-underline hover:text-[#5a1f4e] hover:underline transition-colors duration-200 text-sm">Meet the Editors</a></li>
                <li><a href="https://asfischolar.org" target="_blank" class="text-[#80078b] no-underline hover:text-[#5a1f4e] hover:underline transition-colors duration-200 text-sm">ASFI Scholar</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    /* Additional hover effects for sidebar */
    .journal-sidebar .career-preview a:hover h3 {
        color: #80078b !important;
    }
    
    /* Smooth transitions for all interactive elements */
    .journal-sidebar a,
    .journal-sidebar button {
        transition: all 0.2s ease;
    }
    
    /* Ensure proper spacing in mobile */
    @media (max-width: 768px) {
        .journal-sidebar {
            margin-top: 2rem;
        }
    }
</style>