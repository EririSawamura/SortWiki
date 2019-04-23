function SortCode(obj) {
    if(obj.id === "code1"){
        codetext = "import &ltstdio.h&gt\n" + "    int main(){\n" + "        printf(\"Hello world\");\n" + "    }";
        document.getElementById("codetext").innerText = codetext;
    }
}

function SortAnimation(obj) {

    if(obj.id === "sort1"){
        aniimg = "img/insertion-sort.gif";
        document.getElementById("sortanimation").src = aniimg;
    }
    if(obj.id === "sort2"){
        aniimg = "img/selection-sort.gif";
        document.getElementById("sortanimation").src = aniimg;
    }
    if(obj.id === "sort3"){
        aniimg = "img/insertion-sort.gif";
        document.getElementById("sortanimation").src = aniimg;
    }
    if(obj.id === "sort4"){
        aniimg = "img/bubble-sort.gif";
        document.getElementById("sortanimation").src = aniimg;
    }
    if(obj.id === "sort5"){
        aniimg = "img/merge-sort.gif";
        document.getElementById("sortanimation").src = aniimg;
    }
    if(obj.id === "sort6"){
        aniimg = "img/quick-sort.gif";
        document.getElementById("sortanimation").src = aniimg;
    }
}

