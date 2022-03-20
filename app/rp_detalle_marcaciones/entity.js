/////globales de entidad

var entity = 'marcacion';

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
    'lector',
    'insert_date'
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

        }

    ];

    ///// columnas correspondientes a los campos N:N /// detalle

    var cols_form_detail = [];
