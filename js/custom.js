var tabsFn = (function() {
  
  function init() {
    setHeight();
  }
  
  function setHeight() {
    var $tabPane = $('.tab-pane'),
        tabsHeight = $('.nav-tabs').height();
    
    $tabPane.css({
      height: tabsHeight
    });
  }
    
  $(init);
});

  /* Image hover effect */
  $(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
  );



  
  
  /* Popup Jquery */

$(document).ready(function() {

	// hotel booking


	$('.cancel-btn').click(function(){
		var val = $(this).val();
		$.ajax({
        url: 'forms.php?cancel_booking='+val,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
       var j = data.trim(" ");
        if(j == 'ok')
        {   	
        	 swal("Cancelled!", "Booking Cancelled", "success");	
        	$('.confirm').click(function(){
        		window.location.href="index.php";
        	});
       
       }
        else if(j == 'not')
        {
        	swal("Failure!", "Unable to Cancel The booking", "error");
        }
        
    },       
    });

	});	

	 $(".hotel-btn").click(function(){
    	$(this).hide();
        $(".hides").show(500);
        $('.send_btn2').show(700);
        $('.cancel_btn2').show(700);

	});


	 $('.cancel_btn2').click(function(){	
		$(this).hide();
		$('.send_btn2').hide();
        $(".hides").hide();
        $('.hotel-btn').show(500);
	});

	$("#book_messagess").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'forms.php?book_messagess=101',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
        data1 = data.split('>>>');
        if(data1[0] == 'ok')
        {
           window.location.href="list-service1.php?id="+data1[1];
  //       $(this).hide();
		// $('.send_btn2').hide();
		// $('.cancel_btn2').hide();
  //       $(".hides").hide();
  //       $('.hotel-btn').show(500);
         

        }
        else if(data[0] == 'not')
        {
        	// $('.signlog').click();
        	swal("Failure!", "Unable to Send Message", "error");
        }
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
        swal("Failure!", "Email Id already Exist!", "error");
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 


//paypal Insertion Start HEre

$("#paypal_data").click(function(e)
{
	var bookid = $('#booking_id').val();
	var amount = $('#amount').val();
    $.ajax({
        url: 'forms.php?paypal_insertion='+bookid+'&amount='+amount,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
       var j = data.trim(" ");
        if(j == 'ok')
        {   	
        	$('#paypal_submit').click();
       }
        else if(j == 'not')
        {
        	swal("Failure!", "Something Went Wrong", "error");
        }
        else if(j =='not_done')
        {
        	swal("Failure!", "Already in Process", "error");
        }
        else if(j=='fine_ok')
        {
        	$('#paypal_submit').click();
        }
    },       
    });
}); 
//paypal Insertion End HERe


 // Booking form start

$(".book_form").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'forms.php?book_now=101',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
        data1 = data.split(">>>");
        if(data1[0] == 'not_activate')
        {
            swal("Success!", "A Verification Link Sent on your Registered Email.Please Verify It", "success");
        }
        else if(data1[0] == 'not_login')
        {
        	$('.signlog').click();
        }
        else if(data1[0] == 'Already')
        {
        	swal('Error','Booking Already Done','error');
        }
        else if(data1[0] == 'ok')
        {     
      swal("Success!", "Your Booking order Has Been Placed", "success");   
      	window.location.href="booking-form.php?booking_id="+data1[1];
        }
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
        swal("Failure!", "Email Id already Exist!", "error");
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 
    


// Booking form end

 // Booking per hour form start

$(".book_form2_hour").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'forms.php?book_button_hour=101',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
        data1 = data.split(">>>");
        if(data1[0] == 'not_activate')
        {
            swal("Success!", "A Verification Link Sent on your Registered Email.Please Verify It", "success");
        }
        else if(data1[0] == 'not_login')
        {
        	$('.signlog').click();
        }
        else if(data1[0] == 'Already')
        {
        	swal('Error','Booking Already Done','error');
        }
        else if(data1[0] == 'ok')
        {     
      swal("Success!", "Your Booking order Has Been Placed", "success");   
      	window.location.href="booking-form.php?booking_id="+data1[1];
        }
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
        swal("Failure!", "Email Id already Exist!", "error");
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 
    


// Booking form end


	$('.anchor_click').click(function(){
		swal("Error!", "You Have To Login First", "error");
	});

	$('#drp_autogen0 .ui-button-text').html('Checkin Date - Checkout Date');

 $(".daterange1").daterangepicker({
     presetRanges: [{
         text: 'Today',
         dateStart: function() { return moment() },
         dateEnd: function() { return moment() }
     }, {
         text: 'Tomorrow',
         dateStart: function() { return moment().add('days', 1) },
         dateEnd: function() { return moment().add('days', 1) }
     }, {
         text: 'Next 7 Days',
         dateStart: function() { return moment() },
         dateEnd: function() { return moment().add('days', 6) }
     }, {
         text: 'Next Week',
         dateStart: function() { return moment().add('weeks', 1).startOf('week') },
         dateEnd: function() { return moment().add('weeks', 1).endOf('week') }
     }],
     applyOnMenuSelect: false,
     datepickerOptions: {
         minDate: 0,
         maxDate: null,
         numberOfMonths : 2
     }
 });

$('.carousel-inner div:first-child').addClass('active');
	// datepicker start		
	$('#datepicker1').change(function(){
		var date_val1 = $('#datepicker').val();
		var date_val2 = $(this).val();
		var price_cal = $('.ppnight').val();
		var placeid = $('.placeid_val').val();
		$.ajax({
			url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid,
			success: function(data)
			{	
				console.log('my data - '+data);
				// console.log("<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>");
				data1 = data.split('>>>');
				if(data1[3]=='0')
				{	
					$('#book_button').css('display','block');
					$('.errormessage22').css('display','none');
					$('.errormessage').css('display','block');
				console.log(data1[0]);
				console.log(data1[1]);
				console.log(data1[2]);
				if(data1[1]=='0')
				{
					var specific_price2=0;
				}
				else
				{			
				var specific_price = data1[0];
				specific_price1 = specific_price.split(',');
				var specific_price2=0;
				var counter = specific_price1.length;
				console.log('counter'+counter);
				for(var i=0; i<counter; i++)
				{
					if(specific_price1[i]=="")
					{
						continue;
					}
					specific_price2 = parseInt(specific_price2)+parseInt(specific_price1[i]);
				}
				}
				// console.log(specific_price2);
				var counts = data1[1];
				var regular_price = data1[2];
				var r_days = parseInt(regular_price)-parseInt(counts);
				var total = parseInt(price_cal)*parseInt(r_days);
				var grand_total = parseInt(total)+parseInt(specific_price2);
				console.log("grand_total"+grand_total);
				var avg_p = parseInt(grand_total)/parseInt(regular_price);
				avg_p = Math.round(avg_p);
				$.ajax({
				url:'forms2.php?taxesid=00',
				success: function(taxes)
				{
					console.log(taxes);
					var texes1 = taxes.split('===');
					if(texes1[0]==0)
					{

					}
					else
					{	
						var texes2 = texes1[0].split(',');
						var title = texes1[1].split(',');
						var count = texes2.length;
						var tax_data="";
						var tax_value="0";
						for(var j=0;j<count;j++)
						{
							var final = parseInt(texes2[j])*parseInt(regular_price);
							tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j]	+'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
							tax_value = parseInt(tax_value)+parseInt(final);
						}
						console.log("tax value"+tax_value)
						$('#forappend').html(tax_data);
						var final_total = parseInt(tax_value)+parseInt(grand_total);
						console.log("final"+final_total);
					}
					$('#price_per_week').val(avg_p);
					$('.night_rupee').html(avg_p);
					$('.price_cal').html(avg_p);
				$('.total_price_cal').html(final_total);
				$('.totalprice').val(final_total);
				$('.total_price').html(grand_total);
				$('.calculated').html(regular_price+' Nights');
				}
				});
			}
			else
			{	$('#book_button').css('display','none');
				$('.errormessage22').html("<p>Those Dates Are Not available<p>");
				$('.errormessage22').css('display','block');
				$('.errormessage').css('display','none');
			}
			}
		});
	});

	$('#datepicker').change(function(){
		var date_val1 = $(this).val();
		var date_val2 = $('#datepicker1').val();
		var price_cal = $('.ppnight').val();
		var placeid = $('.placeid_val').val();
		if(date_val2 > date_val1) {
		$.ajax({
			url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid,
			success: function(data)
			{
				console.log('mydata-'+data);
				// console.log("<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>");
			data1 = data.split('>>>');
			if(data1[3]=="0")
				{	
				$('#book_button').css('display','block');
					$('.errormessage22').css('display','none');
					$('.errormessage').css('display','block');
				console.log(data1[0]);
				console.log(data1[1]);
				console.log(data1[2]);
				if(data1[1]=='0')
				{
					var specific_price2=0;
				}
				else
				{			
				var specific_price = data1[0];
				specific_price1 = specific_price.split(',');
				var specific_price2=0;
				var counter = specific_price1.length;
				console.log('counter'+counter);
				for(var i=0; i<counter; i++)
				{
					if(specific_price1[i]=="")
					{
						continue;
					}
					specific_price2 = parseInt(specific_price2)+parseInt(specific_price1[i]);
				}
				}
				// console.log(specific_price2);
				var counts = data1[1];
				var regular_price = data1[2];
				var r_days = parseInt(regular_price)-parseInt(counts);
				var total = parseInt(price_cal)*parseInt(r_days);
				var grand_total = parseInt(total)+parseInt(specific_price2);
				console.log("grand_total"+grand_total);
				var avg_p = parseInt(grand_total)/parseInt(regular_price);
				avg_p = Math.round(avg_p);
				$.ajax({
				url:'forms2.php?taxesid=00',
				success: function(taxes)
				{
					console.log(taxes);
					var texes1 = taxes.split('===');
					if(texes1[0]==0)
					{

					}
					else
					{	
						var texes2 = texes1[0].split(',');
						var title = texes1[1].split(',');
						var count = texes2.length;
						var tax_data="";
						var tax_value="0";
						for(var j=0;j<count;j++)
						{
							var final = parseInt(texes2[j])*parseInt(regular_price);
							tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j]	+'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
							tax_value = parseInt(tax_value)+parseInt(final);
						}
						console.log("tax value"+tax_value)
						$('#forappend').html(tax_data);
						var final_total = parseInt(tax_value)+parseInt(grand_total);
						console.log("final"+final_total);
					}
					$('#price_per_week').val(avg_p);
					$('.night_rupee').html(avg_p);
					$('.price_cal').html(avg_p);
				$('.total_price_cal').html(final_total);
				$('.totalprice').val(final_total);
				$('.total_price').html(grand_total);
				$('.calculated').html(regular_price+' Nights');
				}
				});


			}
			else
			{
				$('#book_button').css('display','none');
				$('.errormessage22').css('display','block');
				$('.errormessage22').html("<p>Those Dates Are Not available<p>");
				$('.errormessage').css('display','none');
			}
			}
		});
	}
	});

$('#back').click(function(){
$('#edetails').css('display','block');
$('#ephotovideo').css('display','none');
});

$('#back1').click(function(){
$('#epricetermss').css('display','none');
$('#ephotovideo').css('display','block');
});

$("#input-4").fileinput({showCaption: false});
// message read script

$('.unread').click(function(){
	var msgid = $(this).data('msgid');
	$(this).css('background','#fff');
	var count = $('.inbox_count').html();

	var newcount = parseInt(count)-1;

	if(newcount != 0)
	{
		$('.inbox_count').html(newcount);
	}
	else
	{
		$('.inbox_count').hide();
	}

	$.ajax({
		url:'forms.php?message_id='+msgid,
		success: function(data)
		{

		}
	});

});


$('.phone').mask('9999-999999');

	  /*==============Smooth Scrolling JS==============*/

		// $(window).load(function(){
		// 	if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
		// 		window.onmousewheel = document.onmousewheel = wheel;

		// 		var time = 650;
		// 		var distance = 400;

		// 		function wheel(event) {
		// 			if (event.wheelDelta) delta = event.wheelDelta / 90;
		// 			else if (event.detail) delta = -event.detail / 2;
		// 			handle();
		// 			if (event.preventDefault) event.preventDefault();
		// 				event.returnValue = false;
		// 		}

		// 		function handle() {
		// 			$('html, body').stop(stop).animate({
		// 				scrollTop: $(window).scrollTop() - (distance * delta)
		// 			}, time);
		// 		}
		// })






/*==========Price table in Demo-velue fixing JS============*/
jQuery(function($) {
  function fixDiv() {
    var $cache = $('.price-table-demo');
    if ($(window).scrollTop() > 535)
      $cache.css({
        'position': 'fixed',
        'top': '-16px',
		'width':'50%',
		'z-index':'10',
		'right':'32px',
		'background':'rgb(255, 255, 255)',
		'padding':'16px',
		'box-shadow':'1px 1px 1px 1px #c3c3c3'
      });
    else
      $cache.css({
        'position': 'relative',
		'width':'auto',
		'right':'0px',
		 'top': '0px',
		'padding':'0',
		'box-shadow':'0px 0px 0px 0px #fff'

      });

  }
  $(window).scroll(fixDiv);
  fixDiv();
});






	$('#example').DataTable();
		$('#example1').DataTable();
		$('#example2').DataTable();
	/*============Dashboard bar JS=================*/
 var myurl=window.location.href;
//console.log(myurl);
if(myurl.indexOf('searchlst')>-1){
$('#one').addClass('btn-custom').siblings().removeClass('btn-custom');
}

if(myurl.indexOf('list-place')>-1){
$('#two').addClass('btn-custom').siblings().removeClass('btn-custom');
}

if(myurl.indexOf('list-service')>-1){
$('#three').addClass('btn-custom').siblings().removeClass('btn-custom');
}

/*if(myurl.indexOf('your-trip')>-1){
	console.log("exist");
$('#four').addClass('active').siblings().removeClass('active');
}


if(myurl.indexOf('profile')>-1){
	console.log("exist");
$('#five').addClass('active').siblings().removeClass('active');
}


if(myurl.indexOf('account')>-1){
	console.log("exist");
$('#six').addClass('active').siblings().removeClass('active');
}


if(myurl.indexOf('travel-credit')>-1){
	console.log("exist");
$('#seven').addClass('active').siblings().removeClass('active');
} */

	  /* jQuery('.same-class').click(function(){
jQuery('.same-class').removeClass('active');
jQuery(this).addClass('active');
}); */
	$('[data-toggle="tooltip"]').tooltip(); 
       
     	$(".btn-3").click(function(){
		$("#first-block").css('display','none');
		$("#third-block").css('display','none');
		$("#second-block").css('display','block');

});

     	$(".btn-4").click(function(){

		$("#first-block").css('display','none');
		$("#second-block").css('display','none');
		$("#third-block").css('display','block');

});



$('.btn-back').click(function(){
	$("#second-block").css('display','none');
	$("#third-block").css('display','none');
	$("#first-block").css('display','block');
});



$('a').click(function(){
	var nid= $(this).attr('class');
	console.log(nid);
	var coun ="1";
	$('.tab_in_dash').each(function(){
		var id = $(this).attr('id');
		console.log(id);	

		if(id==nid)
		{
			$(this).css('display','block');
		}
		else
		{
			$(this).css('display','none');
		}
	});
});
	


    /*========Menu add Class jquery=================*/
	
	jQuery('.same-class').click(function(){
 jQuery('.same-class').removeClass('active');
 jQuery(this).addClass('active');
});


   });
   
/*   	jQuery('.same-class1').click(function(){
 jQuery('.same-class1').removeClass(' btn-custom');
 jQuery(this).addClass(' btn-custom');
});


   });*/



   /*===============Scroll bar====================*/
   $(function(){
  var screenHeight = $(window).height();
  $(".sidebar").css("height",screenHeight);
});

$("a").click(function(){
  $(".sidebar").toggleClass("height");
});


$(window).scroll(function(){
  var scroll = $(window).scrollTop();

});

/*==========Show more Button JS============*/
    $("#more").click(function(){
        $(".custom-1").slideToggle(1000);
	});



/*==========Reply Button JS============*/
    $(".more-btn").click(function(){
    	$(this).hide();
        $(this).closest('div').find(".hides").show(500);
        $(this).next('button').show(700);
        $(this).next('button').next('button').show(700);

	});

	/*reply cancel js*/

	$('.cancel_btn').click(function(){	
		$(this).hide();
		$(this).prev('button').hide();
        $(this).closest('div').find(".hides").hide();
        $(this).prev('button').prev('button').show(500);

	});

	/*$('.send_btn').click(function(){	
		$(this).hide();
		$(this).next('button').hide();
        $(this).closest('div').find(".hides").hide();
        $(this).prev('button').show(500);
	});*/

	$(".more-btn1").click(function(){
        $(".hides1").show(300);
	});


$(function(){

      $(".hover-1").mouseover(function() {
          $(".list1").show();
      });
	  $(".hover-1").mouseleave(function() {
          $(".list1").hide();
      });
	  
	    $(".hover-2").mouseover(function() {
          $(".list2").show();
      });
	  $(".hover-2").mouseleave(function() {
          $(".list2").hide();
      });
	  
	    $(".hover-3").mouseover(function() {
          $(".list3").show();
      });
	  $(".hover-3").mouseleave(function() {
          $(".list3").hide();
      });
	  
	    $(".hover-4").mouseover(function() {
          $(".list4").show();
      });
	  $(".hover-4").mouseleave(function() {
          $(".list4").hide();
      });
});



        $('#select1').multiselect();
        $('#select2').multiselect();
         $('#select3').multiselect();
          $('#select4').multiselect();





/*=================================Date of Birth date picker=======================*/
function loadDatePicker()
{
    var today = new Date();
     $('.datePicker').datepicker({
         dateFormat: 'yy-mm-dd',
         changeYear: true,
         changeMonth: true,
         yearRange: "-60:-18",
       
     });
} 


     loadDatePicker();










/*=================No UI Slider JS=================*/

var select = document.getElementById('input-select');

// Append the option elements
for ( var i = 1; i <= 50000; i++ ){

	var option = document.createElement("option");
		option.text = i;
		option.value = i;

	select.appendChild(option);
}

var html5Slider = document.getElementById('html5');

noUiSlider.create(html5Slider, {
	start: [ 1, 500 ],
	connect: true,
	range: {
		'min': 1,
		'max': 50000
	}
});


var inputNumber = document.getElementById('input-number');

html5Slider.noUiSlider.on('update', function( values, handle ) {

	var value = parseInt(values[handle]);
	if ( handle ) {
		inputNumber.value = parseInt(value);
	} else {
		select.value = parseInt(value);
	}
});

select.addEventListener('change', function(){
	html5Slider.noUiSlider.set([this.value, null]);
});

inputNumber.addEventListener('change', function(){
	html5Slider.noUiSlider.set([null, this.value]);
});








var select1 = document.getElementById('input1-select');

// Append the option elements
for ( var i = -20; i <= 40; i++ ){

	var option1 = document.createElement("option1");
		option1.text = i;
		option1.value = i;

	select1.appendChild(option1);
}
var html6Slider = document.getElementById('html6');

noUiSlider.create(html6Slider, {
	start: [ 10, 30 ],
	connect: true,
	range: {
		'min': 1,
		'max': 500000
	}
});

var input1Number = document.getElementById('input1-number');

html6Slider.noUiSlider.on('update', function( values, handle ) {

	var value = parseInt(values[handle]);
	if ( handle ) {
		input1Number.value = parseInt(value);
	} else {
		select1.value = parseInt(value);
	}
});

select1.addEventListener('change', function(){
	html6Slider.noUiSlider.set([this.value, null]);
});

input1Number.addEventListener('change', function(){
	html6Slider.noUiSlider.set([null, this.value]);
});




$(function() {
  $('.ui.multiple.dropdown').dropdown({
		maxSelections: 4
	});
});






