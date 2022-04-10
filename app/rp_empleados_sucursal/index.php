<?php
const APP_ID = 5;
include_once('../../server/_rpt_index.php');
?>


<div class="dsb_con tent">
    <div class="dsb_line"> 
        <div class="dsb_card dsb_card1b"> 
            <span> Seleccionar Sucursal :</span> 

            <select id="sucursales" ></select>

            <div class="agrupador" onclick='go_cargar(this)'>
                    <div> &nbsp&nbsp <span>CAGAR </span>&nbsp&nbsp </div>
            </div>
        </div>
    </div>

    <div class="dsb_line"> 
        <div class="dsb_card dsb_card1" id='content_sucursales'> 
            <div id="t_hea" class="noselect">
                <div class="agrupador">
                    <div> &nbsp&nbsp <span> ASISTENCIA SEMANA ACTUAl </span>&nbsp&nbsp </div>
                </div>
            </div>

            <table id="ta_date"> 
                <tbody id="__td_date">
                    <tr id="__th_date">
                        <th colspan='8' class="tab_title">

                            <span class="t_emoji" onclick="mueve_semana(-1)"> &#9194; </span> 
                            <span> AÑO <span id="l_anho_actual"> ... </span> - SEMANA <span id="l_semana_actual"> ... </span> </span> 
                            <span class="t_emoji" onclick="mueve_semana(1)"> &#9193; </span> 

                        </th>
                    </tr>
                       
                    <tr id="__th_date2"></tr>


                </tbody>
            </table>

        </div>
    </div>
</div>
<script src="../../js/alert.js"></script>
<script>

content_sucursales.style.display = 'none';

/// globales

let gg_year = 2022;
let gg_week = 1;
let gg_sucursal = 0;

$( document ).ready(function() {
   
    let list_sucursal = document.getElementById('sucursales');
    load_list(list_sucursal, 'sucursal') ;

});


function go_cargar()
{
   let sucursal =  $('#sucursales option:selected').val();

   gg_sucursal = sucursal;
   
   //console.log(sucursal);
  // console.log(getWeekNumber(new Date()));

   if(sucursal != '')
   {
        content_sucursales.style.display = 'flex';
        ///sucursal actual
        //console.log(sucursal);

        /// anho semana actual
        let data_week = getWeekNumber(new Date());
        //console.log(data_week);
        gg_year = data_week[0];
        gg_week = data_week[1];

        /// completa las fechas de la cabecera
        cabecera_de_fechas(gg_year,gg_week);

        //// obtener listado de empleados de la sucursal
        carga_empleados(sucursal,gg_year,gg_week);

   }
   else
   {
        content_sucursales.style.display = 'none';
   }

}

function cabecera_de_fechas(year,week)
{

        //// nombre en la linea
        
        l_anho_actual.innerHTML = year;
        l_semana_actual.innerHTML =week;

        //console.log(getDateOfISOWeek(week, year));

        let f_lu = formateo_fecha(getDateOfISOWeek(week, year,0) );
        let f_ma = formateo_fecha(getDateOfISOWeek(week, year,1) );
        let f_mi = formateo_fecha(getDateOfISOWeek(week, year,2) );
        let f_ju = formateo_fecha(getDateOfISOWeek(week, year,3) );
        let f_vi = formateo_fecha(getDateOfISOWeek(week, year,4) );
        let f_sa = formateo_fecha(getDateOfISOWeek(week, year,5) );
        let f_do = formateo_fecha(getDateOfISOWeek(week, year,6) );
        

        ///genera la tabla de semana actual y otros

        $(".clase_fecha_cabecera").remove();

        let tab_date =  document.getElementById('__th_date2');

        let vacio1   = document.createElement("th");
        let dia1     = document.createElement("th");
        let dia2     = document.createElement("th");
        let dia3     = document.createElement("th");
        let dia4     = document.createElement("th");
        let dia5     = document.createElement("th");
        let dia6     = document.createElement("th");
        let dia7     = document.createElement("th");

        dia1.innerHTML = 'LUNES <br>' + f_lu;
        dia2.innerHTML = 'MARTES <br>' + f_ma;
        dia3.innerHTML = 'MIERCOLES <br>' + f_mi;
        dia4.innerHTML = 'JUEVES <br>' + f_ju;
        dia5.innerHTML = 'VIERNES <br>' + f_vi;
        dia6.innerHTML = 'SABADO <br>' + f_sa;
        dia7.innerHTML = 'DOMINGO <br>' + f_do;
        vacio1.innerHTML = 'EMPLEADO <br>';

        dia1.classList.add("clase_fecha_cabecera");
        dia2.classList.add("clase_fecha_cabecera");
        dia3.classList.add("clase_fecha_cabecera");
        dia4.classList.add("clase_fecha_cabecera");
        dia5.classList.add("clase_fecha_cabecera");
        dia6.classList.add("clase_fecha_cabecera");
        dia7.classList.add("clase_fecha_cabecera");
        vacio1.classList.add("clase_fecha_cabecera");

        tab_date.appendChild(vacio1);
        tab_date.appendChild(dia1);
        tab_date.appendChild(dia2);
        tab_date.appendChild(dia3);
        tab_date.appendChild(dia4);
        tab_date.appendChild(dia5);
        tab_date.appendChild(dia6);
        tab_date.appendChild(dia7);


}

function formateo_fecha(f){
    let r =  f.getDate() + '/' + (f.getMonth()+1);
    return r ; 
}

function getDateOfISOWeek(w, y,p) {
    var simple = new Date(y, 0, 1 + (w - 1) * 7);
    var dow = simple.getDay();
    var ISOweekStart = simple;

    if (dow <= 4){
        ISOweekStart.setDate(simple.getDate() - simple.getDay() + 1 );
    }
    else{
        ISOweekStart.setDate(simple.getDate() + 8 - simple.getDay() );
    }
    ISOweekStart.setDate(ISOweekStart.getDate()  + p );
    return ISOweekStart;
}

function carga_empleados(sucursal){

    /// borra registros de empleados cargados anteriormente
    $(".clase_registro_empleado").remove();

   let loc = '../../server/entity_return.php';

   entity = 'persona';

   let  we_ = '{"sucursal":"'+sucursal+'"}';

   asx = { e: 1, p: 1, coleccion: entity , detail:1 , w:we_ };

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: asx,
        dataType: "json"
    });

    //console.log(request);

    request.done(function (d) {
       //  console.log(d);
        __tab_empleados(d);

    });

    request.fail(function (jqXHR, textStatus) {
        /*setTimeout(function () {
            _wait.style.display = 'none';
        }, 400);*/
        console.log(textStatus);
    });

}

function  __tab_empleados(d){
    


    let tab_emp =  document.getElementById('__td_date');

    //console.log(d);

    for (let i = 0; i <= d.length ; i++) {

        if( d[i] ){

            let _tr         = document.createElement("tr");
            _tr.classList.add("clase_registro_empleado");

            let _td_persona     = document.createElement("td");
            let _td_lunes       = document.createElement("td");
            let _td_martes      = document.createElement("td");
            let _td_miercoles   = document.createElement("td");
            let _td_jueves      = document.createElement("td");
            let _td_viernes     = document.createElement("td");
            let _td_sabado      = document.createElement("td");
            let _td_domingo     = document.createElement("td");

            
            let content_lu = makeRadioButton('ll' + d[i].nombre  , d[i].id ,1) ;
            let content_ma = makeRadioButton('mm' + d[i].nombre  , d[i].id ,2) ;
            let content_mi = makeRadioButton('mi' + d[i].nombre  , d[i].id ,3) ;
            let content_ju = makeRadioButton('jj' + d[i].nombre  , d[i].id ,4) ;
            let content_vi = makeRadioButton('vv' + d[i].nombre  , d[i].id ,5) ;
            let content_sa = makeRadioButton('ss' + d[i].nombre  , d[i].id ,6) ;
            let content_do = makeRadioButton('dd' + d[i].nombre  , d[i].id ,7) ;
            
            //console.log(d[i]);

            _td_persona.innerHTML = d[i].nombre + ' ' + d[i].apellido ; 

            _td_lunes.appendChild(content_lu);
            _td_martes.appendChild(content_ma);
            _td_miercoles.appendChild(content_mi);
            _td_jueves.appendChild(content_ju);
            _td_viernes.appendChild(content_vi);
            _td_sabado.appendChild(content_sa);
            _td_domingo.appendChild(content_do);

          
            _tr.appendChild(_td_persona);
            _tr.appendChild(_td_lunes);
            _tr.appendChild(_td_martes);
            _tr.appendChild(_td_miercoles);
            _tr.appendChild(_td_jueves);
            _tr.appendChild(_td_viernes);
            _tr.appendChild(_td_sabado);
            _tr.appendChild(_td_domingo);

            tab_emp.appendChild(_tr);

        }
    }

 
}




function makeRadioButton(name,id,day) {

    let ffl = document.createElement("form");

    ffl.style.display = 'flex';
    ffl.style.flexDirection = 'column';

    var label1 = document.createElement("label");
    var label2 = document.createElement("label");
    var label3 = document.createElement("label");

    var radio1 = document.createElement("input");
    var radio2 = document.createElement("input");
    var radio3 = document.createElement("input");

    radio1.type = "radio";
    radio2.type = "radio";
    radio3.type = "radio";

    radio1.name = name;
    radio2.name = name;
    radio3.name = name;

    radio1.value = 1;
    radio2.value = 2;
    radio3.value = 3;

    radio1.dataset.id = id;
    radio1.dataset.day = day;
    radio1.dataset.week = gg_week;
    radio1.dataset.year = gg_year;

    radio2.dataset.id = id;
    radio2.dataset.day = day;
    radio2.dataset.week = gg_week;
    radio2.dataset.year = gg_year;

    radio3.dataset.id = id;
    radio3.dataset.day = day;
    radio3.dataset.week = gg_week;
    radio3.dataset.year = gg_year;

    ///checkear los registros ya seleccionados con anterioridad

    load_turno(1,id,day,gg_week,gg_year,radio1);
    load_turno(2,id,day,gg_week,gg_year,radio2);
    load_turno(3,id,day,gg_week,gg_year,radio3);

    radio1.addEventListener("click", function (e) {actualiza_turno(this);}, false);
    radio2.addEventListener("click", function (e) {actualiza_turno(this);}, false);
    radio3.addEventListener("click", function (e) {actualiza_turno(this);}, false);

    label1.appendChild(radio1);
    label2.appendChild(radio2);
    label3.appendChild(radio3);

    label1.appendChild(document.createTextNode('MAÑANA'));
    label2.appendChild(document.createTextNode('TARDE'));
    label3.appendChild(document.createTextNode('NOCHE'));

    ffl.appendChild(label1);
    ffl.appendChild(label2);
    ffl.appendChild(label3);

    return ffl;
}

function load_turno(turno,id,day,gg_week,gg_year,radio1)
{
    //console.log('a');

    let loc = '../../server/entity_return.php';
    entity = 'persona_turno';
    let  we_ = '{"turno":"'+turno+'","persona":"'+id+'","dia":"'+day+'","semana":"'+gg_week+'","anho":"'+gg_year+'"}';
    //console.log(we_);
    asx = { e: 1, p: 1, coleccion: entity , detail:1 , w:we_ };
    var request = $.ajax({
        url: loc,
        type: "POST",
        data: asx,
        dataType: "json"
    });
    //console.log(request);
    request.done(function (d) {
         if(d[0]){
            radio1.checked = true;
         }
    });
  
}


function getWeekNumber(d) {
  d = new Date(+d);
  d.setHours(0, 0, 0, 0);
  d.setDate(d.getDate() + 4 - (d.getDay() || 7));
  var yearStart = new Date(d.getFullYear(), 0, 1);
  var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7)
  return [d.getFullYear(), weekNo];
}


function actualiza_turno(e){
    console.log(e.dataset);

    let loc = '../../server/entity_return.php';
    entity = 'persona_turno';

    let turno = e.value;
    let id = e.dataset.id;
    let day = e.dataset.day;
    let week = e.dataset.week;
    let year = e.dataset.year;

    let  we_ = '{"persona":"'+id+'","dia":"'+day+'","semana":"'+week+'","anho":"'+year+'"}';

    let arr = {"turno":turno,"persona":id,"dia":day,"semana":week,"anho":year};

    asx = { coleccion: entity , w:we_ , turno: true, d:arr};

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: asx,
        dataType: "text"
    });
    //console.log(request);
    request.done(function (d) {

        console.log(d);

        Toast.fire({
            icon: 'success',
            title: 'Guardado'
        })

        

    });
    request.fail(function (jqXHR, textStatus) {
        /*setTimeout(function () {
            _wait.style.display = 'none';
        }, 400);*/
        console.log(textStatus);
    });




}


function mueve_semana(n){

    // si es movimiento para arriba

    if(n==1)
    {
        if(gg_week == 52)
        {
            gg_week = 1;
            gg_year = gg_year + 1 ;
        }
        else
        {
            gg_week = gg_week + 1;
        }

    }
    else /// si es movimiento para abajo
    {
        if(gg_week == 1)
        {
            gg_week = 52;
            gg_year = gg_year - 1 ;
        }
        else
        {
            gg_week = gg_week - 1;
        }
    }

    cabecera_de_fechas(gg_year,gg_week);
    carga_empleados(gg_sucursal,gg_year,gg_week);
}


/// para alertar
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })


</script>
</html>