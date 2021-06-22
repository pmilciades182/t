function e__put_th(e,f)
{
    let k = document.createElement("th");
    let h = document.createElement("th");
    f[0].appendChild(k);
    f[0].appendChild(h);
    e.forEach(function (m) 
    {
        k = document.createElement("th");
        m = capitalizeTheFirstLetterOfEachWord(m);
        k.innerHTML = m;
        console.log(f);
        f[0].appendChild(k);
    });

}

function capitalizeTheFirstLetterOfEachWord(words) {
    words = words.replace('_',' ');
    var separateWord = words.toLowerCase().split(' ');
    for (var i = 0; i < separateWord.length; i++) {
       separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
       separateWord[i].substring(1);
    }
    return separateWord.join(' ');
 }