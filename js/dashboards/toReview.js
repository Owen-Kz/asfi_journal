import { parentDirectoryName, submissionsEndpoint } from "../constants.js";
import { GetCookie } from "../setCookie.js";
import { GetAccountData } from "./accountData.js";

const user = GetCookie("user");

if (!user) {
    window.location.href = parentDirectoryName + "/portal/login";
    throw new Error("User not logged in");
}

// Main initialization function
async function initializeReviewDashboard() {
    try {
        const accountType = await GetAccountData(user);
        const isReviewer = accountType.is_reviewer;

        if (isReviewer !== "yes") {
            window.location.href = parentDirectoryName + "/portal/login";
            throw new Error("User is not a reviewer");
        }

        // Wait for the PHP content to be loaded
        await waitForPHPContent();
        
        // Initialize review actions
        initializeReviewActions();
        
        // Add visual enhancements
        enhanceUIElements();

    } catch (error) {
        console.error("Error initializing review dashboard:", error);
        window.location.href = parentDirectoryName + "/portal/login";
    }
}

// Wait for PHP content to be loaded
function waitForPHPContent() {
    return new Promise((resolve) => {
        if (document.querySelector('.actionForm') || document.querySelector('#reviewsTableBody tr')) {
            resolve();
        } else {
            // Check periodically for PHP content
            const checkInterval = setInterval(() => {
                if (document.querySelector('.actionForm') || document.querySelector('#reviewsTableBody tr')) {
                    clearInterval(checkInterval);
                    resolve();
                }
            }, 100);
            
            // Timeout after 5 seconds
            setTimeout(() => {
                clearInterval(checkInterval);
                resolve(); // Resolve anyway to continue
            }, 5000);
        }
    });
}

function initializeReviewActions() {
    const reviewActions = document.querySelectorAll(".reviewAction");
    
    if (reviewActions.length === 0) {
        console.log("No review actions found on the page");
        return;
    }

    reviewActions.forEach((action) => {
        // Reset to default option
        action.value = '';
        
        action.addEventListener("change", function() {
            handleReviewAction(this);
        });
    });
}

function handleReviewAction(actionElement) {
    const form = actionElement.closest('form');
    if (!form) {
        console.error("Form not found for action element");
        return;
    }
    
    const articleIdInput = form.querySelector('input[name="a"]');
    if (!articleIdInput) {
        console.error("Article ID input not found");
        return;
    }
    
    const articleId = articleIdInput.value;
    if (!articleId) {
        console.error("Article ID is empty");
        return;
    }
    
    switch(actionElement.value) {
        case "score":
            window.location.href = `${parentDirectoryName}/dashboard/reviewerdash/score?a=${encodeURIComponent(articleId)}`;
            break;
        case "view":
            window.location.href = `${parentDirectoryName}/dashboard/reviewerdash/content?a=${encodeURIComponent(articleId)}`;
            break;
        default:
            // Do nothing for default option
            break;
    }
    
    // Reset the selection after processing
    setTimeout(() => {
        actionElement.value = '';
    }, 100);
}

function enhanceUIElements() {
    // Add visual enhancements to dropdowns
    const dropdowns = document.querySelectorAll('.reviewAction');
    dropdowns.forEach(dropdown => {
        if (!dropdown.classList.contains('enhanced')) {
            dropdown.classList.add(
                'cursor-pointer',
                'transition',
                'duration-200',
                'enhanced' // Marker class to prevent duplicate enhancements
            );
        }
    });

    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.classList.add('hover:bg-gray-50', 'transition', 'duration-150');
    });

    // Add due date highlighting
    highlightDueDates();
}

function highlightDueDates() {
    const today = new Date();
    const dateCells = document.querySelectorAll('td:nth-child(2)'); // Assuming due date is in second column
    
    dateCells.forEach(cell => {
        const dateText = cell.textContent.trim();
        try {
            // Parse the date (format: DD-MMM-YYYY)
            const dateParts = dateText.split('-');
            if (dateParts.length === 3) {
                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const monthIndex = monthNames.indexOf(dateParts[1]);
                
                if (monthIndex !== -1) {
                    const dueDate = new Date(dateParts[2], monthIndex, dateParts[0]);
                    
                    if (!isNaN(dueDate)) {
                        const diffTime = dueDate - today;
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        
                        if (diffDays < 0) {
                            cell.classList.add('bg-red-100', 'text-red-800', 'font-semibold');
                            cell.title = 'Overdue!';
                        } else if (diffDays < 3) {
                            cell.classList.add('bg-orange-100', 'text-orange-800', 'font-semibold');
                            cell.title = 'Due soon!';
                        } else if (diffDays < 7) {
                            cell.classList.add('bg-yellow-100', 'text-yellow-800');
                            cell.title = 'Due in ' + diffDays + ' days';
                        }
                    }
                }
            }
        } catch (error) {
            console.log('Could not parse date:', dateText);
        }
    });
}

// MutationObserver to handle dynamically added content
function setupMutationObserver() {
    const observer = new MutationObserver((mutations) => {
        let shouldReinitialize = false;
        
        mutations.forEach((mutation) => {
            if (mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1) { // Element node
                        if (node.querySelector && 
                            (node.querySelector('.actionForm') || node.querySelector('.reviewAction'))) {
                            shouldReinitialize = true;
                        }
                    }
                });
            }
        });
        
        if (shouldReinitialize) {
            initializeReviewActions();
            enhanceUIElements();
        }
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}

// Initialize everything when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initializeReviewDashboard();
        setupMutationObserver();
    });
} else {
    initializeReviewDashboard();
    setupMutationObserver();
}

// Export for potential manual reinitialization
export function refreshReviewActions() {
    initializeReviewActions();
    enhanceUIElements();
}