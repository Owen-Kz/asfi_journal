import { GetParameters, parentDirectoryName, submissionsEndpoint } from "../constants.js";
import { GetCookie } from "../setCookie.js";
import { GetAccountData } from "./accountData.js";

const user = GetCookie("user");
const accountType = await GetAccountData(user);
let submissionid = "";
const S_as_parameter = GetParameters(window.location.href).get("s");
const A_as_parameter = GetParameters(window.location.href).get("a");

if(S_as_parameter){
    submissionid = S_as_parameter;
} else if(A_as_parameter){
    submissionid = A_as_parameter;
}

// DOM Elements
const reviewIdContainer = document.getElementById("reviewIdContainer");
const totalOverallRating = document.getElementById("totalOverallRating");
const totalSpecificScore = document.getElementById("totalSpecificScore");
const one_paragraph_comment = document.getElementById("one_paragraph_comment");
const one_paragraph_file_container = document.getElementById("one_paragraph_file");
const general_comment = document.getElementById("general_comment");
const general_comment_file_container = document.getElementById("general_comment_file");
const specific_comment = document.getElementById("specific_comment");
const specific_comment_file_container = document.getElementById("specific_comment_file");
const overallRecommendationContainer = document.getElementById("overallRecommendationContainer");
const manuTitle = document.getElementById("manu_title");
const confidentialComment = document.getElementById("confidentialComment");

// Check if elements exist before using them
if (!reviewIdContainer || !totalOverallRating || !totalSpecificScore) {
    console.error("Required DOM elements not found");
    showError("Page elements not loaded correctly. Please refresh the page.");
}

if(user){
    fetch(`https://greek.asfirj.org/backend/reviewers/viewReview.php?a_id=${submissionid}`, {
        method: "GET"
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
    })
    .then(data => {
        if(data && data.reviewContent){
            const reviewsContent = data.reviewContent;
            
            // Set basic information
            reviewIdContainer.textContent = reviewsContent.review_id || "N/A";
            
            // Set manuscript title if available
            if (reviewsContent.manuscript_title && manuTitle) {
                manuTitle.textContent = reviewsContent.manuscript_title;
            }
            
            // Set comments
            one_paragraph_comment.textContent = reviewsContent.one_paragraph_comment || "No comment provided";
            general_comment.textContent = reviewsContent.general_comment || "No comment provided";
            specific_comment.textContent = reviewsContent.specific_comment || "No comment provided";
            
            // Set confidential comment
            if (confidentialComment && reviewsContent.confidential_comment) {
                confidentialComment.textContent = reviewsContent.confidential_comment;
            }
            
            // Set file attachments
            setFileAttachment(one_paragraph_file_container, reviewsContent.one_paragraph_file, "One Paragraph File");
            setFileAttachment(general_comment_file_container, reviewsContent.general_comment_file, "General Comment File");
            setFileAttachment(specific_comment_file_container, reviewsContent.specific_comment_file, "Specific Comment File");
            
            // Calculate scores
            const OverallRating = calculateOverallRating(reviewsContent);
            const SpecificScore = calculateSpecificScore(reviewsContent);
            
            // Display scores
            totalOverallRating.textContent = OverallRating;
            totalSpecificScore.textContent = SpecificScore;
            
            // Display recommendation
            displayRecommendation(reviewsContent.overall_recommendation);
            
            // Update score cells in the table with progress bars
            updateScoreCells(reviewsContent);
            
        } else {
            showError("Could not load review data. The review may not exist or you may not have permission to view it.");
        }
    })
    .catch(error => {
        console.error("Error fetching review:", error);
        showError("Network error. Please try again.");
    });
} else {
    window.location.href = parentDirectoryName + "/portal/login";
}

function calculateOverallRating(reviewsContent) {
    const scores = [
        parseInt(reviewsContent.novelty_score) || 0,
        parseInt(reviewsContent.quality_score) || 0,
        parseInt(reviewsContent.scientific_accuracy_score) || 0,
        parseInt(reviewsContent.overall_merit_score) || 0,
        parseInt(reviewsContent.english_level_score) || 0
    ];
    
    return scores.reduce((total, score) => total + score, 0);
}

function calculateSpecificScore(reviewsContent) {
    const scores = [
        'accurately_reflect_manuscript_subject_score',
        'clearly_summarize_content_score',
        'presents_what_is_known_score',
        'gives_accurate_summary_score',
        'purpose_clear_score',
        'method_section_clear_score',
        'study_materials_clearly_described_score',
        'research_method_valid_score',
        'ethical_standards_score',
        'study_find_clearly_described_score',
        'result_presented_logical_score',
        'graphics_complement_result_score',
        'table_follow_specified_standards_score',
        'tables_add_value_or_distract_score',
        'issues_with_title_score',
        'manuscript_present_summary_of_key_findings_score',
        'manuscript_highlight_strength_of_study_score',
        'manuscript_compare_findings_score',
        'manuscript_discuss_meaning_score',
        'manuscript_describes_overall_story_score',
        'conclusions_reflect_achievement_score',
        'manuscript_describe_gaps_score',
        'referencing_accurate_score'
    ];
    
    return scores.reduce((total, score) => total + (parseInt(reviewsContent[score]) || 0), 0);
}

function setFileAttachment(container, fileName, label) {
    if (container) {
        if(fileName && fileName !== "") {
            container.innerHTML = `
                <a href="https://greek.asfirj.org/uploads/reviews/${fileName}" 
                   target="_blank" 
                   class="inline-flex items-center text-primary hover:underline text-sm">
                    <i class="bi bi-file-earmark-text mr-1"></i> ${label}
                </a>
            `;
        } else {
            container.innerHTML = '<span class="text-sm text-gray-600">No file attached</span>';
        }
    }
}

function displayRecommendation(recommendation) {
    if (!overallRecommendationContainer) return;
    
    let title = "";
    let description = "";
    let color = "bg-gray-100 text-gray-800 border-gray-200";

    switch(recommendation) {
        case "Accept As It Is":
            title = "Accept As It Is";
            description = "The manuscript can be accepted without any further changes.";
            color = "bg-green-100 text-green-800 border-green-200";
            break;
        case "Accept Following Minor Revisions":
            title = "Accept Following Minor Revisions";
            description = "The paper can be accepted after satisfactory minor revisions on the basis of the comments raised by the reviewers and the editor.";
            color = "bg-blue-100 text-blue-800 border-blue-200";
            break;
        case "Reject":
            title = "Reject";
            description = "The manuscript is considered to contain serious flaws and does offer any original contribution to the topic area.";
            color = "bg-red-100 text-red-800 border-red-200";
            break;
        case "Reconsider Following Major Revisions":
            title = "Reconsider Following Major Revisions";
            description = "The manuscript can be accepted after satisfactory major revisions on the basis of the comments raised by the reviewers and the editor.";
            color = "bg-yellow-100 text-yellow-800 border-yellow-200";
            break;
        default:
            title = "No Recommendation";
            description = "No overall recommendation has been provided.";
    }

    overallRecommendationContainer.innerHTML = `
        <tr>
            <td class="px-6 py-4 whitespace-normal font-medium">${title}</td>
            <td class="px-6 py-4 whitespace-normal">${description}</td>
        </tr>
    `;
}

function updateScoreCells(reviewsContent) {
    // Update all the score cells in the table with progress bars
    const scoreIds = [
        'accurate_reflect', 'clearly_summarize', 'already_known', 'accurate_summary',
        'originality', 'clear_description', 'study_materials', 'research_method',
        'ethical_standards', 'study_find', 'manuscript_logical', 'tables_clear',
        'tables_standards', 'tables_distract', 'tables_issues', 'summary_keyfinds',
        'manuscript_strength', 'compare_findings', 'discuss_meaning', 'describe_story',
        'reflect_achievement', 'inconsistency', 'referencing', 'novelty', 'quality',
        'scientific_accuracy', 'merit', 'english'
    ];
    
    const scoreMappings = {
        'accurate_reflect': 'accurately_reflect_manuscript_subject_score',
        'clearly_summarize': 'clearly_summarize_content_score',
        'already_known': 'presents_what_is_known_score',
        'accurate_summary': 'gives_accurate_summary_score',
        'originality': 'purpose_clear_score',
        'clear_description': 'method_section_clear_score',
        'study_materials': 'study_materials_clearly_described_score',
        'research_method': 'research_method_valid_score',
        'ethical_standards': 'ethical_standards_score',
        'study_find': 'study_find_clearly_described_score',
        'manuscript_logical': 'result_presented_logical_score',
        'tables_clear': 'graphics_complement_result_score',
        'tables_standards': 'table_follow_specified_standards_score',
        'tables_distract': 'tables_add_value_or_distract_score',
        'tables_issues': 'issues_with_title_score',
        'summary_keyfinds': 'manuscript_present_summary_of_key_findings_score',
        'manuscript_strength': 'manuscript_highlight_strength_of_study_score',
        'compare_findings': 'manuscript_compare_findings_score',
        'discuss_meaning': 'manuscript_discuss_meaning_score',
        'describe_story': 'manuscript_describes_overall_story_score',
        'reflect_achievement': 'conclusions_reflect_achievement_score',
        'inconsistency': 'manuscript_describe_gaps_score',
        'referencing': 'referencing_accurate_score',
        'novelty': 'novelty_score',
        'quality': 'quality_score',
        'scientific_accuracy': 'scientific_accuracy_score',
        'merit': 'overall_merit_score',
        'english': 'english_level_score'
    };
    
    scoreIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            const scoreKey = scoreMappings[id];
            const scoreValue = parseInt(reviewsContent[scoreKey]) || 0;
            const percentage = (scoreValue / 5) * 100;
            
            // Determine color based on score
            let color = "bg-red-500";
            if (scoreValue >= 4) color = "bg-green-500";
            else if (scoreValue >= 3) color = "bg-yellow-500";
            else if (scoreValue >= 2) color = "bg-orange-500";
            
            // Create the score display with progress bar
            element.innerHTML = `
                <div class="flex flex-col items-center">
                    <span class="text-sm font-bold mb-1 ${scoreValue >= 4 ? 'text-green-600' : scoreValue >= 3 ? 'text-yellow-600' : 'text-red-600'}">
                        ${scoreValue}/5
                    </span>
                    <div class="w-16 bg-gray-200 rounded-full h-2">
                        <div class="${color} h-2 rounded-full" style="width: ${percentage}%"></div>
                    </div>
                </div>
            `;
        }
    });
}

function showError(message) {
    // Create a more user-friendly error display
    const errorDiv = document.createElement('div');
    errorDiv.className = 'bg-red-50 border border-red-200 rounded-lg p-4 mb-6 mx-4';
    errorDiv.innerHTML = `
        <div class="flex items-center">
            <i class="las la-exclamation-triangle text-red-500 text-xl mr-3"></i>
            <div>
                <h4 class="font-medium text-red-800">Error</h4>
                <p class="text-red-700 text-sm mt-1">${message}</p>
            </div>
        </div>
    `;
    
    // Insert at the beginning of the main content
    const main = document.querySelector('main');
    if (main) {
        main.insertBefore(errorDiv, main.firstChild);
    } else {
        document.body.appendChild(errorDiv);
    }
}