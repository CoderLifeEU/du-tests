$(document).ready(function () {

var table=$('#tests').dataTable( {
                "ajax": 'getresultsfeed',
                "columns": [
                                { "data": "name" },
                                { "data": "isactive" },
                                { "data": "completed" },
                                { "data": "actions" }
                            ],
                "bSort": true,
                "aoColumnDefs": 
                        [
                            { "bSortable": false, "aTargets": [ 3 ] }
                        ]  
            });
});

