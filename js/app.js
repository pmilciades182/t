///carga los titulos de las tablas
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

///mayusculas a la primera letra
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
function e__put_td(g, e, f, _p) {

    ///reset del f

    //console.log(f[0]);
    //console.log($(".registro").remove());
    $(".registro").remove();

    let loc = 'model_' + g + '.php';

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { e: 1, p: _p },
        dataType: "json"
    });

    //console.log(request);

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

            k.classList.add("registro");

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

function e__paginador(a, e) {

    //console.log(a.dataset.type);
    let loc = 'model_' + e + '.php';
    let cantidad = 0;

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { c: 1 },
        dataType: "json",
        async: false
    });

    request.done(function (d) {
        // console.log(d);
        cantidad = d;
    });
    request.fail(function (jqXHR, textStatus) {
        console.log(textStatus);
    });

    //console.log('registros ' + cantidad);
    //console.log('pagina ' + page);

    let _t = a.dataset.type;

    let ultima_pagina = Math.ceil(cantidad / 10);

    if (_t == 1) {
        if (page == 1) {

        } else {
            page = 1;
            let e__td = $("#__td");
            //console.log('Primer Boton');
            e__put_td(entity, cols_grid, e__td, page);
            text_pag(page,ultima_pagina,cantidad);
        }

    }

    if (_t == 2) {
        if (page == 1) {

        } else {
            page = page - 1;
            let e__td = $("#__td");
            //console.log('segundo Boton');
            e__put_td(entity, cols_grid, e__td, page);
            text_pag(page,ultima_pagina,cantidad);
        }


    }

    if (_t == 3) {
        if (page == ultima_pagina) {

        } else {
            page = page + 1;
            let e__td = $("#__td");
            //console.log('tercer Boton');
            e__put_td(entity, cols_grid, e__td, page);
            text_pag(page,ultima_pagina,cantidad);
        }


    }

    if (_t == 4) {
        if (page == ultima_pagina) {

        }
        else {
            let e__td = $("#__td");
            //console.log('Ultimo Boton');
            e__put_td(entity, cols_grid, e__td, ultima_pagina);
            page = ultima_pagina;
            text_pag(page,ultima_pagina,cantidad);
        }

    }
    return null;
}

function e__text_paginator(e)
{
    let loc = 'model_' + e + '.php';
    let cantidad = 0;

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { c: 1 },
        dataType: "json",
        async: false
    });

    request.done(function (d) {
        // console.log(d);
        cantidad = d;
    });
    request.fail(function (jqXHR, textStatus) {
        console.log(textStatus);
    });

    let ultima_pagina = Math.ceil(cantidad / 10);

    text_pag(1,ultima_pagina,cantidad)

}

/// pagina actual, ultima pagina, cantidad de registros

function text_pag(a,b,c)
{
    let g = $("#text_paginator");
    //console.log(g);

    let r = 1;
    let s = 10;

    b ;
    
    if(a == 1)
    {
        r = 1;
        s = 10;
    }
    else
    {
        r = ((a - 1) * 10) + 1;
        s = r + 9;
    }

    if(a==b)
    {
        if(a == 1)
        {
            r = 1;
            s = c;
        }else
        {
            r = ((a - 1) * 10) + 1;
            s = c ;
        }
    }

    ///ultima pagina

    

    let tt = 'Registros [ ' + r + ' al ' + s + ' ] de [ ' + c + ' ]' ;
    g[0].innerText = tt;

}


