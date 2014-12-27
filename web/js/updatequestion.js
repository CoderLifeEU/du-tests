$(document).ready(function () {
var id = $('#questionform-id').val();
console.log(id);

var table = $('#tests').dataTable( {
                "ajax": 'getanswersfeed?id='+id,
                "columns": [
                                { "data": "id" },
                                { "data": "name" },
                                { "data": "isvalid" },
                                { "data": "score" },
                                { "data": "actions" }
                            ],
                "bSort": true,
                "aoColumnDefs": 
                        [
                            { "bSortable": false, "aTargets": [ 3 ] }
                        ]  
            });
});

