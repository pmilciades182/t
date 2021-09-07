/////globales de entidad

var entity = 'usuario';

//// pagina inicial
var page = 1;

/// check si necesitamos cabecera detalle en los registros
var master_detail = 1;

//// elementos a eliminar

var e__delete = [];

/// filtros aplicados en buscador

var e__where = '';


/// columnas de la grilla
var cols_grid = [
    'id',
    'usuario',
    'activo',
    'grupo'
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
            "attribute": "usuario",
            "label": "Nombre de Usuario",
            "hint": "Nombre de usuario para iniciar sesion en el sistema",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false
        },
        {
            "attribute": "password",
            "label": "Contraseña",
            "hint": "Contraseña para inicio de sesion en el sistema",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false
        },
        {
            "attribute": "activo",
            "label": "Usuario Activo?",
            "hint": "Un usuario Inactivo ya no puede acceder al sistema",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "list_entity" : "activo",
        }
    ];

    //// columnas detalle

    var cols_form_detail = [
        {
            "attribute": "grupo",
            "label": "Grupos",
            "hint": "Un Grupo concede acceso a los diversos modulos del sistema. Seleccionar varias opciones con la tecla Ctrl",
            "new": true,
            "edit": true,
            "required" : true,
            "check": true,
            "check_entity" : "grupo"
        }
    ]
