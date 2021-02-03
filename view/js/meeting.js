function collapseMeetingBox(){
    var btn = document.getElementsByClassName("collapsible-meeting"); 
    for (let i=0; i<btn.length; i++){
        btn[i].addEventListener("click", function () { 
            /*this.classList.toggle("active"); */
            let content = this.nextElementSibling; 
            let icon = this.lastElementChild;
            if (content.style.display === "block") { 
                content.style.display = "none";
                icon.innerHTML = "<i class='fa fa-caret-left fa-3x' aria-hidden='true'></i>";
            } else { 
                content.style.display = "block"; 
                icon.innerHTML = "<i class='fa fa-caret-left fa-rotate-270 fa-3x' aria-hidden='true'></i>";

            } 
        }); 
    }   
}
