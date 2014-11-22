(function ($) {


    $.fn.dutests = function (config) {
        
        console.log(config);
        
        var self = this;   
        var btnstarttest = null;
        
        var defaults =
                    {
                        feedurl:null,
                        category:null,
                        testitems:null,
                        total:null,
                        fullhtml:
                        'Hello world',
                        startbtn:'<a class="btn btn-primary btn-start-du-tests">Start</a>'

                    };
        var config = $.extend(defaults, config);

        self.init = function () {
            self.html(defaults.fullhtml+defaults.startbtn);
            self.gettestitems();
            self.refreshhandlers();
        }


        self.gettestitems = function () {

            $.ajax({
                url: defaults.feedurl,
                type: "GET",
                contentType: "application/json; charset=utf-8",
                data: "{}",
                dataType: "json",
                success: function (data) {
                    
                    if(data.success=="true")
                    {
                        defaults.testitems = data.data;
                        //defaults.total=data.total;
                    }
                    
                   self.renderselectItems();

                },
                error: function (data) {
                }
            });
        }

        self.renderselectItems = function()
        {
            console.log("Rendering items into dropdown");
        }

        self.refreshhandlers = function () 
        {
            btnstarttest = self.find('.btn-start-du-tests');
            
            btnstarttest.off("click.dutests");
            btnstarttest.on("click.dutests",self.starttest);
        }

        self.starttest = function()
        {
            alert("Hey");
        }

        return this;
    };


})(jQuery);