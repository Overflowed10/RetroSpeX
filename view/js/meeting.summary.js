$(document).ready(function() {
    $("#summary-hinzufuegen").click(function(){
        var html = $(".copy").html();
        $(".after-summary").after(html);
    });

  });

function show_relevant_Answers(){
    let summary_boxes = document.getElementsByClassName("summary-box");
    for (i = 0; i<summary_boxes.length; i++){
        let select = summary_boxes[i].childNodes[3].value;
        let answers = summary_boxes[i].getElementsByClassName("card");
        for (j=0; j<answers.length; j++){   
            // access category of answer
            let category = answers[j].childNodes[1].childNodes[1].childNodes[1].textContent;
            // add/remove display-none according to selected category
            if (select != "Überkategorie auswählen"){
                if(category != select){
                    if (!answers[j].classList.contains("d-none")){
                        answers[j].classList.add("d-none");
                    }
                } else {
                    if (answers[j].classList.contains("d-none")){
                        answers[j].classList.remove("d-none");
                    }
                }
            } else {
                if (answers[j].classList.contains("d-none")){
                    answers[j].classList.remove("d-none");
                }
            }
        }
    }
}
