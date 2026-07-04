function updateBoard() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = "hellow";
        }
    };
    xmlhttp.open("GET", "index.php", true);
    xmlhttp.send();
}

function getClassForCSS(value) {
    switch(value) {
        case '#': return "mHidden";

        case '*': return "mBlank";
        case 0: return "mBlank";        // needs to be changed when negative mines are implemented

        case "1": return "m1";
        case 1:   return "m1";

        case '2': return "m2";
        case 2:   return "m2";

        case '3': return "m3";
        case 3:   return "m3";

        case '4': return "m4";
        case 4:   return "m4";

        case '5': return "m5";
        case 5:   return "m5";

        case '6': return "m6";
        case 6:   return "m6";

        case '7': return "m7";
        case 7:   return "m7";

        case '8': return "m8";
        case 8:   return "m8";

        case '9': return "m9";
        case 9:   return "m9";

        default: return "mHidden";
    }
}

// <insert this in the HTML file>
// onclick=updateTile(x,y,this.innerHTML,newValue)
/*
    '#' = unrevealed
    '*' = revealed, empty
    '1'-'9' : revealed, non-empty
    '?' : revealed, mine
*/
function updateTile(x,y,oldValue,newValue) {
    // oldValue and newValue are chars that follow the rule above (example : oldValue = '#', newValue = '*')
    console.log("[at "+x+", "+y+"] ("+oldValue+")-->("+newValue+")");
    if(oldValue != newValue) {
        var xmlhttp = new XMLHttpRequest();
        var _span = document.getElementById("_"+x+"_"+y+"_");

        //console.log("----------------");
        //console.log(_span);
        //console.log("----------------");

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // update the content of the cell
                document.getElementById("_"+x+"_"+y+"_").innerHTML = newValue;
                document.getElementById("_"+x+"_"+y+"_").innerText = newValue;

                // update CSS
                //_span.className = getClassForCSS(newValue);
                document.getElementById("_"+x+"_"+y+"_").className = "cell "+getClassForCSS(newValue);

                console.log("updated");
            }
        };

        // debug 101
        updateBoard();
        console.log("(at "+x+", "+y+") OK");

        // send the request
        xmlhttp.open("GET", "index.php", true);
        xmlhttp.send();
    } else {
        console.log("WARNING : hollow update (at "+x+", "+y+" with value="+oldValue+")");
    }
}

function refreshBoard(x,y,oldValue,newValue/*unused*/) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var ans = xmlhttp.responseText;
            console.log("["+ans+"]");
            updateTile(x,y,oldValue,ans);
            if(ans == '.') {

            }
        }
    };

    xmlhttp.open("GET", "server.php?x="+x+"&y="+y+"&reveal=0", true);
    xmlhttp.send();
    //console.log("refreshOK?");
}

function tileClicked(x,y,oldValue,newValue/*unused*/) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("{{"+xmlhttp.responseText+"}}");
            refreshBoard(x,y,oldValue,newValue);
        }
    };

    xmlhttp.open("GET", "server.php?x="+x+"&y="+y+"&reveal=1", true);
    xmlhttp.send();
    //console.log("ok?");
}