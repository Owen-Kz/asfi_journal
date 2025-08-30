import { GetParameters, submissionsEndpoint } from "../constants.js";

const reviewsContainer = document.getElementById("reviewsContainer");
const articleIdContainer = document.getElementById("article_id_container");
const reviewSummary = document.getElementById("reviewSummary");
const averageRating = document.getElementById("averageRating");
const totalReviews = document.getElementById("totalReviews");
const completionRate = document.getElementById("completionRate");

const ArticlesId = GetParameters(window.location.href).get("a");

// Set article ID in the header
if (ArticlesId) {
    articleIdContainer.textContent = ArticlesId;
}

// Fetch Reviews 
fetch(`https://greek.asfirj.org/backend/accounts/manuscriptReviews.php`, {
    method: "POST",
    body: JSON.stringify({id: ArticlesId}),
    headers: {
        "Content-type": "application/JSON"
    }
})
.then(res => res.json())
.then(data => {
    if (data && data.reviews) {
        const reviewsList = data.reviews;
        
        if (reviewsList.length > 0) {
            // Show review summary
            reviewSummary.classList.remove('hidden');
            
            let totalOverallRating = 0;
            let totalSpecificScore = 0;
            
            reviewsList.forEach(review => { 
                const OverallRating = new Number(review.novelty_score) + 
                                    new Number(review.quality_score) + 
                                    new Number(review.scientific_accuracy_score) + 
                                    new Number(review.overall_merit_score) + 
                                    new Number(review.english_level_score);
           
                const SpecificScore = new Number(review.accurately_reflect_manuscript_subject_score) + 
                                    new Number(review.clearly_summarize_content_score) + 
                                    new Number(review.presents_what_is_known_score) + 
                                    new Number(review.gives_accurate_summary_score) + 
                                    new Number(review.purpose_clear_score) + 
                                    new Number(review.method_section_clear_score) + 
                                    new Number(review.study_materials_clearly_described_score) + 
                                    new Number(review.research_method_valid_score) + 
                                    new Number(review.ethical_standards_score) + 
                                    new Number(review.study_find_clearly_described_score) + 
                                    new Number(review.result_presented_logical_score) + 
                                    new Number(review.graphics_complement_result_score) + 
                                    new Number(review.table_follow_specified_standards_score) + 
                                    new Number(review.tables_add_value_or_distract_score) + 
                                    new Number(review.issues_with_title_score) + 
                                    new Number(review.manuscript_present_summary_of_key_findings_score) + 
                                    new Number(review.manuscript_highlight_strength_of_study_score) + 
                                    new Number(review.manuscript_compare_findings_score) + 
                                    new Number(review.manuscript_discuss_meaning_score) + 
                                    new Number(review.manuscript_describes_overall_story_score) + 
                                    new Number(review.conclusions_reflect_achievement_score) + 
                                    new Number(review.manuscript_describe_gaps_score) + 
                                    new Number(review.referencing_accurate_score);

                totalOverallRating += OverallRating;
                totalSpecificScore += SpecificScore;
                
                // Calculate rating color
                const overallPercentage = (OverallRating / 20) * 100;
                let ratingColor = "bg-red-100 text-red-800";
                if (overallPercentage >= 80) ratingColor = "bg-green-100 text-green-800";
                else if (overallPercentage >= 60) ratingColor = "bg-yellow-100 text-yellow-800";
                else if (overallPercentage >= 40) ratingColor = "bg-orange-100 text-orange-800";
                
                const specificPercentage = (SpecificScore / 115) * 100;
                let specificColor = "bg-red-100 text-red-800";
                if (specificPercentage >= 80) specificColor = "bg-green-100 text-green-800";
                else if (specificPercentage >= 60) specificColor = "bg-yellow-100 text-yellow-800";
                else if (specificPercentage >= 40) specificColor = "bg-orange-100 text-orange-800";

                reviewsContainer.innerHTML += `
                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-2">
                                <a href="mailto:submissions@asfirj.org" 
                                   class="inline-flex items-center text-xs text-primary hover:text-purple-800 transition-colors">
                                    <i class="bi bi-envelope mr-1"></i> Contact Journal
                                </a>
                                <span class="text-sm font-medium text-gray-700">${review.review_id}</span>
                                <a href="../reviewcontent?a=${review.review_id}" 
                                   class="inline-flex items-center text-xs text-gray-600 hover:text-primary transition-colors mt-2">
                                    <i class="bi bi-eye mr-1"></i> View Details
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium mr-3">
                                    ${review.reviewer_email ? review.reviewer_email.charAt(0).toUpperCase() : 'R'}
                                </div>
                                <span class="truncate max-w-xs">${review.reviewer_email || 'Anonymous Reviewer'}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="review-score ${specificColor} mr-2">${SpecificScore}</span>
                                <span class="text-sm text-gray-600">/115</span>
                                <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary h-2 rounded-full" style="width: ${specificPercentage}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="review-score ${ratingColor} mr-2">${OverallRating}</span>
                                <span class="text-sm text-gray-600">/20</span>
                                <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary h-2 rounded-full" style="width: ${overallPercentage}%"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });
            
            // Update summary statistics
            const avgOverall = (totalOverallRating / reviewsList.length).toFixed(1);
            const avgSpecific = (totalSpecificScore / reviewsList.length).toFixed(1);
            
            averageRating.textContent = avgOverall;
            totalReviews.textContent = reviewsList.length;
            completionRate.textContent = "100%"; // Assuming all reviews are complete
            
        } else {
            reviewsContainer.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <i class="bi bi-star text-4xl mb-3"></i>
                            <p class="text-lg">No reviews available for this article</p>
                            <p class="text-sm mt-1">Reviews will appear here once they are submitted by reviewers.</p>
                        </div>
                    </td>
                </tr>
            `;
        }
    } else {
        reviewsContainer.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center text-red-500">
                        <i class="bi bi-exclamation-triangle text-4xl mb-3"></i>
                        <p class="text-lg">Error loading reviews</p>
                        <p class="text-sm mt-1">Could not retrieve review data. Please try again later.</p>
                    </div>
                </td>
            </tr>
        `;
        console.error("Could not retrieve data:", data);
    }
})
.catch(error => {
    console.error("Network error:", error);
    reviewsContainer.innerHTML = `
        <tr>
            <td colspan="4" class="px-6 py-8 text-center">
                <div class="flex flex-col items-center justify-center text-red-500">
                    <i class="bi bi-wifi-off text-4xl mb-3"></i>
                    <p class="text-lg">Network error</p>
                    <p class="text-sm mt-1">Please check your connection and try again.</p>
                </div>
            </td>
        </tr>
    `;
});