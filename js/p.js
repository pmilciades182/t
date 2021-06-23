////GLOBALES

/// array que contiene las pestañas
var arr_pes = [0];

//// inicio
$(document).ready(function () {
    let usr = 'ADMIN';
    carga_menu(usr);

});

///cargar el menu
function carga_menu(u) {

    u;

    $.getJSON("js/menu.json", function (data) {
        // console.log(data);

        let li = null;
        let i = null;
        let t = null;

        let _class = null;
        let _class2 = null;
        let _data_prog = null;
        let _data_id = null;
        let _data_tit_pes = null;
        let _icono = null;
        let _titulo = null;
        let _tipo = null;

        let cab = document.getElementById("menu_ca");

        $.each(data, function (key, val) {

            //console.log(  val[0]);

            t = val[0];

            _tipo = t._tipo;
            _class = t._class;
            _class2 = t._class2;
            _data_prog = t._data_prog;
            _data_id = t._data_id;
            _data_tit_pes = t._data_tit_pes;
            _icono = t._icono;
            _titulo = t._titulo;


            /// Menus para Abrir programas
            if (_tipo == 1) {
                li = document.createElement("li");
                i = document.createElement("i");
                li.classList.add(_class);
                li.dataset.prog = _data_prog;
                li.dataset.id = _data_id;
                li.dataset.tit_pes = _data_tit_pes;

                li.onclick = function () {
                    abre_prog(this);
                };

                i.classList.add("fas");
                i.classList.add("fa-" + _icono);
                li.appendChild(i);
                li.innerHTML += '&nbsp&nbsp&nbsp' + _titulo;
                cab.appendChild(li);
            }

            /// Titulos en Menu
            if (_tipo == 2) {

                li = document.createElement("li");

                li.classList.add(_class);
                li.classList.add(_class2);
                li.innerHTML += '&nbsp&nbsp&nbsp' + _titulo;
                cab.appendChild(li);

            }


        });

    });

}

/// verifica en global de pestañas
function is_pes(e) {
    return arr_pes.includes(e);
}

/// abre un programa
function abre_prog(e) {
    let id = e.dataset.id;
    let pr = e.dataset.prog;

    if (is_pes(id) == true) {
        let n = document.querySelectorAll('[data-id_sp="' + id + '"]')[0];
        n.click();

    }
    else {
        go_program(pr, id);
        inserta_pest(e);
        arr_pes.push(id);
    }
}

//// css inactivado a pestañas
function inactive_all_pes() {
    var m = document.querySelectorAll('.rc');
    //console.log(m);

    m.forEach(function (e) {
        e.classList.remove("active");
    });
}

/// inserta una pestaña
function inserta_pest(e) {
    /// inactiva css todas las pestañas
    inactive_all_pes();


    let id = e.dataset.id;
    let ti = e.dataset.tit_pes;
    let pr = e.dataset.prog;

    let g = document.getElementById("r");
    let f = document.createElement("div");
    let s = document.createElement("span");

    /// pestaña

    f.id = "r1";
    f.classList.add("rc");
    f.classList.add("active");
    f.dataset.id = id;


    /// span para texto
    s.innerText = ti + '\xA0 \xA0';
    s.classList.add("sp_pest");
    s.dataset.prog = pr;
    s.dataset.id_sp = id;

    f.appendChild(s);

    ///boton para cerrar

    let b = document.createElement("i");
    b.classList.add("fas");
    b.classList.add("fa-times-circle");
    b.classList.add("bot_pes");

    ///click en cerrar pestaña

    b.addEventListener("click", function (e) {
        //console.log(e.path[1]);
        ///cierra la pestaña

        let path = e.path || (e.composedPath && e.composedPath());

        path[1].remove();
        let id = path[1].dataset.id;
        ///saca del global de pestañas
        arr_pes.remove(id);
        //console.log( e.path[1].dataset.id);

        ///cierra programa
        //go_program(0,e.path[1].dataset.id);

        var n = document.querySelectorAll('[data-id_ifr="' + id + '"]')[0];
        n.remove();

    }, false);


    f.appendChild(b);

    ///click en pestaña
    s.addEventListener("click", function (e) {

        let path = e.path || (e.composedPath && e.composedPath());

        let a = path[1];
        //console.log(a);
        inactive_all_pes();
        a.classList.add("active");
        let id = path[1].dataset.id;
        focus_program(id);
    }, false);

    //console.log(f);
    //insertAfter(f,g);
    g.appendChild(f);
}

//// click en pestaña
function focus_program(id) {
    var m = document.querySelectorAll('.programa');
    //console.log(m);

    m.forEach(function (e) {
        e.classList.remove("active");
    });

    var n = document.querySelectorAll('[data-id_ifr="' + id + '"]')[0];
    n.classList.add("active");

}

/// insertar elemento en otro
function insertAfter(newNode, referenceNode) {
    referenceNode.append = newNode;
}

///abrir programa
function go_program(p, id) {
    ///crea los elementos
    let d = document.createElement("div");
    let f = document.createElement("iframe");

    let e = document.getElementById("e2");

    d.classList.add("programa");
    d.classList.add("active");
    d.dataset.id_ifr = id;

    d.id = id;

    f.classList.add("frame");

    var g = '';

    if (p == 0) {
        g = '';
    }
    else {
        g = 'app/' + p;
    }

    f.src = g;

    var m = document.querySelectorAll('.programa');
    //console.log(m);

    m.forEach(function (e) {
        e.classList.remove("active");
    });

    d.appendChild(f);
    e.appendChild(d);

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

////para cerrar sesion
function cerrar_sess() {
    window.location.replace("http://localhost/t");
}


/// buscador del menu
$("#busc_menu").on("input", function (e) {

    var input = $(this);
    var val = input.val().toUpperCase().trim();

    if (input.data("lastval") != val) {
        input.data("lastval", val);

        if (val.length > 0) {
            ///buscar
            let c = $("#menu_ca");
            let b = $("#menu_bus");

            c.hide();
            b.show();
            b.empty();


            let li = document.createElement("li");

            li.classList.add("li_de");
            li.classList.add("tit");
            li.innerHTML += ' Buscando...';

            $(li).appendTo($(b));

            if (val.length > 2) {
                let _l = c.find("li");
                //console.log(_l);

                jQuery.each(_l, function (i, it) {
                    let v = it.innerText.toUpperCase().trim();
                    //console.log( $(it).hasClass( "tit" ))

                    if (v.includes(val) && $(it).hasClass("tit") == false) {
                        //console.log($(it));
                        let h = $(it).clone();
                        h.appendTo($(b));
                        h.on("click", function () {
                            abre_prog(this);
                        });
                    }

                });
            }

        }
        else {
            ///mostrar menu normal
            $("#menu_ca").show();
            $("#menu_bus").hide();
        }

    }

});

////crea el trim si es necesario
if (!String.prototype.trim) {
    (function () {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function () {
            return this.replace(rtrim, '');
        };
    })();
}


