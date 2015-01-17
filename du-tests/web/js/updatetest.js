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
            
            var tableresults = $('#testresults').dataTable( {
                "ajax": 'gettestresultsfeed?id='+testid,
                "columns": [
                                { "data": "id" },
                                { "data": "name" },
                                { "data": "min_score" },
                                { "data": "max_score" },
                                { "data": "isactive" },
                                { "data": "actions" }
                            ],
                "bSort": true,
                "aoColumnDefs": 
                        [
                            { "bSortable": false, "aTargets": [ 3 ] }
                        ]  
            });
});

