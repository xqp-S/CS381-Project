

document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById('signin-button');
  
    function updateButton() {
      const signedIn = localStorage.getItem("signedIn") === "true";
  
      if (signedIn) {
        button.innerHTML = "Sign Out";
        button.setAttribute("href", "javascript:void(0);");
      } else {
        button.innerHTML = "Sign In";
        button.setAttribute("href", "login.php");
      }
    }
  
    updateButton();
  
    button.addEventListener("click", function (e) {
      const signedIn = localStorage.getItem("signedIn") === "true";
  
      if (signedIn) {
        e.preventDefault(); 
        localStorage.setItem("signedIn", "false");
        updateButton(); 
      } else {
        
        localStorage.setItem("signedIn", "true"); 
      }
    });
  });
  