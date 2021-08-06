//////definiciones de tipos de campos para formularios

var system_input_pattern =
    [
        {
            "id": 1,
            "type": "text",
            "readonly" : true
        },
        {
            "id": 2,
            "type": "text",
            "readonly" : false
        },
        {
            "id": 3,
            "type": "number",
            "readonly" : false
        },
        {
            "id": 4,
            "type": "date",
            "readonly" : false
        },
        {
            "id": 5,
            "type": "email",
            "readonly" : false
        }
    ]

//console.log(system_input_pattern);
//console.log(return_input_pattern(1));

function return_input_pattern(a) {

    var results = [];
    var searchField = "id";
    var searchVal = a;

    for (let i = 0; i < system_input_pattern.length; i++) {
        if (system_input_pattern[i][searchField] == searchVal) {
            results.push(system_input_pattern[i]);
            return results[0];
        }

    }

}