<?php
const APP_ID = 2;
include_once('../../server/_dsb_index.php');
?>

<div class="dsb_con tent">

    <div class="dsb_line"> 

        <div class="dsb_card dsb_card4"> 
            <span>Ausencias (Mes) </span> <br>
            <span class="dsb_number"> 100 </span>
        </div>
        <div class="dsb_card dsb_card4">  
            <span>Ausencias (Mes) </span> <br>
            <span class="dsb_number"> 100 </span>
        </div>
        <div class="dsb_card dsb_card4"> 
            <span>Ausencias (Mes) </span> <br>
            <span class="dsb_number"> 100 </span>
        </div>
        <div class="dsb_card dsb_card4"> 
            <span>Ausencias (Mes) </span> <br>
            <span class="dsb_number"> 100 </span>
           
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
                    <tr id="__th_date2"></tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script src="../../js/alert.js"></script>
<script>

/// globales

let gg_year = 2022;
let gg_week = 1;
let gg_sucursal = 0;


let data_week = getWeekNumber(new Date());
gg_year = data_week[0];
gg_week = data_week[1];

cabecera_de_fechas(gg_year,gg_week);

carga_empleados(1,gg_year,gg_week);


function cabecera_de_fechas(year,week)
{


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


function formateo_fecha2(f){

    let r = f.getFullYear() + '-' +
                       ('0' + (f.getMonth()+1)).slice(-2) + '-' +
                       ('0' + f.getDate()).slice(-2);


    return r  ; 
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

   let  we_ = '{"activo":"SI"}';

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




            let f_lu = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,0) );
            let f_ma = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,1) );
            let f_mi = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,2) );
            let f_ju = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,3) );
            let f_vi = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,4) );
            let f_sa = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,5) );
            let f_do = formateo_fecha2(getDateOfISOWeek(gg_week, gg_year,6) );

            
            let content_lu = makeRadioButton('ll' + d[i].nombre  , d[i].id ,f_lu) ;
            let content_ma = makeRadioButton('mm' + d[i].nombre  , d[i].id ,f_ma) ;
            let content_mi = makeRadioButton('mi' + d[i].nombre  , d[i].id ,f_mi) ;
            let content_ju = makeRadioButton('jj' + d[i].nombre  , d[i].id ,f_ju) ;
            let content_vi = makeRadioButton('vv' + d[i].nombre  , d[i].id ,f_vi) ;
            let content_sa = makeRadioButton('ss' + d[i].nombre  , d[i].id ,f_sa) ;
            let content_do = makeRadioButton('dd' + d[i].nombre  , d[i].id ,f_do) ;
            
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

    //console.log(day);

    let ffl = document.createElement("div");

    ffl.style.display = 'flex';
    ffl.style.flexDirection = 'row';

    ///checkear las marcaciones 

    load_marcacion(id,day,gg_week,gg_year,ffl);

    return ffl;
}

function load_marcacion(id,day,gg_week,gg_year,ff1)
{
    //console.log('a');

    let loc = '../../server/entity_return.php';
    let entity = 'marcacion';

    asx = { horas: 1, dia: day , persona:id, coleccion: 'marcacion'  };

    var request = $.ajax({
        url: loc,
        type: "POST",
        data: asx,
        dataType: "json"
    });
    //console.log(request);

    request.done(function (d) {

       // console.log(d);

        if(d != null){

            let hora = d[1];
            hora = hora.join("<br>");
            //console.log(hora);
            ff1.innerHTML =hora;
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
</html>