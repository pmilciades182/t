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
function e__put_td(g, e, f, _p, we) {

    ///reset del f

    //console.log(f[0]);
    //console.log($(".registro").remove());
    _wait = document.getElementById('wait_');
    f[0].style.display = 'none';
    _wait.style.display = 'flex';

    $(".registro").remove();

    let loc = '../../server/entity_return.php';

    let we_n = we.length;

    //console.log('we' + we_n);

    let asx = { e: 1, p: _p };

    if (we_n == 0) {
        asx = { e: 1, p: _p, coleccion: entity };
    } else {
        asx = { e: 1, p: _p, w: we, coleccion: entity };
    }

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: asx,
        dataType: "json"
    });

    //console.log(request);

    request.done(function (d) {
        // console.log(d);
        __tab(d)
    });

    request.fail(function (jqXHR, textStatus) {
        setTimeout(function () {
            _wait.style.display = 'none';
        }, 400);
        console.log(textStatus);
    });
    ///// carga los datos a la grilla
    function __tab(d) {
        let can = 9;

        for (let i = 0; i <= can; i++) {
            let k = document.createElement("tr");

            k.classList.add("registro");

            if (d[i] !== undefined) {
                /// dos td iniciales para el check y edit
                let _a1 = document.createElement("td");
                let _a2 = document.createElement("td");
                _a1.innerHTML = '<input type="checkbox" class="_chk_delete" onchange="chk_delete(this)">';
                _a2.innerHTML = '<i class="fas fa-edit tabla_edit"></i>';
                _a1.classList.add("t_ch");
                _a2.classList.add("t_ch");


                //// formulario de edicion;
                _a2.addEventListener("click", function (e) {
                    carga_edit(d[i]);
                    mostrar_modal(5);
                }, false);

                k.appendChild(_a1);
                k.appendChild(_a2);
                for (let j = 0; j <= e.length - 1; j++) {
                    let t = e[j];
                    let r = d[i];
                    let _q = document.createElement("td");
                    //console.log(r[''+ t+'']);
                    if ((r['' + t + ''])) {
                        _q.innerText = (r['' + t + '']);
                    } else {
                        _q.innerText = '_';
                    }
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

function e__paginador(a, e, we) {

    /// vacia lista de eliminados
    ////  e__delete = [];
    ///  $("#delete_count")[0].innerText = '';


    //console.log(a.dataset.type);
    let loc = '../../server/entity_return.php';
    let cantidad = 0;

    let we_n = we.length;
    let gb = { c: 1 };

    if (we_n == 0) {
        gb = { c: 1, coleccion: entity }
    }
    else {
        gb = { c: 1, w: we, coleccion: entity }
    }

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
            e__put_td(entity, cols_grid, e__td, page, e__where);
            text_pag(page, ultima_pagina, cantidad);
            e__delete = [];
            $("#delete_count")[0].innerText = '';
        }

    }

    if (_t == 2) {
        if (page == 1) {

        } else {
            page = page - 1;
            let e__td = $("#__td");
            //console.log('segundo Boton');
            e__put_td(entity, cols_grid, e__td, page, e__where);
            text_pag(page, ultima_pagina, cantidad);
            e__delete = [];
            $("#delete_count")[0].innerText = '';
        }


    }

    if (_t == 3) {
        if (page == ultima_pagina) {

        } else {
            page = page + 1;
            let e__td = $("#__td");
            //console.log('tercer Boton');
            e__put_td(entity, cols_grid, e__td, page, e__where);
            text_pag(page, ultima_pagina, cantidad);
            e__delete = [];
            $("#delete_count")[0].innerText = '';
        }


    }

    if (_t == 4) {
        if (page == ultima_pagina) {

        }
        else {
            let e__td = $("#__td");
            //console.log('Ultimo Boton');
            e__put_td(entity, cols_grid, e__td, ultima_pagina, e__where);
            page = ultima_pagina;
            text_pag(page, ultima_pagina, cantidad);
            e__delete = [];
            $("#delete_count")[0].innerText = '';
        }

    }
    return null;
}

function e__text_paginator(e, we) {
    let loc = '../../server/entity_return.php';
    let cantidad = 0;

    let we_n = we.length;
    let yu = { c: 1 };
    if (we_n == 0) {
        yu = { c: 1, coleccion: entity };
    }
    else {
        yu = { c: 1, w: we, coleccion: entity }
    }

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: yu,
        dataType: "text",
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

    $("#go_refresh").on("click", function () {

        window.location.reload();
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
            $("#text_button_modal")[0].innerText = 'BUSCAR';
            $("#mgs_modal").css("background-color", "rgb(69 122 177 / 37%)");

            go_frm_search();

            break;
        //// exportar
        case 2:
            //// nombre del archivo
            var currentdate = new Date();
            var datetime = '_' + currentdate.getDate().toString()
                + (currentdate.getMonth() + 1).toString()
                + currentdate.getFullYear().toString()
                + currentdate.getHours().toString()
                + currentdate.getMinutes().toString()
                + currentdate.getSeconds().toString();

            $("#export_name")[0].value = entity + datetime;
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Exportar Datos';
            $("#text_button_modal")[0].innerText = 'EXPORTAR';
            $("#mgs_modal").css("background-color", "rgb(87 101 115 / 20%)");

            go_frm_export();

            break;
        ///nuevo registro
        case 3:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Nuevo Registro';
            $("#text_button_modal")[0].innerText = 'INSERTAR';

            $("#mgs_modal").css("background-color", "rgb(67 156 87 / 45%)");

            go_frm_new(cols_form);

            break;
        /// eliminar
        case 4:

            ////verifica si existen items seleccionados
            if (e__delete.length == 0) {
                mostrar_modal_error('No existen items Seleccionados para Eliminar');
                return null;
            }

            let u = e__delete.length;

            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Eliminar Registros';
            $("#text_button_modal")[0].innerText = 'ELIMINAR';

            $("#frm_delete")[0].innerText = '¿Está seguro que desea eliminar ' + u + ' registro(s)?';
            $("#mgs_modal").css("background-color", "rgb(144 45 45 / 45%)");

            go_frm_delete();


            break;
        //// editar
        case 5:
            $("#modal_title")[0].innerText = entity.toUpperCase() + ' - Editar Registro';
            $("#text_button_modal")[0].innerText = 'ACTUALIZAR';
            $("#mgs_modal").css("background-color", "rgb(0 45 45 / 45%)");

            go_frm_edit();

            break;
        default:
            $("#mgs_modal").css("background-color", "rgb(87 101 115 / 20%)");
    }

    $("#mgs_modal").css("display", "flex");

}

///// formulario nuevo registro
function go_frm_new(a) {
    frm_hide();

    //// limpia los inputs
    let ins = $("#tbl_new").find("select,textarea, input");
    let ins_detail = $("#tbl_new_detail").find("select,textarea, input");
    /// limpia los select
    $("select").empty();

    for (var i = 0; i < ins.length; i++) {
        ins[i].value = '';
        //recarga las listas
        //console.log(ins[i].tagName);
        if (ins[i].tagName == 'SELECT') {
            load_list(ins[i], ins[i].name);
        }
    }

    for (var i = 0; i < ins_detail.length; i++) {
        ins_detail[i].value = '';
        //recarga las listas
        //console.log(ins[i].tagName);
        if (ins_detail[i].tagName == 'SELECT') {
            load_list_detail(ins_detail[i], ins_detail[i].name);
        }
    }

    $("#frm_new").css("display", "flex");
}


//// se maneja desde la creacion del registr

/// queda sin efecto
function go_frm_edit(a) {
    frm_hide();
    $("#frm_edit").css("display", "flex");
}

///// formulario para eliminar registros
function go_frm_delete(a) {
    frm_hide();
    $("#frm_delete").css("display", "flex");
}

function go_frm_search(a) {
    frm_hide();
    $("#frm_search").css("display", "flex");
}

function go_frm_export(a) {
    frm_hide();
    $("#frm_export").css("display", "flex");
}

function frm_hide() {
    $("#frm_new").css("display", "none");
    $("#frm_search").css("display", "none");
    $("#frm_edit").css("display", "none");
    $("#frm_delete").css("display", "none");
    $("#frm_export").css("display", "none");
}

function e__frm_all(a, b) {
    /* generar formulario para registro nuevo */

    for (var i = 0; i < a.length; i++) {
        //console.log(a[i]);
        let campo = a[i];
        let tbl_new = $("#tbl_new")[0];
        let tbl_edit = $("#tbl_edit")[0];
        let tbl_search = $("#tbl_search")[0];

        // formulario para nuevo registro

        if (campo.new == true) {

            /// se genera la linea
            //console.log(campo.label);
            let Q = document.createElement("tr");
            Q.classList.add("frm_line");
            ///se genera la etiqueta
            let W = document.createElement("td");
            W.classList.add("frm_label");
            W.innerText = e__siglas(campo.label);
            /// se genera el input

            /// en caso de input type select
            let E = document.createElement("td");
            E.classList.add("frm_input");

            /// elemento a insertar
            let F;

            if (campo.list) {
                //console.log(campo.label)
                F = document.createElement("select");
                F.name = campo.attribute;
                load_list(F, campo.attribute);
            }
            else {
                F = document.createElement("input");
                let ipatter = return_input_pattern(campo.input_pattern);
                F.name = campo.attribute;
                F.type = ipatter.type;
                F.readOnly = ipatter.readonly;
            }


            //console.log( ipatter.readonly);


            ///hint
            let G = document.createElement("td");
            G.classList.add("frm_hint");
            G.innerText = campo.hint;

            let H = document.createElement("td");

            if (campo.required) {
                H.innerHTML = '<i class="far fa-exclamation-circle obligatorio"></i>';
                F.dataset._required = true;
            } else {
                //console.log(campo);
            }


            Q.appendChild(W);
            E.appendChild(F);
            Q.appendChild(E);
            Q.appendChild(H);
            Q.appendChild(G);
            tbl_new.appendChild(Q);

        }

        ///// formulario para editar registro
        if (campo.edit == true) {

            /// se genera la linea
            //console.log(campo.label);
            let Q = document.createElement("tr");
            Q.classList.add("frm_line");
            ///se genera la etiqueta
            let W = document.createElement("td");
            W.classList.add("frm_label");
            W.innerText = e__siglas(campo.label);
            /// se genera el input

            /// en caso de input type select
            let E = document.createElement("td");
            E.classList.add("frm_input");

            ///elemento a insertar
            let F;

            if (campo.list) {
                //console.log(campo.label)
                F = document.createElement("select");
                F.name = campo.attribute;
                load_list(F, campo.attribute);
            }
            else {
                F = document.createElement("input");
                let ipatter = return_input_pattern(campo.input_pattern);
                F.name = campo.attribute;
                F.type = ipatter.type;
                F.readOnly = ipatter.readonly;
            }


            //console.log( ipatter.readonly);


            ///hint
            let G = document.createElement("td");
            G.classList.add("frm_hint");
            G.innerText = campo.hint;

            let H = document.createElement("td");

            if (campo.required) {
                H.innerHTML = '<i class="far fa-exclamation-circle obligatorio"></i>';
                F.dataset._required = true;
            } else {
                //console.log(campo);
            }

            Q.appendChild(W);
            E.appendChild(F);
            Q.appendChild(E);
            Q.appendChild(H);
            Q.appendChild(G);
            tbl_edit.appendChild(Q);
        }

        if (campo.search == true) {

            /// se genera la linea
            //console.log(campo.label);
            let Q = document.createElement("tr");
            Q.classList.add("frm_line");
            ///se genera la etiqueta
            let W = document.createElement("td");
            W.classList.add("frm_label");
            W.innerText = e__siglas(campo.label);
            /// se genera el input

            /// en caso de input type select
            let E = document.createElement("td");
            E.classList.add("frm_input");


            let F;

            if (campo.list) {
                //console.log(campo.label)
                F = document.createElement("select");
                F.name = campo.attribute;
                load_list(F, campo.attribute);
            }
            else {
                F = document.createElement("input");
                let ipatter = return_input_pattern(campo.input_pattern);
                F.name = campo.attribute;
                F.type = ipatter.type;
                F.readOnly = ipatter.readonly;
            }


            //console.log( ipatter.readonly);


            ///hint
            let G = document.createElement("td");
            G.classList.add("frm_hint");
            G.innerText = campo.hint;

            //let H = document.createElement("td");

            Q.appendChild(W);
            E.appendChild(F);
            Q.appendChild(E);
            Q.appendChild(G);
            tbl_search.appendChild(Q);
        }
    }

    //console.log(b.length);
    ///campos detail

    for (var i = 0; i < b.length; i++) {

        let campo = b[i];
        let tbl_new_detail = $("#tbl_new_detail")[0];
        let tbl_edit_detail = $("#tbl_edit_detail")[0];
        //console.log(campo);
        if (campo.new) {
            /// se generan dos tr por campo
            /// el primero para el nombre del campo y titulo de ayuda
            /// el segundo para los valores y el texto de ayuda

            let Q = document.createElement("tr");
            let R = document.createElement("tr");

            Q.classList.add("frm_line");
            R.classList.add("frm_line");

            // primer tr

            let W = document.createElement("th");
            let X = document.createElement("th");
            W.innerText = campo.label;
            X.innerText = 'Descripcion de Ayuda';
            Q.appendChild(W);
            Q.appendChild(X);

            ///segundo tr
            let Y = document.createElement("td");
            let Z = document.createElement("td");

            Z.classList.add("frm_hint");
            Z.innerText = campo.hint;

            let F;
            F = document.createElement("select");
            F.name = campo.attribute;
            load_list_detail(F, campo.attribute);
            F.multiple = true;
            F.size = 10;

            Y.appendChild(F);

            R.appendChild(Y);
            R.appendChild(Z);


            tbl_new_detail.appendChild(Q);
            tbl_new_detail.appendChild(R);

        }

        if (campo.edit) {
            /// se generan dos tr por campo
            /// el primero para el nombre del campo y titulo de ayuda
            /// el segundo para los valores y el texto de ayuda

            let Q = document.createElement("tr");
            let R = document.createElement("tr");

            Q.classList.add("frm_line");
            R.classList.add("frm_line");

            // primer tr

            let W = document.createElement("th");
            let X = document.createElement("th");
            W.innerText = campo.label;
            X.innerText = 'Descripcion de Ayuda';
            Q.appendChild(W);
            Q.appendChild(X);

            ///segundo tr
            let Y = document.createElement("td");
            let Z = document.createElement("td");

            Z.classList.add("frm_hint");
            Z.innerText = campo.hint;

            let F;
            F = document.createElement("select");
            F.name = campo.attribute;
            load_list_detail(F, campo.attribute);
            F.multiple = true;
            F.size = 10;

            Y.appendChild(F);

            R.appendChild(Y);
            R.appendChild(Z);


            tbl_edit_detail.appendChild(Q);
            tbl_edit_detail.appendChild(R);

        }
    }


    return null;
}


//// botones del modal

function button_frm(a, b) {

    //console.log(a.dataset);

    let action = $("#text_button_modal")[0].innerText;

    switch (action) {
        case 'INSERTAR':

            //mostrar_modal_error('Error 404');
            //comprueba campos requeridos

            let _req = 1;
            let n = $("#tbl_new").find("select,textarea, input");
            let nd = $("#tbl_new_edit").find("select");

            for (var i = 0; i < n.length; i++) {
                //console.log(n[i].dataset)

                if (n[i].dataset._required) {
                    if (n[i].value.length == 0) {
                        _req = 0;
                    }
                }
            }

            if (_req == 0) {
                mostrar_modal_error('Favor completar campos Obligatorios');
                return null;
            }

            let t = $("#tbl_new").find("select,textarea, input").serializeArray();
            let td = $("#tbl_new_detail").find("select").serializeArray();

            td = merge_detail(td);

            console.log(td);

            let arr = {};

            t = t.concat(td);

            for (var i = 0; i < t.length; i++) {
                arr['' + t[i].name + ''] = t[i].value;
            }

            let y = JSON.stringify(arr);
            //console.log(y);
            let loc = '../../server/entity_return.php';
            let j = { i: 0, d: arr, coleccion: entity };
            //console.log(j);
            var request = $.ajax({
                url: loc,
                type: "POST",
                data: j,
                dataType: "text"

            });

            request.done(function (d) {
                // console.log(d);
                //console.log(d);
                frm_hide();
                cerrar_modal();
                let e__td = $("#__td");
                e__put_td(entity, cols_grid, e__td, page, e__where);
                e__text_paginator(entity, e__where);
            });

            request.fail(function (jqXHR, textStatus) {
                console.log(textStatus);
            });
            break;

        case 'ELIMINAR':

            let loc_2 = '../../server/entity_return.php';
            let g = e__delete.join();
            //console.log(g)

            let j_2 = { del: 1, d: g, coleccion: entity };

            //console.log(j_2);

            var request_2 = $.ajax({
                url: loc_2,
                type: "POST",
                data: j_2,
                dataType: "text"
            });
            request_2.done(function (d) {
                // console.log(d);
                //console.log(d);
                frm_hide();
                cerrar_modal();
                let e__td = $("#__td");
                e__put_td(entity, cols_grid, e__td, page, e__where);
                e__text_paginator(entity, e__where);
                $("#delete_count")[0].innerText = '';
                e__delete = [];
            });

            request_2.fail(function (jqXHR, textStatus) {
                console.log(textStatus);
            });

            break;


        case 'EXPORTAR':
            let loc_3 = '../../server/entity_return.php?exp=1&coleccion=' + b + '&name=';
            let xa = $("#export_name")[0].value;
            loc_3 = loc_3 + xa;

            //console.log(loc_3);
            downloadURI(loc_3, xa);
            break;

        case 'ACTUALIZAR':

            let _id = 0;
            let _req4 = 1;

            let n4 = $("#tbl_edit").find("select,textarea, input");
            let n4d = $("#tbl_edit").find("select");

            for (var i = 0; i < n4.length; i++) {
                //console.log(n[i].dataset)
                if (n4[i].name == 'id') {
                    _id = n4[i].value;
                }

                if (n4[i].dataset._required) {
                    if (n4[i].value.length == 0) {
                        _req4 = 0;
                    }
                }
            }

            if (_req4 == 0) {
                mostrar_modal_error('Favor completar campos Obligatorios');
                return null;
            }

            let t4 = $("#tbl_edit").find("select,textarea, input").serializeArray();
            let t4d = $("#tbl_edit_detail").find("select").serializeArray();

            t4d = merge_detail(t4d);

            let arr4 = {};

            t4 = t4.concat(t4d);

            for (var i = 0; i < t4.length; i++) {
                arr4['' + t4[i].name + ''] = t4[i].value;
            }

            let y4 = JSON.stringify(arr4);
            //console.log(y);
            let loc4 = '../../server/entity_return.php';
            let j4 = { u: 0, d: arr4, id: _id, coleccion: entity };
            //console.log(j);
            var request = $.ajax({
                url: loc4,
                type: "POST",
                data: j4,
                dataType: "json"

            });

            request.done(function (d) {
                //console.log(d);
                //console.log(d);
                frm_hide();
                cerrar_modal();
                let e__td = $("#__td");
                e__put_td(entity, cols_grid, e__td, page, e__where);
                e__text_paginator(entity, e__where);
            });

            request.fail(function (jqXHR, textStatus) {
                console.log(textStatus);
            });

            break;

        case 'BUSCAR':

            let t5 = $("#tbl_search").find("select,textarea, input").serializeArray();

            let arr5 = {};

            for (var i = 0; i < t5.length; i++) {
                if (t5[i].value != '') {
                    arr5['' + t5[i].name + ''] = t5[i].value;
                }

            }

            e__where = JSON.stringify(arr5);

            //console.log(e__where);

            frm_hide();
            cerrar_modal();
            let e__td = $("#__td");
            e__put_td(entity, cols_grid, e__td, page, e__where);
            e__text_paginator(entity, e__where);

            break;
    }

}

//carga las listas select segun la entidad
function load_list(a, b) {

    let loc = '../../server/entity_return.php';

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { e: 1, p: 1, detail: 1, coleccion: b },
        dataType: "json",
        async: false
    });

    //console.log(request);

    request.done(function (v) {
        // console.log(d);
        //console.log(v);
        __tab(v);
    });

    function __tab(v) {

        //console.log(v);
        //console.log(a);
        a.options.add(new Option('Seleccione...', ''));

        for (let i = 0; i <= v.length - 1; i++) {


            let r = v[i];
            //console.log(r);

            let c = (r['id']);
            let d = (r['descripcion']);
            a.options.add(new Option(d, d));

        }
    }
}

//carga las listas select segun la entidad
function load_list_detail(a, b) {

    let loc = '../../server/entity_return.php';

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: { e: 1, p: 1, detail: 1, coleccion: b },
        dataType: "json",
        async: false
    });

    //console.log(request);

    request.done(function (v) {
        // console.log(d);
        //console.log(v);
        __tab(v);
    });

    function __tab(v) {

        // console.log(v);
        // console.log(a);



        for (let i = 0; i <= v.length - 1; i++) {


            let r = v[i];
            //console.log(r);

            let c = (r['id']);
            let d = (r['descripcion']);
            a.options.add(new Option(d, d));

        }
    }
}

function mostrar_modal_error(m) {
    $("#md_body_err")[0].innerText = m;

    $("#mgs_error").css("display", "flex");

}

function cierra_error() {
    $("#mgs_error").css("display", "none");
}

/// carga el array de elementos a eliminar
function chk_delete(e) {

    //console.log(e.checked);

    if (e.checked) {
        e.parentElement.parentElement.classList.add('deletable');
        let i = e.parentElement.parentElement.children[2].innerText;
        i = parseInt(i);

        e__delete.indexOf(i) === -1 ? e__delete.push(i) : null;

        //console.log(e__delete);

    } else {
        e.parentElement.parentElement.classList.remove('deletable');
        let i = e.parentElement.parentElement.children[2].innerText;
        i = parseInt(i);
        e__delete.remove(i);
        //console.log(e__delete);
    }

    //// contador de eliminados
    if (e__delete.length == 0) {
        $("#delete_count")[0].innerText = '';
    } else {
        $("#delete_count")[0].innerText = ' (' + e__delete.length + ')';
    }

}

//// crea el remove para los arrays
Array.prototype.remove = function () {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

/// utilizadi en el boton exportar
function downloadURI(uri, name) {
    //console.log('a');
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;
}

function carga_edit(e) {

    let ins = $("#tbl_edit").find("select,textarea, input");
    let ins_detail = $("#tbl_edit_detail").find("select");

    /// limpia los select
    $("select").empty();

    for (var i = 0; i < ins.length; i++) {
        //recarga las listas
        //console.log(ins[i].tagName);
        if (ins[i].tagName == 'SELECT') {
            load_list(ins[i], ins[i].name);
        }
    }

    for (var i = 0; i < ins_detail.length; i++) {
        //recarga las listas
        //console.log(ins[i].tagName);
        if (ins_detail[i].tagName == 'SELECT') {
            load_list_detail(ins_detail[i], ins_detail[i].name);
        }
    }

    //console.log(e['id']);

    let n = $("#tbl_edit").find("select,textarea, input");
    let nd = $("#tbl_edit_detail").find("select");

    for (var i = 0; i < n.length; i++) {
        //console.log(n[i].dataset)

        if (ins[i].tagName == 'SELECT') {

            let h = n[i].name;

            let t = ins[i].options;
            let x = e['' + h + ''];

            //console.log(t);
            //console.log(t.length);

            for (let r = 0; r < t.length; r++) {
                //console.log('a');
                // console.log(t[r]);

                if (t[r].innerText == x) {
                    t[r].selected = true;
                }
            }
        } else {
            let h = n[i].name;
            n[i].value = e['' + h + ''];
        }
    }

    for (var i = 0; i < nd.length; i++) {
        //console.log(n[i].dataset)

        if (ins_detail[i].tagName == 'SELECT') {

            let h = nd[i].name;

            let t = ins_detail[i].options;
            let x = e['' + h + ''];

            //console.log(x);
            //console.log(t);
            //console.log(t.length);

            for (let r = 0; r < t.length; r++) {

                //console.log(t[r].innerText);

                if (x) {

                    if (x.toString().includes(t[r].innerText.toString())) {
                        t[r].selected = true;
                        //console.log('a');
                    }

                }
            }
        }
    }
}


///// funcion que oculta master detail 

function e__hide_master_detail(e) {
    if (e == 0 || e == undefined) {
        let nc = $("#new_tab_select_master");
        let nd = $("#new_tab_select_detail");
        let nt = $("#new_tab_detail");
        let ec = $("#edit_tab_select_master");
        let ed = $("#edit_tab_select_detail");
        let et = $("#edit_tab_detail");

        nc.css("display", "none");
        nd.css("display", "none");
        nt.css("display", "none");
        ec.css("display", "none");
        ed.css("display", "none");
        et.css("display", "none");

    }
}



function merge_detail(e) {

    let _new = [];

    //console.log(e);

    for (let i = 0; i < e.length; i++) {
        let _name = e[i].name;
        let check_1 = _new.find(o => o.name === _name);
        //console.log(check_1);

        if (check_1 === undefined) {

            _new.push({
                name: e[i].name,
                value: e[i].value
            });

        } else {
            check_1.value = check_1.value + ',' + e[i].value;
        }


    }


    //console.log(_new);

    return _new;
}


