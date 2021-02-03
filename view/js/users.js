// https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/
function search_users() { 
    let input = document.getElementById('user-searchbar').value; 
    input=input.toLowerCase(); 
    let x = document.getElementsByClassName('user-content'); 
      
    for (i = 0; i < x.length; i++) {  
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
        } 
        else { 
            x[i].style.display="block";                  
        } 
    } 
} 