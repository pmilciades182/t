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
    _wait = document.getElementById('wait_');
    f[0].style.display = 'none';
    _wait.style.display = 'flex';

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
                    mostrar_modal(5);
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
            f[0].style.display = 'block';


            setTimeout(function () {
                _wait.style.display = 'none';
            }, 400);

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
            text_pag(page, ultima_pagina, cantidad);
        }

    }

    if (_t == 2) {
        if (page == 1) {

        } else {
            page = page - 1;
            let e__td = $("#__td");
            //console.log('segundo Boton');
            e__put_td(entity, cols_grid, e__td, page);
            text_pag(page, ultima_pagina, cantidad);
        }


    }

    if (_t == 3) {
        if (page == ultima_pagina) {

        } else {
            page = page + 1;
            let e__td = $("#__td");
            //console.log('tercer Boton');
            e__put_td(entity, cols_grid, e__td, page);
            text_pag(page, ultima_pagina, cantidad);
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
            text_pag(page, ultima_pagina, cantidad);
        }

    }
    return null;
}

function e__text_paginator(e) {
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

    text_pag(1, ultima_pagina, cantidad)

}

/// pagina actual, ultima pagina, cantidad de registros

function text_pag(a, b, c) {
    let g = $("#text_paginator");
    //console.log(g);

    let r = 1;
    let s = 10;

    b;

    if (a == 1) {
        r = 1;
        s = 10;
    }
    else {
        r = ((a - 1) * 10) + 1;
        s = r + 9;
    }

    if (a == b) {
        if (a == 1) {
            r = 1;
            s = c;
        } else {
            r = ((a - 1) * 10) + 1;
            s = c;
        }
    }

    ///ultima pagina



    let tt = 'Registros [ ' + _zx(r) + ' al ' + _zx(s) + ' ] de [ ' + _zx(c) + ' ]';
    g[0].innerText = tt;

}

/// funcion para igualar los numeros de la paginacion
function _zx(e) {
    if (e >= 0 && e < 10) {
        e = '\xa0\xa0\xa0\xa0' + e;
    }

    if (e >= 10 && e < 100) {
        e = '\xa0\xa0\xa0' + e;
    }

    if (e >= 100 && e < 1000) {
        e = '\xa0\xa0' + e;
    }

    if (e >= 1000 && e < 10000) {
        e = '\xa0' + e;
    }


    return e

}


////funciones del modal

$(document).ready(function () {

    $("#close_modal").on("click", function () {

        cerrar_modal();

    });

    $("#go_busq").on("click", function () {

        mostrar_modal(1);
    });

    $("#go_exp").on("click", function () {

        mostrar_modal(2);
    });

    $("#go_new").on("click", function () {

        mostrar_modal(3);
    });

    $("#go_delete").on("click", function () {

        mostrar_modal(4);
    });


    $(".tabla_edit").on("click", function () {

        mostrar_modal(5);
    });



});


function cerrar_modal() {

    $("#mgs_modal").css("display", "none");

}

//// mostrar modal
//// - tipo
function mostrar_modal(t) {

    switch (t) {
        //// busqueda avanzada
        case 1:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Búsqueda Avanzada';
            $("#mgs_modal").css("background-color", "rgb(69 122 177 / 37%)");
            break;
        //// exportar
        case 2:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Exportar Datos';
            $("#mgs_modal").css("background-color", "rgb(87 101 115 / 20%)");
            break;
        ///nuevo registro
        case 3:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Nuevo Registro';
            $("#mgs_modal").css("background-color", "rgb(67 156 87 / 45%)");
            break;
        /// eliminar
        case 4:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Eliminar Registros';
            $("#mgs_modal").css("background-color", "rgb(144 45 45 / 45%)");
            break;
        //// editar
        case 5:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Editar Registro';
            $("#mgs_modal").css("background-color", "rgb(0 45 45 / 45%)");
            break;
        default:
            $("#mgs_modal").css("background-color", "rgb(87 101 115 / 20%)");
    }

    $("#mgs_modal").css("display", "flex");

}



