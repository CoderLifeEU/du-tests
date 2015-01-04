$(document).ready(function () {

var table=$('#tests').dataTable( {
                "ajax": 'gettestsfeed',
                "columns": [
                                { "data": "id" },
                                { "data": "name" },
                                { "data": "isactive" },
                                { "data": "created" },
                                { "data": "actions" }
                            ],
                "bSort": true,
                "aoColumnDefs": 
                        [
                            { "bSortable": false, "aTargets": [ 4 ] }
                        ]  
            });
});

