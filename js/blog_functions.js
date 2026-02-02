// This function scrolls to the correct page and post when a TOC entry is clicked.
function scrollToPost(postId) {
    let post = document.getElementById(postId);
  
    // Find the page a post resides on
    let postPage = post.parentElement;
  
    // Hide all of the pages
    let allPages = document.getElementsByClassName("blog_page");
    for (let i = 0; i < allPages.length; i++) {
      allPages[i].hidden = true;
    }
  
    // Show the page on which the post resides
    postPage.hidden = false;
  
    // Scroll to the post on the now visible page
    post.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  
    showPageButtons(postPage, allPages);
  }
  
  // This function is used by the page buttons to show the next or previous page
  function handlePageButton(buttonClicked) {
    let currentPageIndex;
    // Find current page by finding the page that is not hidden
    let allPages = document.getElementsByClassName("blog_page");
    for (let i = 0; i < allPages.length; i++) {
      if (allPages[i].hidden == false) {
        currentPageIndex = i;
        break;
      }
    }
  
    // Show next or previous page, assuming it exists
    if ((currentPageIndex != allPages.length-1) && (buttonClicked == 'next')) {
      allPages[currentPageIndex].hidden = true;
      allPages[currentPageIndex + 1].hidden = false;
      currentPageIndex += 1;
  
    } else if ((currentPageIndex != 0) && (buttonClicked == 'previous')) {
      allPages[currentPageIndex].hidden = true;
      allPages[currentPageIndex - 1].hidden = false;
      currentPageIndex -= 1;
    }
  
    // Show the appropriate buttons for the new page
    showPageButtons(allPages[currentPageIndex], allPages);
  
    // Scroll to the top of the page
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }
  
  // This function hides or shows the page selection buttons based on what page is currently
  function showPageButtons(currentPage, allPages) {
    nextButton = document.getElementById("blog_next");
    previousButton = document.getElementById("blog_previous");
  
    if (allPages.length == 1) {
      nextButton.hidden = true;
      previousButton.hidden = true;
  
    } else if (currentPage == allPages[0]) {
      nextButton.hidden = false;
      previousButton.hidden = true;
  
    } else if (currentPage == allPages[allPages.length-1]) {
      nextButton.hidden = true;
      previousButton.hidden = false;
  
    } else {
      nextButton.hidden = false;
      previousButton.hidden = false;
    }
  }