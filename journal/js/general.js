document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');
    const whyItems = document.querySelectorAll('.why-item');

    function checkSlide() {
        whyItems.forEach((whyItem, index) => {
            const slideInAt = (window.scrollY + window.innerHeight) - whyItem.clientHeight / 2;
            const whyItemBottom = whyItem.offsetTop + whyItem.clientHeight;
            const isHalfShown = slideInAt > whyItem.offsetTop;
            const isNotScrolledPast = window.scrollY < whyItemBottom;

            if (isHalfShown && isNotScrolledPast) {
                whyItem.style.opacity = '1';
                whyItem.style.transform = 'translateY(0)';
            }
        });
    }

    window.addEventListener('scroll', checkSlide);
});




let prevScrollpos = window.pageYOffset;

window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("header").style.top = "0"; /* Show the header when scrolling up */
    } else {
        document.getElementById("header").style.top = "-100%"; /* Hide the header when scrolling down */
    }
    prevScrollpos = currentScrollPos;
}


$(document).ready(function() {
    $(".mobile-menu-icon").click(function() {
        $(".mobile-body").css("display", "flex");

        // Toggle the 'active' class to change the icon to an "X"
        $(this).toggleClass('active');

        // Adjusted the positions to slide in and out from the right
        $(".mobile-menu-container").css("right", "0");
        $(".mobile-body").css("right", "0");
    });

    $(".mobile-menu-container").click(function(e) {
        if (e.target === this) {
            // Adjusted the positions to slide out to the right
            $(this).css("right", "-80%");
            $(".mobile-body").css("right", "-100%");

            // Remove the 'active' class to change the icon back to the burger
            $(".mobile-menu-icon").removeClass('active');

            // Used hide() instead of setting display to none
            $(".mobile-body").hide();
        }
    });

    $(".mobile-body").click(function(e) {
        if (e.target === this) {
            // Adjusted the positions to slide out to the right
            $(this).css("right", "-100%");

            // Remove the 'active' class to change the icon back to the burger
            $(".mobile-menu-icon").removeClass('active');

            // Used hide() instead of setting display to none
            $(this).hide();
        }
    });


    $(".close-mobile-menu").click(function(e) {
        if (e.target === this) {
            // Adjusted the positions to slide out to the right
            $(".mobile-body").css("right", "-100%");

            // Remove the 'active' class to change the icon back to the burger
            $(".mobile-menu-icon").removeClass('active');

            // Used hide() instead of setting display to none
            $(".mobile-body").hide();
        }
    });

});




// $(document).ready(function() {
//     var videoId = 'w5TynGMJ1SI?si=7eaWWsuXpH9xBiWz'; // Replace 'VIDEO_ID' with your actual YouTube video ID
//     var videoUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';

//     $(".play-button").click(function() {
//         // Show the video overlay
//         $(".video-overlay").show();

//         // Append the YouTube video iframe to the video container
//         $(".video-container").html("<iframe width='100%' height='300px' src='" + videoUrl + "' frameborder='0' allowfullscreen></iframe>");
//     });

//     // Close the video overlay when clicking outside the video
//     $(document).on('click', '.video-overlay', function(e) {
//         if (e.target !== this)
//             return;

//         $(".video-overlay").hide();
//         // Remove the YouTube video iframe from the video container
//         $(".video-container").html("");
//     });
// });




// document.addEventListener('DOMContentLoaded', function () {
//     const articlesWrapper = document.querySelector('.articles-wrapper');
//     const articles = document.querySelectorAll('.article-container');
//     const articleWidth = articles[0].offsetWidth;
//     let currentIndex = 0;

//     function slideTo(index) {
//         const newPosition = -index * articleWidth;
//         articlesWrapper.style.transform = `translateX(50px)`;
//         currentIndex = index;
//     }

//     function nextSlide() {
//         if (currentIndex < articles.length - 1) {
//             slideTo(currentIndex + 1);
//         }
//     }

//     function prevSlide() {
//         if (currentIndex > 0) {
//             slideTo(currentIndex - 1);
//         }
//     }

//     // Optional: Add event listeners for navigation buttons
//     const prevButton = document.getElementById('prevButton');
//     if (prevButton) {
//         prevButton.addEventListener('click', prevSlide);
//     }

//     const nextButton = document.getElementById('nextButton');
//     if (nextButton) {
//         nextButton.addEventListener('click', nextSlide);
//     }
// });



// document.addEventListener('DOMContentLoaded', function () {
//     const prevButton = document.getElementById('prevButton');
//     const nextButton = document.getElementById('nextButton');
//     const dots = document.querySelectorAll('.dot');

//     let slideIndex = 0;
//     function showSlides() {
//         // Hide all slides
//         const slides = document.querySelectorAll('.article-container');
//         slides.forEach((slide) => {
//             slide.style.display = 'none';
//             const newPosition = -index * articleWidth;
//             slide.style.transform = `translateX(${newPosition}px)`;
//         });

//         // Deactivate all dots
//         dots.forEach((dot) => {
//             dot.classList.remove('active');
//         });

//         // Increment slide index
//         slideIndex++;

//         // Reset slide index if it exceeds the number of slides
//         if (slideIndex > slides.length) {
//             slideIndex = 1;
//         }

//         // Show the current slide and activate the corresponding dot
//         slides[slideIndex - 1].style.display = 'flex';
//         dots[slideIndex - 1].classList.add('active');

//         // Call showSlides() again after 2 seconds
//         setTimeout(showSlides, 2000);
//     }

//     // Add event listeners for previous and next buttons
//     prevButton.addEventListener('click', function () {
//         slideIndex--;
//         showSlides();
//     });

//     nextButton.addEventListener('click', function () {
//         slideIndex++;
//         showSlides();
//     });

//     // Add event listeners for dots
//     dots.forEach((dot, index) => {
//         dot.addEventListener('click', function () {
//             slideIndex = index;
//             showSlides();
//         });
//     });

//     // Show the initial slide
//     showSlides();
// });



document.addEventListener("DOMContentLoaded", function() {
    const articles = document.querySelectorAll(".article-container");
    let currentArticle = 0;
    const totalArticles = articles.length;

    function showArticle(index) {
        // Hide all articles
        articles.forEach(article => {
            article.style.transform = `translateX(-${index * 100}%)`;
        });
    }

    function nextArticle() {
        currentArticle = (currentArticle + 1) % totalArticles;
        showArticle(currentArticle);
    }

    // Interval for automatic sliding
    const interval = setInterval(nextArticle, 8000); // Adjust the interval as needed

    // Pause the slideshow when mouse enters the carousel
    // const carousel = document.querySelector(".articles-wrapper");
    // carousel.addEventListener("mouseenter", () => {
    //     clearInterval(interval);
    // });

    // Resume the slideshow when mouse leaves the carousel
    // carousel.addEventListener("", () => {
    //     interval = setInterval(nextArticle, 6000); // Adjust the interval as needed
    // });

    // Show the initial article
    showArticle(currentArticle);
});





document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector('.recent-events-carousel');
    const items = document.querySelectorAll('.recent-events-items');
    const dotsContainer = document.querySelector('.recent-events-carousel-dots');
    let currentIndex = 0;
    let intervalId;

    // Function to move carousel
    function moveCarousel() {
        const itemWidth = items[0].offsetWidth;
        const offset = -currentIndex * (itemWidth + (itemWidth * 0.1));
        carousel.style.transform = `translateX(${offset}px)`;
    }

    // Function to create dots for navigation
    function createDots() {
        items.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.classList.add('recent-events-dot');
            if (index === currentIndex) dot.classList.add('active-recent-dot');
            dot.addEventListener('click', () => {
                slideTo(index);
            });
            dotsContainer.appendChild(dot);
        });
    }

    // Function to handle sliding
    function slideTo(index) {
        if (index < 0 || index >= items.length) return;
        currentIndex = index;
        moveCarousel();
        updateDots();
    }

    // Function to update active dot
    function updateDots() {
        const dots = document.querySelectorAll('.recent-events-dot');
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active-recent-dot');
            } else {
                dot.classList.remove('active-recent-dot');
            }
        });
    }

    // Function to automatically slide
    function autoSlide() {
        intervalId = setInterval(() => {
            slideTo(currentIndex + 1);
        }, 5000); // Change the time interval as needed (5000ms = 5 seconds)
    }

    // Stop auto sliding when mouse is over carousel
    carousel.addEventListener('mouseover', () => {
        clearInterval(intervalId);
    });

    // Resume auto sliding when mouse leaves carousel
    carousel.addEventListener('mouseleave', () => {
        autoSlide();
    });

    // Initial setup
    createDots();
    moveCarousel();
    autoSlide();

    // Listen for arrow key presses
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') {
            slideTo(currentIndex + 1);
        } else if (e.key === 'ArrowLeft') {
            slideTo(currentIndex - 1);
        }
    });
});



function setActive(event, index) {
    
    const navItems = document.querySelectorAll('.author-submit-nav li');
    navItems.forEach(item => item.classList.remove('active')); // Remove active class from all items
    navItems[index].classList.add('active'); // Add active class to clicked item

     // Smooth scroll to the target element
     target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}
