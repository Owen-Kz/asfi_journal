import { quill } from "./quill.js";


const article_type = document.getElementById("article-type")
const prefix = document.getElementById("article_type")
const article_type_nav = document.getElementById("article_type_nav")

const upload_manuscript_nav = document.getElementById("upload_manuscript_nav")
const title_nav = document.getElementById("title_nav")
const abstract_nav = document.getElementById("abstract_nav")
const keywords_nav = document.getElementById("keywords_nav")

const author_information_nav = document.getElementById("author_information_nav")
const suggest_reviewers_nav = document.getElementById("suggest_reviewers_nav")
const disclosures_nav = document.getElementById("disclosures_nav")
const review_submit_nav = document.getElementById("review_submit_nav")

const authorContainer = document.getElementById('author-container');

// Function to show the popup
function showErrorPopup(message) {
  const errorpopup = document.getElementById('errorPopup');
  errorpopup.innerHTML = `<p>${message}</p>`
  errorpopup.classList.remove('hidden');
  errorpopup.classList.add('show', 'slide-in');

  // Hide the popup after 3 seconds (adjust as needed)
  setTimeout(() => {
      errorpopup.classList.remove('show');
      errorpopup.classList.add('hidden');
  }, 8000); // 8000 milliseconds = 8 seconds
}

if(prefix.value === "" && !prefix.value){
    const nextButton = article_type.querySelector(".nextManuscript")
    nextButton.classList.add("disabled")
}
prefix.addEventListener("change", function() {
if(prefix.value != "" && prefix.value){
const nextButton = article_type.querySelector(".nextManuscript")
nextButton.classList.remove("disabled")
nextButton.removeAttribute("disabled")
article_type_nav.setAttribute("onclick","NavigationNext('article-type', 'article_type_nav','upload_manuscript_nav',0)")
}
})

document.addEventListener('DOMContentLoaded', function() {
    const articleTypeSelect = document.getElementById('article_type');
    const disciplineSelect = document.getElementById('discipline');
    const nextButton = document.querySelector('.nextManuscript');
  
    // Function to check if both fields are selected
    function checkSelection() {
      // Check if both article type and discipline are selected
      if (articleTypeSelect.value !== '' && disciplineSelect.value !== '') {
        nextButton.classList.remove("disabled")
        nextButton.disabled = false; // Enable the Next button
      } else if(articleTypeSelect.value === ""){
        showErrorPopup('Please select Article Type before proceeding.');
        nextButton.classList.add("disabled")
        nextButton.disabled = true;
      }else if(disciplineSelect.value === ""){
        showErrorPopup('Please select Discipline before proceeding.');
        nextButton.classList.add("disabled")
        nextButton.disabled = true;
      }
       else {
        nextButton.classList.add("disabled")
        nextButton.disabled = true; // Disable the Next button if either is not selected
      }
    }
  
    // Event listener for change on both select fields
    articleTypeSelect.addEventListener('change', checkSelection);
    disciplineSelect.addEventListener('change', checkSelection);
  
    // Event listener for Next button click
    nextButton.addEventListener('click', function() {
      // Prevent form submission if fields are not selected
      if (articleTypeSelect.value === '' && !articleTypeSelect.value) {
        showErrorPopup('Please select Article Type before proceeding.');
        
       // Alert user
      }
      if (disciplineSelect.value === '' && !disciplineSelect.value) {
        showErrorPopup('Please select Discipline before proceeding.');
        
      }
    });
  });


const headerMessageContainer = document.getElementById("headerMessage")


headerMessageContainer.innerHTML = headerMessages[0]


const upload_manuscript = document.getElementById("upload-manuscript")
const FIleFIelds = upload_manuscript.querySelectorAll(".requiredFiles")

FIleFIelds.forEach(field =>{
    if(field.value === "" && !field.value){
        const nextButton = upload_manuscript.querySelector(".nextManuscript")
        nextButton.classList.add("disabled")
    }
    field.addEventListener("change", function(){
        const FileSize = field.files[0].size
        const FileType = field.files[0].type
        if(field.files[0]){
        if(FileSize > 50000000){
          showErrorPopup("File size is too large")
        }
        if (!(FileType === "application/msword" || FileType === "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || FileType === "application/pdf")){

            
            showErrorPopup("Invalid file type. Please upload a Word document (.doc, .docx) or a PDF file (.pdf).");
            field.value = ''; // Clear the file input

        }

        if(field.value != "" && field.value){
         
            const nextButton = upload_manuscript.querySelector(".nextManuscript")
            nextButton.classList.remove("disabled")
            nextButton.removeAttribute("disabled")
            // nextSection, currentSection, navItemId, Nextitem, prevSection, headerMessageIndex
            upload_manuscript_nav.setAttribute("onclick","NavigationNext('upload-manuscript', 'upload_manuscript_nav', 'title_nav',1)")

        }
    }
    })

})



const Title = document.getElementById("title")
const Titles = Title.querySelectorAll("input[type=text]")

Titles.forEach(titles =>{
  if(titles.value === "" && !titles.value){
    const nextButton = Title.querySelector(".nextManuscript")
    nextButton.classList.add("disabled")
}
    titles.addEventListener("change", function(){
     if(titles.value != "" && titles.value){
    const nextButton = Title.querySelector(".nextManuscript")
    nextButton.classList.remove("disabled")
    nextButton.removeAttribute("disabled")
    title_nav.setAttribute("onclick","NavigationNext('title', 'title_nav', 'abstract_nav', 2)")
    }
})

});

const Abstract = document.getElementById("abstract")
var text = quill.getText().trim();
if(text.length === 0){
    const nextButton = Abstract.querySelector(".nextManuscript")
    nextButton.classList.add("disabled")
}

quill.on('text-change', function(delta, oldDelta, source) {
        const nextButton = Abstract.querySelector(".nextManuscript")
        nextButton.classList.remove("disabled")
        nextButton.removeAttribute("disabled")
        abstract_nav.setAttribute("onclick","NavigationNext('abstract', 'abstract_nav','keywords_nav', 3)")
  });

const Keywords = document.getElementById("keywords")
const Keyword = Keywords.querySelectorAll("input[type=text]")
  
Keyword.forEach(keyword =>{
    if(keyword.value === "" && !keyword.value){
        const nextButton = Keywords.querySelector(".nextManuscript")
        nextButton.classList.add("disabled")
    }
      keyword.addEventListener("change", function(){
      if(keyword.value != "" && keyword.value){
      const nextButton = Keywords.querySelector(".nextManuscript")
      nextButton.classList.remove("disabled")
      nextButton.removeAttribute("disabled")
      keywords_nav.setAttribute("onclick","NavigationNext('keywords', 'keywords_nav', 'author_information_nav', 4)")
      }
  })
  
  });


const Author_information = document.getElementById("author-information")
const author_field = Author_information.querySelector(".hd")
const userEmailContainer = document.getElementById("logged_email")

// Author_information.addEventListener("change", function() {
    // if(userEmailContainer.value != "" && userEmailContainer.value){
    const nextButton = Author_information.querySelector(".nextManuscript")
    nextButton.removeAttribute("disabled")
    author_information_nav.setAttribute("onclick","NavigationNext('author-information', 'author_information_nav', 'suggest_reviewers_nav', 5)")
    // }else{
    //     console.log(userEmailContainer.value)
    // }
    // })

    // const disclosure_confirm = document.getElementById("disclosure_confirm")

    // disclosure_confirm.addEventListener("change", function() {
    //     disclosures_nav.setAttribute("onclick","NavigationNext('disclosures', 'disclosures_nav', 'review_submit_nav', 2)")
    // })

const Suggest_Reviewers = document.getElementById("suggest-reviewers")
const Suggest_Reviewer = Suggest_Reviewers.querySelectorAll("input[type=text]")
      
Suggest_Reviewer.forEach(suggest_Reviewer =>{
    if(suggest_Reviewer.value === "" && !suggest_Reviewer.value){
        const nextButton = Suggest_Reviewers.querySelector(".nextManuscript")
        nextButton.classList.add("disabled")
    }
    suggest_Reviewer.addEventListener("change", function(){
          if(suggest_Reviewer.value != "" && suggest_Reviewer.value){
          const nextButton = Suggest_Reviewers.querySelector(".nextManuscript")
          nextButton.classList.remove("disabled")
          nextButton.removeAttribute("disabled")
          suggest_reviewers_nav.setAttribute("onclick","NavigationNext('suggest-reviewers', 'suggest_reviewers_nav', 'disclosures_nav', 6)")
          }
      })
      
      });