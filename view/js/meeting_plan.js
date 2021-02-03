/* https://www.nicesnippets.com/snippet/add-remove-input-fields-dynamically-using-jQuery-and-bootstrap */

$(document).ready(function() {
    $(".fragen").click(function(){
        var html = $(".copy").html();
        $(".after-fragen").after(html);
    });
    $("body").on("click",".remove", function(){ 
        $(this).parents(".control-group").remove();
    });
  });