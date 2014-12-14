$(document).ready(function () {

console.log("Pass test");

    var dutestsWidget = $('.dutests');
    
    var testfeedurl="gettestsfeed";
    
    var config = {'feedurl': testfeedurl};  
    dutestsWidget.dutests(config).init();
    $("#e1").select2();
    
});

