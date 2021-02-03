
$(document).ready(function() {
    $("#add_metaquestion").click(function(){
        var html = $(".copy").html();
        $(".after-metaquestion").before(html);

        var elem = parseInt($("#elemCount").value);
        var element = 1;
        elem++;
        $("#elemCount").val(elem);
        
    });
    $("body").on("click",".remove", function(){ 
        $(this).parents(".control-group").remove();
    });
  });



