// https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/
function search_faq() { 
    let input = document.getElementById('user-searchbar').value; 
    input=input.toLowerCase(); 
    let x = document.getElementsByClassName('panel-group'); 
    let y = document.getElementsByClassName('panel');
      
    for (i = 0; i < x.length; i++) {  
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
        } 
        else { 
            x[i].style.display="block";                  
        } 
    } 

    for (i = 0; i < y.length; i++) {  
        if (!y[i].innerHTML.toLowerCase().includes(input)) { 
            y[i].style.display="none"; 
        } 
        else { 
            y[i].style.display="block";                  
        } 
    }
} 