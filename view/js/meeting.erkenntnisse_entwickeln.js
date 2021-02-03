// ADD category without reloading page
// https://www.youtube.com/watch?v=1fj-i8bRMLI
$(document).ready(function(){
    $("#categoryForm").submit(function(event){
        event.preventDefault();
        
        let categoryName  = document.getElementById("categoryName").value;
        let cat_meetingId = document.getElementById("cat_meetingId").value;
        document.getElementById("categoryName").value = "";

        // make post request with ajax
        if (categoryName != ""){
            $.post("../../controller/meeting.add_category.php", {categoryName: categoryName, cat_meetingId: cat_meetingId})
        }   
    })
})

// ONLY reload dropdown of answer-cards
$(document).ready(function(){
    if (document.getElementById("cat_meetingId") != null){
        let select_categories = this.getElementsByClassName("custom-select");
        let cat_meetingId = document.getElementById("cat_meetingId").value;
        for (let i = 0; i<select_categories.length; i++){
            select_categories[i].addEventListener("focus", function(){
                $.post("../../controller/meeting.load_categories.php", {cat_meetingId: cat_meetingId}, function(data){
                    console.log(data);
                    categories = data.split("|");
                    while (select_categories[i].children.length >= 1){
                        select_categories[i].options.remove(select_categories[i].firstChild);
                    }
                    select_categories[i].options.add(new Option("Überkategorie auswählen", ""));
                    for (let j = 1; j<categories.length-1; j++){
                        let nameAndValue = categories[j].split("°°");
                        select_categories[i].options.add(new Option(nameAndValue[0], nameAndValue[1]));
                    }
                })
            })
        }
    }
})

// LOAD two dummy-options so the dopdown doesnt have a size of 1 on page-load
$(document).ready(function(){
    if (document.getElementById("cat_meetingId") != null){
        let select_categories = this.getElementsByClassName("custom-select");
        let cat_meetingId = document.getElementById("cat_meetingId").value;
        for (let i = 0; i<select_categories.length; i++){
            $.post("../../controller/meeting.load_categories.php", {cat_meetingId: cat_meetingId}, function(data){
                categories = data.split("|");
                while (select_categories[i].children.length >= 1){
                    select_categories[i].options.remove(select_categories[i].firstChild);
                }
                select_categories[i].options.add(new Option("Überkategorie auswählen", ""));
                select_categories[i].options.add(new Option("", ""));
                select_categories[i].options.add(new Option("", ""));
            });
        }
    }
});