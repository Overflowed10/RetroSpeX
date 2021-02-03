// https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/
function search_teams() { 
    let input = document.getElementById('team-searchbar').value; 
    input=input.toLowerCase(); 
    let x = document.getElementsByClassName('team-content'); 
      
    for (i = 0; i < x.length; i++) {  
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].classList.add('d-none');
         } else { 
            x[i].classList.remove('d-none');
        } 
    } 
} 