  var dp = new DayPilot.Calendar("dp");
  var dae = new Date();
  var x = 1;

  function dayplt() {
    
    dp.cssClassPrefix = "month_green";
    dp.viewType = "Week";
    // view
    if (incr == "forw")
    {
        //var dataI = new Date();
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        //console.log(dae.getMonth());
    } else if (incr == "back") {
        //var dataI = new Date();
        var i = dae.valueOf() - (604800000 * x);
        dae = new Date( i);
        //console.log(dae.getMonth());
    }
    //alert(("0" + dae.getDate()).slice(-2));
    dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
    //dp.startDate = "2016-11-25";  // or just dp.startDate = "2013-03-25";
    dp.days = 1;
    dp.allDayEventHeight = 25;
    dp.initScrollPos = 9 * 40;
    dp.moveBy = 'Full';
    
    // bubble, with async loading
    /*dp.bubble = new DayPilot.Bubble({
        cssClassPrefix: "bubble_default",
        onLoad: function(args) {
            var ev = args.source;
            args.async = true;  // notify manually using .loaded()
            
            // simulating slow server-side load
            setTimeout(function() {
                args.html = "testing bubble for: <br>" + ev.text();
                args.loaded();
            }, 500);
        }
    });
    
    dp.contextMenu = new DayPilot.Menu({
        cssClassPrefix: "menu_default",
        items: [
        {text:"Show event ID", onclick: function() {alert("Event value: " + this.source.value());} },
        {text:"Show event text", onclick: function() {alert("Event text: " + this.source.text());} },
        {text:"Show event start", onclick: function() {alert("Event start: " + this.source.start().toStringSortable());} },
        {text:"Delete", onclick: function() { dp.events.remove(this.source); } }
    ]});*/

    // event movijng
    dp.onEventMoved = function (args) {
        dp.message("Moved: " + args.e.text());
    };
    
    dp.onBeforeHeaderRender = function(args) {
        args.header.areas = [{"action":"JavaScript","bottom":1,"w":17,"html":"<div><div><\/div><\/div>","css":"resource_action_menu","js":"(function(e) { alert(e.date);; })","top":0,"v":"Visible","right":1}];
    };
    
    // event resizing
    dp.onEventResized = function (args) {
        dp.message("Resized: " + args.e.text());
    };

    // event creating
    dp.onTimeRangeSelected = function (args) {
        var name = prompt("New event name:", "Event");
        dp.clearSelection();
        form = $('#calenderform');
        args.placeid = form.find('input.placeid').val();
        args.idd = DayPilot.guid();

        if (!name) return;
        var e = new DayPilot.Event({
            start: args.start,
            end: args.end,
            id: args.idd,
            resource: args.resource,
            text: name
        });
        dp.events.add(e);
        
        args.text = name;
        //console.log(args);
        DayPilot.request(
                        "cal_db.php", 
                        function(req) { // success
                            //var response = eval("(" + req.responseText + ")");
                            //if (response && response.result) {
                            //    dp.message("Created: " + response.message);
                            //}
                        },
                        args,
                        function(req) {  // error
                            dp.message("Saving failed");
                        }
        ); 
        //DayPilot.request(
          /*  $.ajax({
                url:"cal_db.php",
                type:"POST",
                data:args,
                success:function(req){
                    var response = eval("(" + req.responseText + ")");
                    if (response && response.result) {
                        dp.message("Created: " + response.message);
                    }
                },
                error:function(req) {  // error
                    dp.message("Saving failed");
                }                    
            });
            */
    };

    
    dp.onTimeRangeDoubleClicked = function(args) {
        alert("DoubleClick: start: " + args.start + " end: " + args.end + " resource: " + args.resource);
    };
    
    dp.onEventClick = function(args) {
        alert("clicked: " + args.e.id());
    };

    dp.onEventMoved = function (args) {
        form = $('#calenderform');
        args.placeid = form.find('input.placeid').val();
        DayPilot.request(
            "cal_move.php", 
            function(req) { // success
                var response = eval("(" + req.responseText + ")");
                if (response && response.result) {
                    //dp.message("Moved: " + response.message);
                }
            },
            args,
            function(req) {  // error
                //dp.message("Saving failed");
            }
        );        
    };

    dp.onEventResized = function (args) {
        form = $('#calenderform');
        args.placeid = form.find('input.placeid').val();    
        DayPilot.request(
            "cal_move.php", 
            function(req) { // success
                var response = eval("(" + req.responseText + ")");
                if (response && response.result) {
                //dp.message("Resized: " + response.message);
                }
            },
            args,
            function(req) {  // error
                //dp.message("Saving failed");
            }
        );    
    };
    
    dp.init();

    /*var e = new DayPilot.Event({
        start: new DayPilot.Date("2013-03-25T12:00:00"),
        end: new DayPilot.Date("2013-03-25T12:00:00").addHours(3),
        id: DayPilot.guid(),
        text: "Special event",
        areas: [{"action":"JavaScript","js":"(function(e) { dp.events.remove(e); })","h":17,"w":17,"v":"Hover","css":"event_action_delete","top":3,"right":2}]    
    });
    dp.events.add(e);*/
  };

  function loadEvents() {
    form = $('#calenderform');
    var placeid = form.find('input.placeid').val();

    DayPilot.request("cal_load.php", function(result) {
        var data = eval("(" + result.responseText + ")");
        for(var i = 0; i < data.length; i++) {
            var e = new DayPilot.Event(data[i]);                
            dp.events.add(e);
        }
    }, placeid)
    };