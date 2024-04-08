// Get url current page
var currentUrl = window.location.href;

// Remove slash ("/") from the current page's URL
if (currentUrl.slice(-1) === "/") {
  currentUrl = currentUrl.slice(0, -1);
}

// Select all <a> tags in the vertical menu
var menuLinks = document.querySelectorAll('.sidebar ul a');
console.log(menuLinks);
// Iterate through all the links in the menu and add class "active" if the URL of the link matches the URL of the current page
menuLinks.forEach(function(link) {
  var linkUrl = link.href;

  // Remove slash ("/") from the current page's URL
  if (linkUrl.slice(-1) === "/") {
    linkUrl = linkUrl.slice(0, -1);
  }

  if (linkUrl === currentUrl) {
    link.classList.add('active');
  }
});