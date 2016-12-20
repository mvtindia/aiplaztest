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

<body>

<div class="container-fluid"><!--container-fluid start-->
    <div class="row">
        <div class="menu-had2">
                <?php include 'lib/header.php';?>
        </div><!--menu-had close-->
        <div class="banner-txt">    
            <h1><?php echo $_GET['placename']; ?></h1>
        </div>
        <div class="text-center" style="margin-top: 20px;">
            <a id="" type="button" href="dashboard.php" name="place" class="btn btn-default cus-save-but">My DashBoard</a>
        </div>
        <div class="container"  >
            <button id="mvdtb">&#8592;</button><button id="mvdtf">&#8594;</button>
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
    
    dp.cssClassPrefix = "month_green";
    dp.viewType = "Week";
    dp.height = 400;
    // view
    
    
    dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
    dp.BusinessBeginsHour = 9;
    dp.BusinessEndsHour = 24;
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

    
    
    dp.onBeforeHeaderRender = function(args) {
        args.header.areas = [{"action":"JavaScript","bottom":1,"w":17,"html":"<div><div><\/div><\/div>","css":"resource_action_menu","js":"(function(e) { alert(e.date);; })","top":0,"v":"Visible","right":1}];
    };
    
    

    // event creating
    dp.onTimeRangeSelected = function (args) {
        /*var name = prompt("New event name:", "Available");
        dp.clearSelection();
        args.placeid = <?php echo $_GET['placeid']; ?>;
        //args.idd = DayPilot.guid();
        if (!name) return;
        var calid = "";
        var e = new DayPilot.Event({
            start: args.start,
            end: args.end,
            id: calid,
            resource: args.resource,
            text: name
        });
        dp.events.add(e);

        DayPilot.request(
                        "cal_db.php", 
                        function(req) { // success
                            calid = JSON.parse(req.response);                           
                        },
                        args,
                        function(req) {  // error
                            //dp.message("Saving failed");
                            console.log("error");
                        }
        );
        var calid2 = calid.toString();
        
        e.id(calid2);
        dp.events.update(e);*/
        
    };

    
    dp.onTimeRangeDoubleClicked = function(args) {
        //alert("DoubleClick: start: " + args.start + " end: " + args.end + " resource: " + args.resource);
    };
    
    dp.onEventClick = function(args) {
        //alert("Available from " + args.e.start + " to " + args.e.end);
    };

    dp.onEventMoved = function (args) {
        /*args.placeid = <?php echo $_GET['placeid']; ?>;
        DayPilot.request(
            "cal_move.php", 
            function(req) { // success
                var response = JSON.parse(req);
                //var response = eval("(" + req.responseText + ")");
                //if (response && response.result) {
                    //dp.message("Moved: " + response.message);
                //}
            },
            args,
            function(req) {  // error
                //dp.message("Saving failed");
            }
        ); */       
    };

    dp.onEventResized = function (args) {
        /*args.placeid = <?php echo $_GET['placeid']; ?>;   
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
        ); */   
    };
    
    dp.init();

  };

  function loadEvents() {
    var placeid = <?php echo $_GET['placeid']; ?>;

    DayPilot.request("cal_load.php", function(result) {
        var data = eval("(" + result.responseText + ")");
        
        for(var i = 0; i < data.length; i++) {
            //data[i]['id'] = DayPilot.guid();
            //data[i]['text'] = 'Available';
            //console.log(data[i]['id'].toString());
            
            var e = new DayPilot.Event(
            { 
                start: new DayPilot.Date(data[i]['start']),
                end: new DayPilot.Date(data[i]['end']),
                id: data[i]['id'].toString(),
                text: data[i]['text'],
                resource: data[i]['id']
             });                
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
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        dp.update();
    });
    $( "#mvdtb" ).click(function() {
        var i = dae.valueOf() - (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        dp.update();
    });
    
});
        
</script>