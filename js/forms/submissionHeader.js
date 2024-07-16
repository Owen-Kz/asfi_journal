const FilesArray = [];

function removeFile(fieldName, fieldContainerId, label){
    const fileContainer = document.getElementById(fieldContainerId)
    fileContainer.setAttribute("style", "color:black;")

    // Remove file from FilesArray
    const index = FilesArray.findIndex(fileObject => fileObject.fieldName === fieldName);
    if (index > -1) {
        FilesArray.splice(index, 1);
    }
 
  fileContainer.innerHTML = ` <label for="${fieldName}">${label}:</label>
                          <input type="file" class="form-control" name="${fieldName}">`  
}

function navigateSection(sectionId) {
    var currentSection = document.querySelector('.form-section:not(.hidden)');
    var nextSection = document.getElementById(sectionId);

    if (currentSection && nextSection && !nextSection.classList.contains('hidden')) {
        currentSection.classList.add('hidden');
        nextSection.classList.remove('hidden');
        nextSection.classList.add('fade-in');

        updateNavigationList(sectionId);
    }
}

function updateNavigationList(currentSectionId, Nextitem) {

   const item = document.getElementById(currentSectionId)
   const next = document.getElementById(Nextitem);
    item.setAttribute("class", "active-nav")
    next.removeAttribute("class")

    const Lock = item.querySelector("i")
    const LockNext = next.querySelector("i")
    LockNext.innerText = "lock_open"

    Lock.innerHTML = "<span></span>";
}

function NavigationNext(nextSection, navItemId, Nextitem 
    ,  headerMessageIndex){
    const OttherSections = document.querySelectorAll(".form-section")
    OttherSections.forEach(Section => {
        Section.classList.add('hidden');
        // const buttons = document.getElementById(prevSection);
        if(Section){
            Section.querySelector(".submit-next").style.display="none";
        }
    })
    document.getElementById(nextSection).classList.remove('hidden');
    document.getElementById(nextSection).classList.add('fade-in');
    document.getElementById(nextSection).querySelector(".submit-next").style.display="block";

    updateNavigationList(navItemId, Nextitem)
 
    scrollTo(0, 0);  // Scroll to the top of the page if needed
            // HEader messages 
            const headerMessageContainer = document.getElementById("headerMessage")
        headerMessageContainer.innerHTML = headerMessages[headerMessageIndex]

}


document.addEventListener('DOMContentLoaded', function() {
    const keywordInputs = document.querySelectorAll('.keyword-input');
    const nextButton = document.getElementById('nextButton');

    // Add event listeners to each input field to monitor changes
    keywordInputs.forEach(input => {
        input.addEventListener('input', checkKeywords);
    });

    // Check filled inputs and enable/disable Next button
    function checkKeywords() {
        const filledCount = Array.from(keywordInputs).filter(input => input.value.trim() !== '').length;
        nextButton.disabled = filledCount < 3;

        // Update input styles based on their value
        keywordInputs.forEach(input => {
            if (input.value.trim() === '') {
                input.classList.add('required');
                input.classList.remove('valid');
            } else {
                input.classList.remove('required');
                input.classList.add('valid');
            }
        });
    }

    // Add event listener for the Next button
    nextButton.addEventListener('click', function() {
        const filledCount = Array.from(keywordInputs).filter(input => input.value.trim() !== '').length;

        if (filledCount === 0) {
            // Highlight all empty fields
            keywordInputs.forEach(input => {
                input.classList.add('required');
                input.classList.remove('valid');
            });
            alert('Please fill in at least 3 keywords before proceeding.');
            return; // Prevent proceeding
        }

        if (filledCount < 3) {
            // Highlight fields that are still empty
            keywordInputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.classList.add('required');
                    input.classList.remove('valid');
                } else {
                    input.classList.add('valid'); // Mark filled fields as valid
                }
            });
            alert('Please fill at least 3 keywords before proceeding.');
            return; // Prevent proceeding
        }

        // Call the original showNext function
        showNext('author-information', 'keywords', 'keywords_nav', 'author_information_nav', 'abstract', 5, 5);
    });
});


// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Select the Next button element
    const nextButton = document.getElementById('suggestNextButton');

    // Add click event listener to the Next button
    nextButton.addEventListener('click', function() {
        // Select all reviewer sections
        const reviewerSections = document.querySelectorAll('#suggest-reviewers .suggestHandle');

        // Array to store unfilled sections
        let unfilledSections = [];

        // Loop through each reviewer section
        reviewerSections.forEach((section, index) => {
            // Check if all fields in this section are filled
            const inputs = section.querySelectorAll('input[type="text"]');
            let allFilled = true;
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    allFilled = false;
                }
            });

            // If section is not filled, add index to unfilledSections array
            if (!allFilled) {
                unfilledSections.push(index + 1); // index + 1 because index is zero-based
            }
        });

        // Check if at least 3 sections are filled
        if (reviewerSections.length - unfilledSections.length < 3) {
            // Construct alert message for unfilled sections
            let alertMessage = 'Please fill out all fields of at least three Reviewers information sections.\n\n';
            unfilledSections.forEach(sectionIndex => {
                alertMessage += `- Section ${sectionIndex}\n`;
            });

            // Alert the user with detailed message
            alert(alertMessage);
        } else {
            // Proceed to the next step
            // Assuming there is a function showNext() defined elsewhere
            showNext('disclosures', 'suggest-reviewers', 'suggest_reviewers_nav', 'disclosures_nav', 'author-information', 7, 7);
        }
    });
});


function showNext(nextSection, currentSection, navItemId, Nextitem, prevSection, headerMessageIndex) {
    document.getElementById(currentSection).classList.add('hidden');
    document.getElementById(nextSection).classList.remove('hidden');
    document.getElementById(nextSection).classList.add('fade-in');
    updateNavigationList(navItemId, Nextitem)
    document.getElementById(nextSection).querySelector(".submit-next").style.display="block";

    const buttons = document.getElementById(prevSection);
    if(buttons){
        buttons.querySelector(".submit-next").style.display="none";
    }
    scrollTo(0, 0);  // Scroll to the top of the page if needed
            // HEader messages 
            const headerMessageContainer = document.getElementById("headerMessage")
        headerMessageContainer.innerHTML = headerMessages[headerMessageIndex]


}


function reviewAll(index) {
    const hiddenItms = document.querySelectorAll(".form-section");
    const removeButton = document.querySelectorAll(".submit-next");
    const showSubmit = document.querySelectorAll('button[name="review_stat"]');
    const checkboxes = document.querySelectorAll('.disclosure-checkbox');
    let allChecked = true;

    // Reset styles
    checkboxes.forEach(checkbox => {
        checkbox.parentElement.style.borderColor = '';
    });

    // Check if all checkboxes are checked
    checkboxes.forEach(checkbox => {
        if (!checkbox.checked) {
            allChecked = false;
            checkbox.parentElement.style.borderColor = 'red'; // Highlight unchecked
        }
    });

    if (!allChecked) {
        alert('Please confirm all disclosures before proceeding.');
        return; // Prevent further action
    }

    // Proceed with submission logic (if all checkboxes are checked)
    console.log('All disclosures confirmed. Proceeding to step:', index);
    // Your submission logic goes here

    hiddenItms.forEach(item=>{
        item.classList.remove('hidden');
    })

    removeButton.forEach(item=>{
        item.style.display="none";
    })
    const headerMessageContainer = document.getElementById("headerMessage")

    headerMessageContainer.innerHTML = headerMessages[index]

    showSubmit.forEach(submitbutton =>{
        submitbutton.removeAttribute('hidden');

    })
    scrollTo(0, 0);  // Scroll to the top of the page if needed
            // HEader messages 
        headerMessageContainer.innerHTML = headerMessages[headerMessageIndex]
}

function setStatus(status){
    const reviewStatus  = document.querySelector('input[name="review_status"]')
    const submitForm = document.getElementById("submitForm")
    

    reviewStatus.value = status
    submitForm.click()

}
function addAuthorInput() {
    var authorContainer = document.getElementById('author-information');
    var addAuthor = document.getElementById('addAuthor');

    // Create new input fields for the new author
    var newAuthorInputs = document.createElement('div');
    newAuthorInputs.className = 'author-container';
    newAuthorInputs.innerHTML = `
        <div style="display: flex; width: 200%; justify-content: center; align-items: center;" id="author-container">
        <div class="drag-handle"></div>
    <div style="margin-right: 10px;">
        <label for="prefix">Prefix:</label>
        <select name="authors_prefix[]" class="form-control">
            <option value="">Select an Option</option>
            <option value="Prof">Prof.</option>
            <option value="Dr">Dr.</option>
            <option value="Mr">Mr.</option>
            <option value="Mrs">Mrs.</option>
            <option value="Miss">Miss</option>
        </select>
    </div>


                    <div style="margin-right: 10px; width: 300px;">
                              <label for="">First Name:</label>
                              <input type="text" class="form-control hd" placeholder="First Name..." name="authors_first_name[]" >
                              </div>
                              <!-- <div style="display: flex;"> -->
                                <div style="margin-right: 10px;">
                                    <label for="">MiddleName:</label>
                                      <input type="text" class="form-control" placeholder="Middle name" name="authors_other_name[]" >
                                    <!-- </div> -->
                                </div>
                            <div style="margin-right: 10px; width: 300px;">
                                <label for="">Last Name:</label>
                                <input type="text" class="form-control hd" placeholder="Last Name..." name="authors_last_name[]" >
                            </div>

                            <div style="margin-right: 10px; width: 300px;">
                                <label for="">ORCID ID”:</label>
                                <input type="text" class="form-control hd" placeholder="ORCID ID..." name="authors_orcid[]">
                            </div>

    <div style="margin-right: 10px; width: 300px;">
                            <label for="">Affiliation:</label>
                            <div style="display: flex;">
                            <input type="text" class="form-control" placeholder="Affiliation..." name="affiliation[]">
                            <input type="text" class="form-control" placeholder="Affiliation City..." name="affiliation_city[]">
                            <input type="text" class="form-control" placeholder="Affiliation Country..." name="affiliation_country[]">
                            </div>
                        </div>
                
                        <div style="border-bottom: 1px solid #404040; margin-bottom: 12px;">
                            <label for="">Email:</label>
                            <input type="email" class="form-control" placeholder="Email..." name="email[]">
                        </div>
                        <div class="remove-author" style="width: 20px; height: 20px; color:white; font-weight:bold; background-color: red; border-radius:6px; display:flex; justify-content: center; align-items: center; text-align: center; line-height: 20px; cursor:pointer;">x</div>
        </div>

    `;

    // Append the new author inputs to the container
    addAuthor.appendChild(newAuthorInputs);

    // Add event listener to the "x" button
    newAuthorInputs.querySelector('.remove-author').addEventListener('click', function() {
        addAuthor.removeChild(newAuthorInputs);
    });

}
// Initialize SortableJS
document.addEventListener('DOMContentLoaded', function() {
    var sortable = new Sortable(document.getElementById('addAuthor'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        handle: '.author-container'
    });
});
  