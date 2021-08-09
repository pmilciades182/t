/////globales de entidad

var entity = 'pais';

//// pagina inicial
var page = 1;

//// elementos a eliminar

var e__delete = [];

/// columnas de la grilla
var cols_grid = [
    'id',
    'descripcion'
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

var cols_search = [
    'descipcion'
];
