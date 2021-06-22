function e__put_th(e, f) {
    let k = document.createElement("th");
    let h = document.createElement("th");

    f[0].appendChild(k);
    f[0].appendChild(h);

    e.forEach(function (m) {
        k = document.createElement("th");
        m = capitalizeTheFirstLetterOfEachWord(m);
        k.innerHTML = m;
        //console.log(f);
        f[0].appendChild(k);
    });

}

function capitalizeTheFirstLetterOfEachWord(words) {
<<<<<<< HEAD
    words = words.replace('_',' ');
=======

    words = words.replace('_', ' ');

>>>>>>> 2c32bb705bb7fe27de1777a9e130192881d14a48
    var separateWord = words.toLowerCase().split(' ');

    for (var i = 0; i < separateWord.length; i++) {
        separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
            separateWord[i].substring(1);
    }

    let g = separateWord.join(' ');
    g = e__siglas(g);
    return g;
}

////funcion que hace mayusculas a siglas

function e__siglas(e) {

    if (e.toUpperCase() == 'ID' ||
        e.toUpperCase() == 'RUC'
    ) {
       // console.log(e);
        e = e.toUpperCase();

    }

    return e;

}