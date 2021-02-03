function colorCardBackground() {
    let colors = [  "#c94c40",
                    "#c63f51",
                    "#c73ec0",
                    "#c6803f",
                    "#943fc6",
                    "#40c79a",
                    "#40c99b",
                    "#4052c9"];

    let cards = document.getElementsByClassName("card");

    for (i=0; i<cards.length; i++) {
        let randomIndex = Math.floor(Math.random()*colors.length);
        cards[i].style.backgroundColor = colors[randomIndex];
    } 
}