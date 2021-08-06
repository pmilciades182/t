/////globales de entidad

var entity = 'persona';

//// pagina inicial
var page = 1;

/// columnas de la grilla
var cols_grid = [
    'id',
    'nombre',
    'apellido',
    'telefono',
    'email',
    'fecha_nacimiento',
    'nacionalidad',
    'tipo_documento',
    'nro_documento',
    'pais',
    'ciudad',
    'direccion'
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
            "attribute": "nombre",
            "label": "Nombre",
            "hint": "Nombre de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "apellido",
            "label": "Apellido",
            "hint": "Apelldo de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "telefono",
            "label": "Telefono",
            "hint": "Numero de Telefono de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "email",
            "label": "Email",
            "hint": "Correo electronico de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 5,
            "list": false

        },
        {
            "attribute": "fecha_nacimiento",
            "label": "Fecha Nacimiento",
            "hint": "Fecha de Nacimiento",
            "new": true,
            "edit": true,
            "input_pattern": 4,
            "list": false

        },
        {
            "attribute": "nacionalidad",
            "label": "Nacionalidad",
            "hint": "Gentilicio de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "tipo_documento",
            "label": "Tipo Documento",
            "hint": "Ruc / Pasaporte / Otros",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "nro_documento",
            "label": "Numero Documento",
            "hint": "Numero de Documento de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },

        {
            "attribute": "pais",
            "label": "Pais",
            "hint": "Pais de residencia",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "ciudad",
            "label": "Ciudad",
            "hint": "Ciudad de residencia",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        },
        {
            "attribute": "direccion",
            "label": "Direccion",
            "hint": "Calle / Barrio / Nro de Casa de Residencia",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false

        }


    ];

var cols_search = [
    'nombre',
    'apellido',
    'nro_documento'
];
