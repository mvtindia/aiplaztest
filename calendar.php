<script src='js/jquery.min.js'></script>
<script src='js/moment.min.js'></script>
<script src='js/daypilot-all.min.js?v=2542'></script>
<link type="text/css" rel="stylesheet" href="helpers/demo.css?v=2542" />
<link type="text/css" rel="stylesheet" href="helpers/media/layout.css?v=2542" />
<link type="text/css" rel="stylesheet" href="helpers/media/elements.css?v=2542" />

<link type="text/css" rel="stylesheet" href="themes/month_white.css?v=2542" />    
<link type="text/css" rel="stylesheet" href="themes/month_green.css?v=2542" />    
<link type="text/css" rel="stylesheet" href="themes/month_transparent.css?v=2542" />    
<!--<link type="text/css" rel="stylesheet" href="themes/month_traditional.css?v=2542" />
<link type="text/css" rel="stylesheet" href="themes/areas.css?v=2542" />       
<link type="text/css" rel="stylesheet" href="themes/navigator_8.css?v=2542" />
<link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css?v=2542" />-->  
<link type="text/css" rel="stylesheet" href="themes/navigator_white.css?v=2542" />    
        
<link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css?v=2542" />    
<link type="text/css" rel="stylesheet" href="themes/calendar_white.css?v=2542" />    
<link type="text/css" rel="stylesheet" href="themes/calendar_green.css?v=2542" />    
<?php include 'lib/top.php';?>
<script>
    var incr = "no";
</script>

<body>
</head>

<body>

<div class="container-fluid"><!--container-fluid start-->
    <div class="row">
        <div class="menu-had2">
                <?php include 'lib/header.php';?>
        </div><!--menu-had close-->
        <div class="banner-txt">    
            <h1></h1>
        </div>
        <div class="container"  >
            <button id="mvdtb"><---</button><button id="mvdtf">---></button>
            <div id="dp"></div>
        </div>
    </div>
</div>         
<?php include 'lib/footer.php';?>
<script>
 var dp = new DayPilot.Calendar("dp");
  var dae = new Date();
  var x = 1;

  function dayplt() {
    
    dp.cssClassPrefix = "calendar_white";
    dp.viewType = "Week";
    dp.height = 400;
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
    
    dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
    dp.businessBeginsHour = 0;
    dp.businessEndsHour = 24;
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
        args.placeid = <?php echo $_GET['placeid']; ?>;
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
    var placeid = <?php echo $_GET['placeid']; ?>;

    DayPilot.request("cal_load.php", function(result) {
        var data = eval("(" + result.responseText + ")");
        for(var i = 0; i < data.length; i++) {
            var e = new DayPilot.Event(data[i]);                
            dp.events.add(e);
        }
    }, placeid)
    };

    dayplt();
    loadEvents();
</script>

</html>
<script type="text/javascript">
$(document).ready(function() {

    var url = window.location.href;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if (filename === "") filename = "index.html";
    $(".menu a[href='" + filename + "']").addClass("selected");
    $( "#mvdtf" ).click(function() {
        incr = "forw";
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        dp.update();
    });
    $( "#mvdtb" ).click(function() {
        incr = "back";
        dayplt();
    });
    
});
        
</script>