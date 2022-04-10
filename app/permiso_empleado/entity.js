/////globales de entidad

var entity = 'permiso_empleado';

//// pagina inicial
var page = 1;

/// check si necesitamos cabecera detalle en los registros
var master_detail = 0;

//// elementos a eliminar

var e__delete = [];

/// filtros aplicados en buscador

var e__where = '';

/// columnas de la grilla
var cols_grid = [
    'id',
    'persona',
    'fecha',
    'motivo',
    'observaciones',
    'activo'
];

/// campos formulario nuevo y  editar /// tambien buscar /// solo cabecera
var cols_form =
    [
        {
            "attribute": "id",
            "label": "id",
            "hint": "Autocompletado por el sistema",
            "new": false,
            "edit": true,
            "input_pattern": 1,
            "list": false,
            "required" : true

        },
        {
            "attribute": "persona",
            "label": "Persona",
            "hint": "Nombre de la Persona",
            "new": true,
            "edit": true,
            "search": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "persona"

        },
        { 
            "attribute": "fecha",
            "label": "fecha",
            "hint": "Fecha del Permiso",
            "new": true,
            "edit": true,
            "search": true,
            "input_pattern": 4,
            "list": false,
            "required" : true

        },
        {
            "attribute": "permiso_empleado_motivo",
            "label": "Motivo",
            "hint": "Motivo del Permiso",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "permiso_empleado_motivo"
            
        },
        {
            "attribute": "observaciones",
            "label": "Observaciones",
            "hint": "Observaciones",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false,
            "required" : false

        },
        {
            "attribute": "activo",
            "label": "activo",
            "hint": "Estado Activo / Inactivo ",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "activo"

        }

    ];

    ///// columnas correspondientes a los campos N:N /// detalle

    var cols_form_detail = [];
