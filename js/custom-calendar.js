!function() {

  var today = moment();

  function Calendar(selector, events) {
    this.el = document.querySelector(selector);
    this.events = events;
    this.current = moment().date(1);
    this.draw();
    var current = document.querySelector('.today');
    if(current) {
      var self = this;
      window.setTimeout(function() {
        self.openDay(current);
      }, 500);
    }
  }

  Calendar.prototype.draw = function() {
    //Create Header
    this.drawHeader();

    //Draw Month
    this.drawMonth();

    this.drawLegend();
  }

  Calendar.prototype.drawHeader = function() {
    var self = this;
    if(!this.header) {
      //Create the header elements
      this.header = createElement('div', 'header');
      this.header.className = 'header';

      this.title = createElement('h1');

      var right = createElement('div', 'right');
      right.addEventListener('click', function() { self.nextMonth(); });

      var left = createElement('div', 'left');
      left.addEventListener('click', function() { self.prevMonth(); });

      //Append the Elements
      this.header.appendChild(this.title); 
      this.header.appendChild(right);
      this.header.appendChild(left);
      this.el.appendChild(this.header);
    }

    this.title.innerHTML = this.current.format('MMMM YYYY');
  }

  Calendar.prototype.drawMonth = function() {
    var self = this;
    this.events.forEach(function(ev) {
    ev.date = self.current.clone().date(Math.random() * (29 - 1) + 1);
    });
    
    
    if(this.month) {
      this.oldMonth = this.month;
      this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
      this.oldMonth.addEventListener('webkitAnimationEnd', function() {
        self.oldMonth.parentNode.removeChild(self.oldMonth);
        self.month = createElement('div', 'month');
        self.backFill();
        self.currentMonth();
        self.fowardFill();
        self.el.appendChild(self.month);
        window.setTimeout(function() {
          self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
        }, 16);
      });
    } else {
        this.month = createElement('div', 'month');
        this.el.appendChild(this.month);
        this.backFill();
        this.currentMonth();
        this.fowardFill();
        this.month.className = 'month new';
    }
  }

  Calendar.prototype.backFill = function() {
    var clone = this.current.clone();
    var dayOfWeek = clone.day();

    if(!dayOfWeek) { return; }

    clone.subtract('days', dayOfWeek+1);

    for(var i = dayOfWeek; i > 0 ; i--) {
      this.drawDay(clone.add('days', 1));
    }
  }

  Calendar.prototype.fowardFill = function() {
    var clone = this.current.clone().add('months', 1).subtract('days', 1);
    var dayOfWeek = clone.day();

    if(dayOfWeek === 6) { return; }

    for(var i = dayOfWeek; i < 6 ; i++) {
      this.drawDay(clone.add('days', 1));
    }
  }

  Calendar.prototype.currentMonth = function() {
    var clone = this.current.clone();

    while(clone.month() === this.current.month()) {
      this.drawDay(clone);
      clone.add('days', 1);
    }
  }

  Calendar.prototype.getWeek = function(day) {
    if(!this.week || day.day() === 0) {
      this.week = createElement('div', 'week');
      this.month.appendChild(this.week);
    }
  }

  Calendar.prototype.drawDay = function(day) {
    var self = this;
    this.getWeek(day);

    //Outer Day
    var outer = createElement('div', this.getDayClass(day));
    outer.addEventListener('click', function() {
      self.openDay(this);
    });

    //Day Name
    var name = createElement('div', 'day-name', day.format('ddd'));

    //Day Number
    var number = createElement('div', 'day-number', day.format('DD'));


    //Events
    var events = createElement('div', 'day-events');
    this.drawEvents(day, events);

    outer.appendChild(name);
    outer.appendChild(number);
    outer.appendChild(events);
    this.week.appendChild(outer);
  }

  Calendar.prototype.drawEvents = function(day, element) {
    if(day.month() === this.current.month()) {
      var todaysEvents = this.events.reduce(function(memo, ev) {
        if(ev.date.isSame(day, 'day')) {
          memo.push(ev);
        }
        return memo;
      }, []);

      todaysEvents.forEach(function(ev) {
        var evSpan = createElement('span', ev.color);
        element.appendChild(evSpan);
      });
    }
  }

  Calendar.prototype.getDayClass = function(day) {
    classes = ['day'];
    if(day.month() !== this.current.month()) {
      classes.push('other');
    } else if (today.isSame(day, 'day')) {
      classes.push('today');
    }
    return classes.join(' ');
  }

  Calendar.prototype.openDay = function(el) {
    var details, arrow;
    var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
    var day = this.current.clone().date(dayNumber);

    var currentOpened = document.querySelector('.details');

    //Check to see if there is an open detais box on the current row
    if(currentOpened && currentOpened.parentNode === el.parentNode) {
      details = currentOpened;
      arrow = document.querySelector('.arrow');
    } else {
      //Close the open events on differnt week row
      //currentOpened && currentOpened.parentNode.removeChild(currentOpened);
      if(currentOpened) {
        currentOpened.addEventListener('webkitAnimationEnd', function() {
          currentOpened.parentNode.removeChild(currentOpened);
        });
        currentOpened.addEventListener('oanimationend', function() {
          currentOpened.parentNode.removeChild(currentOpened);
        });
        currentOpened.addEventListener('msAnimationEnd', function() {
          currentOpened.parentNode.removeChild(currentOpened);
        });
        currentOpened.addEventListener('animationend', function() {
          currentOpened.parentNode.removeChild(currentOpened);
        });
        currentOpened.className = 'details out';
      }

      //Create the Details Container
      details = createElement('div', 'details in');

      //Create the arrow
      var arrow = createElement('div', 'arrow');

      //Create the event wrapper

      details.appendChild(arrow);
      el.parentNode.appendChild(details);
    }

    var todaysEvents = this.events.reduce(function(memo, ev) {
      if(ev.date.isSame(day, 'day')) {
        memo.push(ev);
      }
      return memo;
    }, []);

    this.renderEvents(todaysEvents, details);

    arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + 27 + 'px';
  }

  Calendar.prototype.renderEvents = function(events, ele) {
    //Remove any events in the current details element
    var currentWrapper = ele.querySelector('.events');
    var wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));

    events.forEach(function(ev) {
      var div = createElement('div', 'event');
      var square = createElement('div', 'event-category ' + ev.color);
      var span = createElement('span', '', ev.eventName);

      div.appendChild(square);
      div.appendChild(span);
      wrapper.appendChild(div);
    });

    if(!events.length) {
    var myform = createElement('form');
    myform.setAttribute('method','post');
    myform.setAttribute('id','savail');
    myform.setAttribute('action','actions.php');

  /*=======================Default Date view================*/
    var div1 = createElement('div', 'col-md-12');
    var div = createElement('div', 'event empty');

    var myinput=createElement('input','form-control ');
    myinput.setAttribute('type','text');
    myinput.setAttribute('placeholder','Give Dates a Label');
    myinput.setAttribute("name", "plabel");

    div1.appendChild(div).appendChild(myinput);
       myform.appendChild(div1);
    
    
    /*======================Buttons for Availability======================*/
    var div1 = createElement('div', 'col-md-12 mg-top10');
    var div = createElement('div', 'col-md-6');
    var availaibility=createElement('input','btn-custom2 pstatus');
    var mylabel=createElement('label','','Available');
     mylabel.style.cssText ="color:white;"

    availaibility.setAttribute("value", "Available");
    availaibility.setAttribute("checked", "checked");
     availaibility.setAttribute('type','radio');
     availaibility.setAttribute('name','pstatus');

    div.appendChild(availaibility);
    div.appendChild(mylabel);
      div1.appendChild(div);
    
    
      var div = createElement('div', 'col-md-6');
    var navailaibility=createElement('input','btn-custom2 pstatus','Not Available');
   var mylabel=createElement('label','','Not Available');
     mylabel.style.cssText ="color:white;"

    navailaibility.setAttribute("value", "Not Available");
     navailaibility.setAttribute('type','radio');
     navailaibility.setAttribute('name','pstatus');

    div.appendChild(navailaibility);
    div.appendChild(mylabel);
      div1.appendChild(div);


    div.appendChild(navailaibility);
  
      div1.appendChild(div);
      myform.appendChild(div1);

      /*===================Price Set===================*/
     

          var pricediv = createElement('div', 'col-md-12 mg-top10');
          pricediv.setAttribute('id','showpnames');

         // pricediv.style.cssText ="display:none;"


          var saveids=$('#save').val();
          var saveids1=saveids.split(',');
          var savenames = ["Price Per Night", "Price Per Hour", "Weekend Price Per Night"];
          var sids = ["ppn", "pph", "wppn"];
          for (i = 0; i < saveids1.length; i++) { 
            if(saveids1[i]!=0){
               var div = createElement('div', 'col-md-6');
              var myinput=createElement('input','form-control');
              myinput.setAttribute('placeholder',savenames[i]);
            myinput.setAttribute('type','text');
            myinput.setAttribute('name',sids[i]);
              div.appendChild(myinput);
                pricediv.appendChild(div);
            }
          }
      myform.appendChild(pricediv);


availaibility.onclick = function () {
    pricediv.style.cssText ="display:block;"
};

navailaibility.onclick = function () {
    pricediv.style.cssText ="display:none;"
};
    
    /*===================Date Picker===================*/
       var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 




// get current date
var d = new Date();
// add 2 month and auto adjust date
d.setMonth(d.getMonth()+2);

// make 2 digits out of 1
var day = d.getDate();
if(day<10)
day = "0"+day;

var month = d.getMonth()+1;
if(month<10)
month = "0"+month;

// same for current (to be the min later)
var cDay = d.getDate();
if(cDay<10)
cDay = "0"+cDay;

var cMonth = d.getMonth()+1;
if(cMonth<10)
cMonth = "0"+cMonth;

var curEntry = d.getYear()+1900+"-"+cMonth+"-"+cDay;
var dateEntry = d.getYear()+1900+"-"+month+"-"+day;

          var div1 = createElement('div', 'col-md-12 mg-top10');
    var div = createElement('div', 'col-md-6');
    var myinput=createElement('input','form-control');
  myinput.setAttribute('type','date');
  myinput.setAttribute('name','pdate1');
  myinput.setAttribute('min',curEntry);
  myinput.setAttribute('value',moment().calendar());
    div.appendChild(myinput);
      div1.appendChild(div);
    
  var div = createElement('div', 'col-md-6');
    var myinput=createElement('input','form-control');
  myinput.setAttribute('type','date');
  myinput.setAttribute('name','pdate2');
  myinput.setAttribute('min',curEntry);

    div.appendChild(myinput);
  
    var myinput1=createElement('input','form-control placeid');
  myinput1.setAttribute('type','hidden');
  myinput1.setAttribute('name','placeid');
    div.appendChild(myinput1);

var protocol= "http://";
var host=window.location.host;
var pathArray = window.location.pathname.split( '/' );
//var second = pathArray[0];
var third = pathArray[1];
var fourth = pathArray[2];
var myurl=protocol+host+"/"+third+"/"+fourth;


 var myinput2=createElement('input','form-control');
  myinput2.setAttribute('type','hidden');
  myinput2.setAttribute('name','ppath');
  myinput2.setAttribute('value',myurl);
    div.appendChild(myinput2);

      div1.appendChild(div);
    
      myform.appendChild(div1);
    
    
    
    
    
    
    
    
    /*===================Time Picker===================*/
          var div1 = createElement('div', 'col-md-12 mg-top10');
    var div = createElement('div', 'col-md-6');
    var myinput=createElement('input','form-control');
  myinput.setAttribute('type','time');
  myinput.setAttribute('name','ptime1');
    div.appendChild(myinput);
      div1.appendChild(div);
    
  var div = createElement('div', 'col-md-6');
    var myinput=createElement('input','form-control');
  myinput.setAttribute('type','time');
  myinput.setAttribute('name','ptime2');
    div.appendChild(myinput);
  
      div1.appendChild(div);
    
      myform.appendChild(div1);
    
    
    
    
    
    
     /*======================Buttons for Repeat Days======================*/
    /*var div1 = createElement('div', 'col-md-12 mg-top10');
    var div = createElement('div', 'col-md-6');
    var mybutton=createElement('input','btn-custom2 repetition');
    var mylabel=createElement('label','','Repeat');
    mybutton.setAttribute("value", "Repeat");
     mybutton.setAttribute('type','radio');
     mybutton.setAttribute('name','repetition');
     mylabel.style.cssText ="color:white;"
    div.appendChild(mybutton);
    div.appendChild(mylabel);
      div1.appendChild(div);



    div.appendChild(mybutton);
      div1.appendChild(div);
    
    
      var div = createElement('div', 'col-md-6');
    var mybutton=createElement('input','btn-custom2 repetition');
    
    var mylabel=createElement('label','','Doesnot Repeat');
     mylabel.style.cssText ="color:white;"

    mybutton.setAttribute("value", "Doesnot Repeat");
     mybutton.setAttribute('type','radio');
     mybutton.setAttribute('name','repetition');

    div.appendChild(mybutton);
    div.appendChild(mylabel);
  
      div1.appendChild(div);
      myform.appendChild(div1);
    */
    
    
    
     
      
     /*======================Buttons for Set and cancel======================*/
    var div1 = createElement('div', 'col-md-12 mg-top10');
    var div = createElement('div', 'col-md-6');
    var mybutton=createElement('button','btn-3 btn-custom2 cancl','Cancel');
     mybutton.setAttribute('type','button');

    div.appendChild(mybutton);
      div1.appendChild(div);
    mybutton.onclick = function () {
    myform.reset();
};
    
     var div = createElement('div', 'col-md-6');
     var mybutton=createElement('button','btn-3 btn-custom2 myset','Set');
     mybutton.setAttribute('type','submit');
     mybutton.setAttribute('name','values');

    div.appendChild(mybutton);
  
      div1.appendChild(div);
      myform.appendChild(div1);
   
  wrapper.appendChild(myform);
  }

    if(currentWrapper) {
      currentWrapper.className = 'events out';
      currentWrapper.addEventListener('webkitAnimationEnd', function() {
        currentWrapper.parentNode.removeChild(currentWrapper);
        ele.appendChild(wrapper);
      });
      currentWrapper.addEventListener('oanimationend', function() {
        currentWrapper.parentNode.removeChild(currentWrapper);
        ele.appendChild(wrapper);
      });
      currentWrapper.addEventListener('msAnimationEnd', function() {
        currentWrapper.parentNode.removeChild(currentWrapper);
        ele.appendChild(wrapper);
      });
      currentWrapper.addEventListener('animationend', function() {
        currentWrapper.parentNode.removeChild(currentWrapper);
        ele.appendChild(wrapper);
      });
    } else {
      ele.appendChild(wrapper);
    }
  }

  Calendar.prototype.drawLegend = function() {
    var legend = createElement('div', 'legend');
    var calendars = this.events.map(function(e) {
      return e.calendar + '|' + e.color;
    }).reduce(function(memo, e) {
      if(memo.indexOf(e) === -1) {
        memo.push(e);
      }
      return memo;
    }, []).forEach(function(e) {
      var parts = e.split('|');
      var entry = createElement('span', 'entry ' +  parts[1], parts[0]);
      legend.appendChild(entry);
    });
    this.el.appendChild(legend);
  }

  Calendar.prototype.nextMonth = function() {
    this.current.add('months', 1);
    this.next = true;
    this.draw();
  }

  Calendar.prototype.prevMonth = function() {
    this.current.subtract('months', 1);
    this.next = false;
    this.draw();
  }

  window.Calendar = Calendar;

  function createElement(tagName, className, innerText) {
    var ele = document.createElement(tagName);
    if(className) {
      ele.className = className;
    }
    if(innerText) {
      ele.innderText = ele.textContent = innerText;
    }
    return ele;
  }
}();

!function() {
/*  var plabels1=$('#plabels').html();

 if(plabels){
  var plabels=plabels1.split(',');
  var output= new Array(plabels.length);
  for (var i = 0; i < plabels.length; i++) {
    output[i] = "{ eventName: '"+plabels[i]+"', calendar: 'Work', color: 'orange'},"
  };
  var data = [
  output*/
    /*{ eventName: 'Lunch Meeting w/ Mark', calendar: 'Work', color: 'orange' },
    { eventName: 'Interview - Jr. Web Developer', calendar: 'Work', color: 'orange' },
    { eventName: 'Demo New App to the Board', calendar: 'Work', color: 'orange' },
    { eventName: 'Dinner w/ Marketing', calendar: 'Work', color: 'orange' },

    { eventName: 'Game vs Portalnd', calendar: 'Sports', color: 'blue' },
    { eventName: 'Game vs Houston', calendar: 'Sports', color: 'blue' },
    { eventName: 'Game vs Denver', calendar: 'Sports', color: 'blue' },
    { eventName: 'Game vs San Degio', calendar: 'Sports', color: 'blue' },

    { eventName: 'School Play', calendar: 'Kids', color: 'yellow' },
    { eventName: 'Parent/Teacher Conference', calendar: 'Kids', color: 'yellow' },
    { eventName: 'Pick up from Soccer Practice', calendar: 'Kids', color: 'yellow' },
    { eventName: 'Ice Cream Night', calendar: 'Kids', color: 'yellow' },

    { eventName: 'Free Tamale Night', calendar: 'Other', color: 'green' },
    { eventName: 'Bowling Team', calendar: 'Other', color: 'green' },
    { eventName: 'Teach Kids to Code', calendar: 'Other', color: 'green' },
    { eventName: 'Startup Weekend', calendar: 'Other', color: 'green' }*/
 // ];
//console.log(output);
/*  }//if plabels
else{*/
   var data = [
   {}
   ];
//}
  function addDate(ev) {
    
  }

  var calendar = new Calendar('#calendar', data);

}();
