function MeowMeowPurrPurr() {

    var body = document.getElementById("body");
    var allP = body.querySelectorAll("p");
    var allA = body.querySelectorAll("a");
    var allH3 = body.querySelectorAll("h3");
    var allB = body.querySelectorAll("b");
    var allH4 = body.querySelectorAll("h4");

    RemoveAll(allP, allA. allH3, allB, allH4);

}

function RemoveAll(allP, allA. allH3, allB, allH4) {

    RemoveP(allP);
    RemoveA(allA);
    RemoveH3(allH3);
    RemoveB(allB);
    RemoveH4(allH4);

}

function RemoveP(allP) {

    for (var i = 0; i < allP.length; i++) {

        var NumKitty = allP[i].innerHTML.length;
        var KuteKittens = Catify(NumKitty);
        allP[i].innerHTML = KuteKittens;

    }

}

function RemoveA(allA) {

    for (var i = 0; i < allA.length; i++) {

        var NumKitty = allA[i].innerHTML.length;
        var KuteKittens = Catify(NumKitty);
        allA[i].innerHTML = KuteKittens;

    }

}

function RemoveH3(allH3) {

    for (var i = 0; i < allH3.length; i++) {

        var NumKitty = allH3[i].innerHTML.length;
        var KuteKittens = Catify(NumKitty);
        allH3[i].innerHTML = KuteKittens;

    }
    
}

function RemoveB(allB) {

    for (var i = 0; i < allB.length; i++) {

        var NumKitty = allB[i].innerHTML.length;
        var KuteKittens = Catify(NumKitty);
        allB[i].innerHTML = KuteKittens;

    }
    
}

function RemoveH4(allH4) {

    for (var i = 0; i < allH4.length; i++) {

        var NumKitty = allH4[i].innerHTML.length;
        var KuteKittens = Catify(NumKitty);
        allH4[i].innerHTML = KuteKittens;

    }
    
}

function DetermineStateOfMeow() {

    var url_String = window.location.href;
    var url = new URL(url_String);
    var params = new URLSearchParams(url.search);
    var MeowYesNo = params.get("meow");

    if (MeowYesNo == "true") {

        MeowMeowPurrPurr();

    }

}

function Catify(NumKitty) {

    var CAT;

    for (var i = 0; i < NumKitty; i++) {

        CAT  += "😻";

    }

    return CAT;

}