/////globales de entidad

var entity = 'grupo'; 

//// pagina inicial
var page = 1;

//// elementos a eliminar

var e__delete = [];

/// filtros aplicados en buscador

var e__where = '';

/// check si necesitamos cabecera detalle en los registros
var master_detail = 1;


/// columnas de la grilla
var cols_grid = [
    'id',
    'descripcion',
    'aplicacion'
];

/// campos formulario nuevo y  editar
var cols_form =
    [
        {
            "attribute": "id",
            "label": "id",
            "hint": "Autocompletado por el sistema",
            "new": false,
            "edit": true,
            "input_pattern": 1,
            "list": false

        },
        {
            "attribute": "descripcion",
            "label": "Descripcion",
            "hint": "Nombre del Pais o Nacion",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false
        }
    ];


    ///// columnas correspondientes a los campos N:N /// detalle

    var cols_form_detail = [
        {
            "attribute": "aplicacion",
            "label": "Aplicaciones",
            "hint": "Aplicaciones a las que dará acceso el grupo. Seleccionar varias opciones con la tecla Ctrl",
            "new": true,
            "edit": true,
            "required" : true,
            "check": true,
            "check_entity" : "aplicacion"

        }
    ]