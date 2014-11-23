$(document).ready(function () {
var testid = $('#test-id').val();
console.log(testid);

var table = $('#tests').dataTable( {
                "ajax": 'getquestionsfeed?id='+testid,
                "columns": [
                                { "data": "id" },
                                { "data": "name" },
                                { "data": "description" },
                                { "data": "actions" }
                            ],
                "bSort": true,
                "aoColumnDefs": 
                        [
                            { "bSortable": false, "aTargets": [ 3 ] }
                        ]  
            });
});

