var spantop = document.getElementsByClassName('spantop');
var spanweek = document.getElementsByClassName('spanweek');
var spanupcoming = document.getElementsByClassName('spanupcoming');
var animetop = document.getElementsByClassName('animetopslider');
var animeweek = document.getElementsByClassName('animeweekslider');
var animeupcoming = document.getElementsByClassName('animeupcomingslider');
var l = 0;
var m = 0;
var n = 0

spantop[1].onclick = ()=>{
    l++;
    for(var i of animetop)
    {
        if (l==0) {i.style.left = "0px";}
        if (l==1) {i.style.left = "-90%";}
        if (l==2) {i.style.left = "-180%";}
        if (l==3) {i.style.left = "-270%";}
        if (l==4) {i.style.left = "-360%";}
        if (l==5) {i.style.left = "-440%";}
        if (l>5) {l=5;}
    }
}
spantop[0].onclick = ()=>{
    l--;
    for(var i of animetop)
    {
        if (l==0) {i.style.left = "2%";}
        if (l==1) {i.style.left = "-90%";}
        if (l==2) {i.style.left = "-180%";}
        if (l==3) {i.style.left = "-270%";}
        if (l==4) {i.style.left = "-360%";}
        if (l<0) {l=0;}
    }
}

spanupcoming[1].onclick = ()=>{
    m++;
    for(var i of animeupcoming)
    {
        if (m==0) {i.style.left = "0px";}
        if (m==1) {i.style.left = "-90%";}
        if (m==2) {i.style.left = "-180%";}
        if (m==3) {i.style.left = "-270%";}
        if (m==4) {i.style.left = "-360%";}
        if (m==5) {i.style.left = "-440%";}
        if (m>5) {m=5;}
    }
}
spanupcoming[0].onclick = ()=>{
    m--;
    for(var i of animeupcoming)
    {
        if (m==0) {i.style.left = "2%";}
        if (m==1) {i.style.left = "-90%";}
        if (m==2) {i.style.left = "-180%";}
        if (m==3) {i.style.left = "-270%";}
        if (m==4) {i.style.left = "-360%";}
        if (m<0) {m=0;}
    }
}

spanweek[1].onclick = ()=>{
    n++;
    for(var i of animeweek)
    {
        if (n==0) {i.style.left = "0px";}
        if (n==1) {i.style.left = "-90%";}
        if (n==2) {i.style.left = "-180%";}
        if (n==3) {i.style.left = "-270%";}
        if (n==4) {i.style.left = "-360%";}
        if (n==5) {i.style.left = "-440%";}
        if (n>5) {n=5;}
    }
}
spanweek[0].onclick = ()=>{
    n--;
    for(var i of animeweek)
    {
        if (n==0) {i.style.left = "2%";}
        if (n==1) {i.style.left = "-90%";}
        if (n==2) {i.style.left = "-180%";}
        if (n==3) {i.style.left = "-270%";}
        if (n==4) {i.style.left = "-360%";}
        if (n<0) {n=0;}
    }
}

