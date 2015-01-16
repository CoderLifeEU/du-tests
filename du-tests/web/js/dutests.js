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
        
        var icheckradio = null;
        var icheckcheckbox=null;
        var icheckcontrol = null;
        
        var btncomplete = null;
        var btncompletevisible = false;
        var btnimg = false;
        
        
        var defaults =
                    {
                        feedurl:null,
                        category:null,
                        testitems:null,
                        answers:[],
                        results:[],
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
            btncompletevisible = true;
            btncomplete.show();
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
        
        self.fillunchecked = function()
        {
            console.log('Fill');
            for(var i=0;i<defaults.results.length;i++)
            {
                for(var y=0;y<defaults.results[i].answers.length; y++)
                {
                    defaults.results[i].answers[y].result = false;
                    console.log(defaults.results[i].answers[y]);
                }
            }
            //console.log(defaults.results);
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
                        defaults.results = data.data;
                        self.fillunchecked();
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

        self.showimg = function ()
        {
            var clicked = $(this);
            var src = clicked.attr('src');
            var imgWindow = window.open(src);
        }
        self.refreshhandlers = function () 
        {
            btnstarttest = self.find('.btn-start-du-tests');
            leftArrow   = self.find('.arrow-left');
            rightArrow  = self.find('.arrow-right');
            scrollPanel = self.find('.steps ul');
            btnteststep = self.find('.step');
            stepscontent = self.find('.steps-content');
            btncomplete = self.find('.btn-complete-test');
            btnimg = self.find('.btn-img');
            
            if(btncompletevisible==true)
            {
                btncomplete.show();
            }
            else
            {
                btncomplete.hide();
            }
            console.log(btnimg);
            self.initArrows();
            
            btnstarttest.off("click.dutests");
            btnteststep.off("click.dutests");
            btncomplete.off("click.dutests");
            btnimg.off("click.dutests");
            
            btnstarttest.on("click.dutests",self.starttest);
            btnteststep.on("click.dutests",self.renderquestion);
            btncomplete.on("click.dutests",self.completetest);
            btnimg.on("click.dutests",self.showimg);
        }
        
        self.completetest = function()
        {
            console.log("time to complete test");
            console.log(defaults.results);
            $.ajax({
                url: "completetest",
                type: "POST",
                //contentType: "application/json; charset=utf-8",
                data: {'items':defaults.results,'testid':selectedtest},
                dataType: "json",
                success: function (data) 
                {
                    
                    if(data.success==true)
                    {
                        setTimeout(function () {
                                swal({title: 'Success', text: 'Your results are send!', type: 'success', confirmButtonText: 'Ok'});
                            }, 500);
                    }
                    else
                    {
                        setTimeout(function () {
                                swal({title: 'Error', text: 'Something is wrong. Can not complete test!', type: 'error', confirmButtonText: 'Ok'});
                            }, 500);
                    }
                   
                },
                error: function (data) 
                {
                    setTimeout(function () {
                                swal({title: 'Error', text: 'Something is wrong. Can not complete test!', type: 'error', confirmButtonText: 'Ok'});
                            }, 500);
                }
            });
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
            
            self.rendercontrols(selectedquestion);
            
            
        }
        
        self.changeanswerstate = function(questionid,answerid,state,controltype)
        {
            if(controltype=='radio')
            {
                //set all false except one
                console.log("Radio is clicked, question:"+questionid+" answer:"+answerid+" state: "+state);
                for(var i=0;i<defaults.results.length;i++)
                {
                    //console.log(defaults.results[i].id);
                    if(defaults.results[i].id==questionid)
                    {
                        for(var y=0;y<defaults.results[i].answers.length; y++)
                        {
                            if(defaults.results[i].answers[y].id==answerid)
                            {
                                defaults.results[i].answers[y].result = state;
                            }
                            else
                            {
                                defaults.results[i].answers[y].result = false;
                            }
                            console.log(defaults.results[i].answers[y]);
                        }
                    }
                }
                
            }
            else if(controltype=='checkbox')
            {
                console.log("Checkbox is clicked, question:"+questionid+" answer:"+answerid+" state: "+state);
                for(var i=0;i<defaults.results.length;i++)
                {
                    //console.log(defaults.results[i].id);
                    if(defaults.results[i].id==questionid)
                    {
                        for(var y=0;y<defaults.results[i].answers.length; y++)
                        {
                            if(defaults.results[i].answers[y].id==answerid)
                            {
                                defaults.results[i].answers[y].result = state;
                            }
                        }
                        console.log(defaults.results[i]);
                    }
                }
                //change only one
            }
        }
        
        self.rendercontrols = function(id)
        {
            console.log("Rendering controls");
            
            icheckcontrol = $('.icheck-control');
            

            icheckcontrol.on('ifUnchecked', function(event){
                var checked = $(this);
                var curanswerid = checked.data('id');
                
                console.log("Answer id:"+curanswerid);
                
                var currentstep = self.find('.steps-scrollpane').find('.step.active');
                var curquestion = currentstep.data('id');
                
                console.log("UNCHEKING");
                for(var i=0;i<icheckcontrol.length;i++)
                  {
                      //console.log($(icheckcontrol[i]));
                      var state = $(icheckcontrol[i]).prop('checked');
                      console.log(i+" checkbox: "+state);
                      
                      self.changeanswerstate(curquestion,curanswerid,false,'checkbox');
                  }
            });
            icheckcontrol.on('ifChecked', function(event){
                event.stopPropagation();
                var checked = $(this);
                var currentstep = self.find('.steps-scrollpane').find('.step.active');
                var curquestion = currentstep.data('id');
                var questionobject = $.grep(defaults.questions, function(e){ return e.id == curquestion; });
                
                
                console.log(checked);
                
                var curanswerid = checked.data('id');
                
                console.log("Answer id:"+curanswerid);
                
              if(questionobject[0].controltype=="checkbox")
              {
              setTimeout(function(){ 
                  
                  //$(checked).iCheck('uncheck');
                  var checkedContainer = $(checked).closest('div.icheckbox_square-red');
                  console.log(checkedContainer);
                  
                  checkedContainer.removeClass("checked");
                  checkedContainer.prop("checked",false);
                  
                    var currentstep = self.find('.steps-scrollpane').find('.step.active');
                    var curquestion = currentstep.data('id');
                    var questionobject = $.grep(defaults.questions, function(e){ return e.id == curquestion; });
                  
                  var checkedcount = 0;
                  
                  for(var i=0;i<icheckcontrol.length;i++)
                  {
                      //console.log($(icheckcontrol[i]));
                      var state = $(icheckcontrol[i]).prop('checked');
                      if(state===true)
                      {
                          checkedcount++;
                      }
                      console.log(i+" checkbox: "+state);
                  }
                  console.log("CHECKED COUNT:"+checkedcount+" required:"+questionobject[0].requiredanswercount);
                  console.log(questionobject[0].requiredanswercount);
                  if(checkedcount<=questionobject[0].requiredanswercount)
                  {
                    checkedContainer.addClass("checked");
                    checkedContainer.prop("checked",true);
                    self.changeanswerstate(curquestion,curanswerid,true,'checkbox');
                      //$(checked).iCheck('check');
                  }
                  else
                  {
                      $(checked).iCheck('uncheck');
                  }
                  
                  /*console.log(currentstep);
                  console.log(questionobject[0]);
                  console.log(icheckcontrol);
                  console.log($(this));*/

              
              }, 1);
            }
            else if(questionobject[0].controltype=="radio")
            {
                console.log("Radio is clicked");
                var currentstep = self.find('.steps-scrollpane').find('.step.active');
                var curquestion = currentstep.data('id');
                var questionobject = $.grep(defaults.questions, function(e){ return e.id == curquestion; });
                //console.log(questionobject[0]);
                self.changeanswerstate(curquestion,curanswerid,true,'radio');
            }
              
            }).iCheck({
              checkboxClass: 'icheckbox_square-red',
              radioClass: 'iradio_square-red',
              increaseArea: '20%'
            });
            
            if(id!=false)
            {
                console.log("Must mark answers for id:"+id);
                //console.log(icheckcontrol);
                
                var resultquestionindex = 0;
                for(var i=0;i<defaults.results.length;i++)
                {
                    if(defaults.results[i].id == id)
                    {
                        resultquestionindex = i;
                    }
                }
                console.log("Look in q:"+resultquestionindex);
                
                //var questionobject = $.grep(defaults.questions, function(e){ return e.id == curquestion; });
                for(var i=0;i<icheckcontrol.length;i++)
                {
                    var controlid = $(icheckcontrol[i]).data('id');
                    for(var y=0;y<defaults.results[resultquestionindex].answers.length;y++)
                    {
                        //console.log(defaults.results[resultquestionindex].answers[y]);
                        if(controlid==defaults.results[resultquestionindex].answers[y].id)
                        {
                            console.log("Control id:"+controlid);
                            if(defaults.results[resultquestionindex].answers[y].result==true)
                            {
                                $(icheckcontrol[i]).iCheck('check');
                                console.log($(icheckcontrol));
                            }
                            //console.log("Control id:"+controlid);
                        }
                    }
                    //console.log("Control id:"+controlid);
                    //console.log(defaults.results);
                }
            }
            
           self.refreshhandlers();

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
            self.rendercontrols(false);
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