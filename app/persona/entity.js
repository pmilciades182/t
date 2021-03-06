/////globales de entidad

var entity = 'persona';

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
    'rf',
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
    'direccion',
    'empresa',
    'sucursal',
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
            "attribute": "nombre",
            "label": "Nombre",
            "hint": "Nombre de la Persona",
            "new": true,
            "edit": true,
            "search": true,
            "input_pattern": 2,
            "list": false,
            "required" : true

        },
        { 
            "attribute": "apellido",
            "label": "Apellido",
            "hint": "Apelldo de la Persona",
            "new": true,
            "edit": true,
            "search": true,
            "input_pattern": 2,
            "list": false,
            "required" : true

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
            "list": false,
            "required" : true

        },
        {
            "attribute": "fecha_nacimiento",
            "label": "Fecha Nacimiento",
            "hint": "Fecha de Nacimiento",
            "new": true,
            "edit": true,
            "input_pattern": 4,
            "list": false,
            "required" : true

        },
        {
            "attribute": "nacionalidad",
            "label": "Nacionalidad",
            "hint": "Gentilicio de la Persona",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false,
            "required" : true

        },
        {
            "attribute": "tipo_documento",
            "label": "Tipo Documento",
            "hint": "Ruc / Pasaporte / Otros",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true

        },
        {
            "attribute": "nro_documento",
            "label": "Numero Documento",
            "hint": "Numero de Documento de la Persona",
            "new": true,
            "edit": true,
            "search": true,
            "input_pattern": 2,
            "list": false,
            "list_entity" : "tipo_documento",
            "required" : true

        },

        {
            "attribute": "pais",
            "label": "Pais",
            "hint": "Pais de residencia",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "list_entity" : "pais",
            "required" : true

        },
        {
            "attribute": "ciudad",
            "label": "Ciudad",
            "hint": "Ciudad de residencia",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "ciudad"
    

        },
        {
            "attribute": "direccion",
            "label": "Direccion",
            "hint": "Calle / Barrio / Nro de Casa de Residencia",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": false,
            "required" : true
        },
        {
            "attribute": "empresa",
            "label": "empresa",
            "hint": "Empresa",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "empresa"
    

        },
        {
            "attribute": "sucursal",
            "label": "sucursal",
            "hint": "Sucursal",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "sucursal"
    

        },
        {
            "attribute": "activo",
            "label": "Activo",
            "hint": "Estado del Empleado",
            "new": true,
            "edit": true,
            "input_pattern": 2,
            "list": true,
            "required" : true,
            "list_entity" : "activo"
    

        }

    ];

    ///// columnas correspondientes a los campos N:N /// detalle

    var cols_form_detail = [
        {
            "attribute": "funcion",
            "label": "Funcion Empleado",
            "hint": "Funciones que realiza la Persona. Seleccionar varias opciones con la tecla Ctrl",
            "new": true,
            "edit": true,
            "required" : true,
            "check": true,
            "check_entity" : "funcion"
        }
    ]
