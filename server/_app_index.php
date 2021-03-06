<?php  

include_once('manage_session.php');
$_r = rand(111111111, 999999999);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../../css/all.css" rel="stylesheet">
    <link href="../../css/tablas.css?r=<?php echo $_r  ?>" rel="stylesheet">
    <script defer src="../../js/pro.js"></script>
    <script src="../../js/s.js"></script>
    <script src="../../js/app.js?r=<?php echo $_r  ?>"></script>
    <script src="../../js/forms.js?r=<?php echo $_r  ?>"></script>
    <script src="../../js/j2.js"></script>
    <script src="entity.js?r=<?php echo $_r  ?>"></script>
</head>

<div id="mgs_error">
    <div id="md_cont_err">

        <div id="md_head_err" class="noselect">
            <span class="modal_head" id="modal_title_err"> <b>Alerta</b> </span>

        </div>

        <div id="md_body_err">

            Mensaje de Error

        </div>

        <div id="md_foo_err" class="noselect">

            <div class="agrupador b_modal" onclick="cierra_error()">
                <div><span> OK </span>
                </div>
            </div>


        </div>

    </div>
</div>

<div id="mgs_modal">

    <div id="md_cont">
        <div id="md_head" class="noselect">
            <span class="modal_head" id="modal_title"> ... </span>
            <i class="fas fa-times modal_head close" id="close_modal"> </i>
        </div>
        <div id="md_body">

            <div class="form_content" id='frm_new'>
                <div id="new_tab_select_master" class="agrupador detail">Cabecera</div>

                <table>
                    <tbody id="tbl_new">
                        <tr>
                            <th>Campo</th>
                            <th>Ingresar Valor Nuevo</th>
                            <th>Obligtorio</th>
                            <th>Descripcion de ayuda</th>
                        </tr>
                    </tbody>

                </table>
                <div id="new_tab_select_detail" class="agrupador detail">Detalle</div>
                 <div id="new_tab_detail">
                    <table>
                        <tbody id="tbl_new_detail">
                           
                        </tbody>
                    </table>
                    </div>

            </div>

            <div class="form_content" id='frm_search'>

                <table>
                    <tbody id="tbl_search">
                        <tr>
                            <th>Campo</th>
                            <th>Ingresar Valor a Buscar</th>
                            <th>Descripcion de ayuda</th>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div class="form_content" id='frm_export'>
                <table>
                    <tr>
                        <th>Campo</th>
                        <th> Valor</th>
                    </tr>
                    <tr>
                        <td>Nombre del archivo</td>
                        <td> <input id='export_name'> </input> </td>
                    </tr>
                </table>
            </div>

            <div class="form_content" id='frm_delete'>

            </div>

            <div class="form_content" id='frm_edit'>

                <div id="edit_tab_select_master" class="agrupador detail">Cabecera</div>

                <div id="edit_tab">
                    <div id="edit_tab_master">
                        <table>
                            <tbody id="tbl_edit">
                                <tr>
                                    <th>Campo</th>
                                    <th>Ingresar Valor Nuevo</th>
                                    <th>Obligtorio</th>
                                    <th>Descripcion de ayuda</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="edit_tab_select_detail" class="agrupador detail">Detalle</div>
                    <div id="edit_tab_detail">
                        <table>
                            <tbody id="tbl_edit_detail">
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div id="md_foo" class="noselect">

            <div class="agrupador b_modal" id="go_frm_action" data-action="" onclick="button_frm(this,entity)">
                <div><span id="text_button_modal"></span></div>
            </div>


        </div>
    </div>
</div>
<div id="t_con">
    <div id="t_hea" class="noselect">

        <div class="agrupador" id="go_refresh">
            <div> &nbsp&nbsp<i class="fas fa-sync"></i><span> Recargar </span>&nbsp&nbsp </div>
        </div>
        <div class="agrupador" id="go_busq">
            <div> &nbsp&nbsp<i class="fas fa-search"></i><span> Buscar </span>&nbsp&nbsp </div>
        </div>
        <div class="agrupador ag_exp" id="go_exp">
            <div> &nbsp&nbsp<i class="far fa-file-alt"></i><span></span> Exportar</span> &nbsp&nbsp</div>
        </div>
        <div class="agrupador ag_gree" id="go_new">
            <div> &nbsp&nbsp <i class="fas fa-plus"></i> Nuevo Registro &nbsp&nbsp</div>
        </div>
        <div class="agrupador ag_red" id="go_delete">
            <div> &nbsp&nbsp <i class="far fa-trash-alt"></i> Eliminar <span id="delete_count"></span> &nbsp&nbsp</div>
        </div>
    </div>
    <div id="t_bod">
        <div class="wait" id="wait_">
            <div class="loading">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4335 4335" width="100" height="100">
                    <path fill="#008DD2"
                        d="M3346 1077c41,0 75,34 75,75 0,41 -34,75 -75,75 -41,0 -75,-34 -75,-75 0,-41 34,-75 75,-75zm-1198 -824c193,0 349,156 349,349 0,193 -156,349 -349,349 -193,0 -349,-156 -349,-349 0,-193 156,-349 349,-349zm-1116 546c151,0 274,123 274,274 0,151 -123,274 -274,274 -151,0 -274,-123 -274,-274 0,-151 123,-274 274,-274zm-500 1189c134,0 243,109 243,243 0,134 -109,243 -243,243 -134,0 -243,-109 -243,-243 0,-134 109,-243 243,-243zm500 1223c121,0 218,98 218,218 0,121 -98,218 -218,218 -121,0 -218,-98 -218,-218 0,-121 98,-218 218,-218zm1116 434c110,0 200,89 200,200 0,110 -89,200 -200,200 -110,0 -200,-89 -200,-200 0,-110 89,-200 200,-200zm1145 -434c81,0 147,66 147,147 0,81 -66,147 -147,147 -81,0 -147,-66 -147,-147 0,-81 66,-147 147,-147zm459 -1098c65,0 119,53 119,119 0,65 -53,119 -119,119 -65,0 -119,-53 -119,-119 0,-65 53,-119 119,-119z" />
                </svg>
            </div>
        </div>
        <table id="ta">
            <tbody id="__td">
                <tr id="__th"></tr>
            </tbody>
        </table>
    </div>
    <div id="t_foo" class="noselect">
        <div id="text_paginator">
        </div>
        <div class="agrupador">
            <i class="fal fa-chevron-double-left pagination" data-type="1"
                onclick="e__paginador(this,entity,e__where)"></i>
            <i class="fal fa-chevron-left pagination" data-type="2" onclick="e__paginador(this,entity,e__where)"></i>
            <i class="fal fa-chevron-right pagination" data-type="3" onclick="e__paginador(this,entity,e__where)"></i>
            <i class="fal fa-chevron-double-right pagination" data-type="4"
                onclick="e__paginador(this,entity,e__where)"></i>
        </div>
        <div id="text_copy">
            PG ANALITICA ??
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        var e__th = $("#__th");
        var e__td = $("#__td");
        ///// funciones de entidad
        e__put_th(cols_grid, e__th);
        e__put_td(entity, cols_grid, e__td, page, e__where);
        e__text_paginator(entity, e__where);
        e__frm_all(cols_form,cols_form_detail);
        e__hide_master_detail(master_detail);

        console.log(entity + ' | ' + session_id);

    });
</script>

</html>