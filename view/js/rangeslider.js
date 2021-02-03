$(document).ready(function(){
  if (document.getElementsByClassName("slidecontainer") != null){
      let sliders = document.getElementsByClassName("slidecontainer");
      for (let i = 0; i<sliders.length; i++){
        sliders[i].children[0].addEventListener("change", function(){
          let sliderval = sliders[i].children[0].value;
          sliders[i].children[1].children[0].innerHTML = sliderval;
        });
      }
    }
});
