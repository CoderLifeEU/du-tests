(function ($) {


    $.fn.dutests = function (config) {
        
        console.log(config);
        
        var self = this;   
        var btnstarttest = null;
        
        var leftArrow   = null,
        rightArrow  = null,
        scrollPanel = null;

        var testisactive=false;
        var selectedtest = null;
        var selectedquestion = null;
        var selectedstep = null;
        var btnteststep = null;
        var stepscontent = null;
        
        
        var defaults =
                    {
                        feedurl:null,
                        category:null,
                        testitems:null,
                        total:null,
                        questions:null,
                        questioncount:null,
                        fullhtml:
                        'Hello world',
                        startbtn:'<a class="btn btn-primary btn-start-du-tests">Start</a>'

                    };
        var config = $.extend(defaults, config);

        self.init = function (selector) {
            
            var context = {items:1};
            var source = $("#test-wizard-template").html();
            var template = Handlebars.compile(source);
            defaults.fullhtml = template(context);
            self.html(defaults.fullhtml);
            self.gettestitems();
            self.refreshhandlers();
            
        }
        
        self.formatItem = function (item) 
        {
            console.log(item);
            if (!item.image) return item.name; // optgroup
            return "<img class='selectavatar' src='"+item.image+"' />" + item.name;
            //return "<img class='flag' src='images/flags/" + state.id.toLowerCase() + ".png'/>" + state.text;
        }
        
        self.initselect = function(){
            self.find("#wizard-choose-test").select2({
            formatResult: self.formatItem,
            formatSelection: self.formatItem,
            escapeMarkup: function(m) { return m; },
            data:defaults.testitems,
            width:260
        })
        .on("change", function(e) 
        { 
            
            console.log(e);
            console.log("change "+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));
            selectedtest = e.val;
            self.gettest();
        });
            /*$("#sort-by-person").select2(
            {
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; },
            data:friends,
            width:260
        })
        .on("change", function(e) 
        { 
            
            console.log(selected);
            console.log(e);
            console.log("change "+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));
            selected = e.added.id;
            clearTimeline();
            page=1;
            renderSectionByParameter();
        });*/
        }

        self.rendertest = function()
        {
            scrollPanel.html('');
            stepscontent.html('');
            var context = {items:defaults.questions};
            var source = $("#test-step-template").html();
            var template = Handlebars.compile(source);
            var insertedhtml = template(context);
            scrollPanel.html(insertedhtml);
            scrollPanel.find('.step').first().removeClass('inactive').addClass('active');
            
            self.refreshhandlers();
            
            var first = scrollPanel.find('.step').first();
            selectedquestion = first.data('id');
            selectedstep = first.data('step');
            self.renderquestionNoEvent();
        }
        
        self.gettest = function()
        {
            //self.find("#wizard-choose-test").select2("enable", false);
            
            $.ajax({
                url: 'preparetest',
                type: "GET",
                contentType: "application/json; charset=utf-8",
                data: {'id':selectedtest},
                dataType: "json",
                success: function (data) {
                    
                    if(data.success==true)
                    {
                        defaults.questions = data.data;
                        defaults.questioncount = data.questioncount;
                        self.rendertest();
                    }
                   

                },
                error: function (data) {
                }
            });
            
            console.log('gettest');
        }
        self.gettestitems = function () {

            $.ajax({
                url: defaults.feedurl,
                type: "GET",
                contentType: "application/json; charset=utf-8",
                data: "{}",
                dataType: "json",
                success: function (data) {
                    
                    if(data.success==true)
                    {
                        defaults.testitems = data.data;
                        //defaults.total=data.total;
                        self.initselect();
                        //self.renderselectItems();
                    }
                   

                },
                error: function (data) {
                }
            });
        }

        self.renderselectItems = function()
        {
            console.log("Rendering items into dropdown");
            //self.initselect();
        }

        self.refreshhandlers = function () 
        {
            btnstarttest = self.find('.btn-start-du-tests');
            leftArrow   = self.find('.arrow-left');
            rightArrow  = self.find('.arrow-right');
            scrollPanel = self.find('.steps ul');
            btnteststep = self.find('.step');
            stepscontent = self.find('.steps-content');
            
            self.initArrows();
            
            btnstarttest.off("click.dutests");
            btnteststep.off("click.dutests");
            
            btnstarttest.on("click.dutests",self.starttest);
            btnteststep.on("click.dutests",self.renderquestion);
        }
        
        self.renderquestion = function(event)
        {
            event.preventDefault();
            
            scrollPanel.find('.step').removeClass('active').addClass('inactive');
            
            var clickedbtn = $(this);
            clickedbtn.removeClass('inactive').addClass('active');
            var selectedquestion = clickedbtn.data('id');
            var selectedstep = clickedbtn.data('step');
            var item = defaults.questions[selectedstep-1];
            console.log(item);
            var context = item;
            var source = $("#question-step-template").html();
            var template = Handlebars.compile(source);
            var insertedhtml = template(context);
            stepscontent.html(insertedhtml);
            
        }
        self.renderquestionNoEvent = function()
        {
            var item = defaults.questions[selectedstep-1];
            console.log(item);
            var context = item;
            var source = $("#question-step-template").html();
            var template = Handlebars.compile(source);
            var insertedhtml = template(context);
            stepscontent.html(insertedhtml);
        }
        self.initArrows = function () {
 
                leftArrow.on('click', function (e) {
 
                    var leftPos = scrollPanel.scrollLeft();
                    scrollPanel.animate({ scrollLeft: leftPos - scrollPanel.width() }, 300);
 
                    return false;
 
                });
 
                rightArrow.on('click', function (e) {
 
                    var leftPos = scrollPanel.scrollLeft();
                    scrollPanel.animate({ scrollLeft: leftPos + scrollPanel.width() }, 300);
 
                    return false;
 
                });
 
 
            }

        self.starttest = function()
        {
            alert("Hey");
        }

        return this;
    };


})(jQuery);