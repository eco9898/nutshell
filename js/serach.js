function runListener() {
    var input = document.getElementById("search-element");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            document.getElementById("search-element").value = document.getElementById("search-element").value.replace(/[\r\n]/gm, '');
            document.getElementById("search-element").style.height = "5px";
            document.getElementById("search-element").style.height = (document.getElementById("search-element").scrollHeight)+"px";
            var text = document.getElementById("search-element").value;
            if (serachFlager(text)==true) {
                alert("Profanity found.")
            } else {
                window.location.replace("/genPage.php?page=" + text);
            }

        }
    });
}

function serachFlager(text) {
    // var badwordsArray = require('badwords/array');
    const badwordsArray = ["arse", "arsehead", "arsehole", "ass", "bastard", "bitch", "bloody", "bollocks", "brotherfucker", "cock", "crap", "cunt", "dick", "dickhead", "dyke", "dyke", "fuck", "fatherfucker", "shit", "kike", "piss", "prick", "pussy", "sisterfucker", "slut", "spaz", "twat", "wanker"]
    var listOfWords = text.split(" ")
    let a = false
    for (let i = 0; i < listOfWords.length; i++) {
        const map1 = badwordsArray.map(x=> x === listOfWords[i])
        .reduce((truth, a) => truth || a)
        if (map1) {
            a = true
        }
    }
    return a
}