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
    words = words.replace('_', ' ');
    var separateWord = words.toLowerCase().split(' ');
    for (var i = 0; i < separateWord.length; i++) {
        separateWord[i] = separateWord[i].charAt(0).toUpperCase() + separateWord[i].substring(1);
    }
    let g = separateWord.join(' ');
    g = e__siglas(g);
    return g;
}

////funcion que hace mayusculas a siglas
function e__siglas(e) {
    if (e.toUpperCase() == 'ID' ||
        e.toUpperCase() == 'RUC') { e = e.toUpperCase(); }
    return e;
}

///carga los datos a la tabla
function e__put_td(g, e, f) {

    let loc = 'model_' + g + '.php';

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { e: 1 },
        dataType: "json"
    });

    request.done(function (d) {
        // console.log(d);
        __tab(d)
    });

    request.fail(function (jqXHR, textStatus) {
        console.log(textStatus);
    });

    function __tab(d) {
        let can = 9;

        for (let i = 0; i <= can; i++) {
            let k = document.createElement("tr");
            if (d[i] !== undefined) {
                /// dos td iniciales para el check y edit
                let _a1 = document.createElement("td");
                let _a2 = document.createElement("td");
                _a1.innerHTML = '<input type="checkbox">';
                _a2.innerHTML = '<i class="fas fa-edit tabla_edit"></i>';
                _a1.classList.add("t_ch");
                _a2.classList.add("t_ch");

                _a2.addEventListener("click", function (e) {
                    mostrar_modal(4);
                }, false);

                k.appendChild(_a1);
                k.appendChild(_a2);
                for (let j = 0; j <= e.length - 1; j++) {
                    let t = e[j];
                    let r = d[i];
                    let _q = document.createElement("td");
                    //console.log(r[''+ t+'']);
                    _q.innerText = (r['' + t + '']);
                    k.appendChild(_q);
                }
            }
            else {
                let _a1 = document.createElement("td");
                let _a2 = document.createElement("td");
                k.appendChild(_a1);
                k.appendChild(_a2);
                for (let i = 0; i <= e.length - 1; i++) {
                    let _q = document.createElement("td");
                    k.appendChild(_q);
                }
            }

            f[0].appendChild(k);
            //console.log(d[i]);
            //console.log(e[i]);
        }
    }

    return null;

}


function e__pagination(e, f) {
    let loc = 'model_' + e + '.php';

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { c: 1 },
        dataType: "json"
    });

    request.done(function (d) {
        // console.log(d);
        __pag(d)
    });

    request.fail(function (jqXHR, textStatus) {
        console.log(textStatus);
    });

    function __pag(i) {
        let cant_pages = Math.ceil(i / 10);
        console.log(cant_pages);

        for (let i = 1; i <= cant_pages; i++) {
            let pg = document.createElement("div");
            pg.classList.add("pagination");
            if (i == 1) {
                pg.classList.add("current");
            }
            pg.innerText = i;

            f[0].appendChild(pg);

        }

    }

    return null;
}