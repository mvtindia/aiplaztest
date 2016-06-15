$(document).ready(function(){
  $('#select1').next('div').css('width','100%');

  // form submit ajax

function getDoc(frame) {
     var doc = null;
 
     // IE8 cascading access check
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }
 
     if (doc) { // successful getting content
         return doc;
     }
 
     try { // simply checking may throw in ie8 under ssl or mismatched protocol
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         // last attempt
         doc = frame.document;
     }
     return doc;
 }

 // compose msg start

$('#compose_msg').submit(function(e)
{
 
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
 
        var formData = new FormData(this);
        $.ajax({
            url: 'forms.php?composing=msg',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
              
              if(data == 'sent')
              {
                $('.close').click();
                swal('Success!','Message Sent','success');
                $('#compose_msg')[0].reset();
                $('.multiselect-selected-text').html('None selected');
                $('.multiselect-container li').removeClass('active');
              }
              else
              {
                swal('Failure!','Message Not Sent','error');
              }
            },
       });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());
 
        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
 
        //hide it
        iframe.hide();
 
        //set form target to iframe
        formObj.attr('target',iframeId);
 
        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.
 
        });
 
    }     
});

// compose msg form close


// rpl msg start

$('#rpl_form').submit(function(e)
{
 
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
 
        var formData = new FormData(this);
        $.ajax({
            url: 'forms.php?replying=msg',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
             
              if(data == 'msg sent')
              {
                $('.more-btn').show(500);
                $('.hides').hide();
                $('.cancel_btn').hide();
                $('.send_btn').hide();
                swal('Success!','Message Sent','success');
                $('#rpl_form')[0].reset();
              }
              else
              {
                swal('Failure!','Message Not Sent','error');
              }
            },
       });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());
 
        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
 
        //hide it
        iframe.hide();
 
        //set form target to iframe
        formObj.attr('target',iframeId);
 
        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.
 
        });
 
    }     
});

// rpl msg end


 // booking form 2 start
/*
$('.booking_form').submit(function(e)
{
 
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
 
        var formData = new FormData(this);
        $.ajax({
            url: 'forms.php?booking=confirm',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
              if(data == 'confirm')
              {
                swal('Success','Details Submitted','success');
              }
              else
              {
                swal('Failure','Some Error Occurred','error');
              }
            },
       });
        e.preventDefault();
        e.unbind();
   }
   else  //for olden browsers
    {
        //generate a random id
        var  iframeId = 'unique' + (new Date().getTime());
 
        //create an empty iframe
        var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
 
        //hide it
        iframe.hide();
 
        //set form target to iframe
        formObj.attr('target',iframeId);
 
        //Add iframe to body
        iframe.appendTo('body');
        iframe.load(function(e)
        {
            var doc = getDoc(iframe[0]);
            var docRoot = doc.body ? doc.body : doc.documentElement;
            var data = docRoot.innerHTML;
            //data is returned from server.
 
        });
 
    }     
});*/

// booking form 2 close


//services
$("#serviceform").submit(function(e)
{
$('.ishowload').css('display','block');
    $('.container-fluid').css('display','none');
   var formObj = $(this);

   if(window.FormData !== undefined)  // for HTML5 browsers
   {
       var formData = new FormData(this);
       $.ajax({
           url: 'forms.php?saveservice=individual',
           type: 'POST',
           data:  formData,
           mimeType:"multipart/form-data",
           contentType: false,
           cache: false,
           processData:false,
           success: function(data, textStatus, jqXHR)
           {  
            console.log(data);
            $('.ishowload').css('display','none');
              $('.container-fluid').css('display','block'); 
            var datas=data.split(",,,");
            if(datas[1]=='success')
            {
             $(".service1").css('display','none');       
             $(".service2").css('display','block');       
             $(".service2").html(datas[2]);   
             }
             else if(datas[1]=='wrong_exe')
             {
              swal('Wrong Extension','The Image '+datas[2]+' have wrong Extension','error')
              $(".service1").css('display','block');       
             $(".service2").css('display','none');  
             }    
             else
             {
                swal('Error','Unable to Update','error')
              $(".service1").css('display','block');       
             $(".service2").css('display','none'); 
             }
           },
      });
       e.preventDefault();
       e.unbind();
  }
  else  //for olden browsers
   {
       //generate a random id
       var  iframeId = 'unique' + (new Date().getTime());

       //create an empty iframe
       var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

       //hide it
       iframe.hide();

       //set form target to iframe
       formObj.attr('target',iframeId);

       //Add iframe to body
       iframe.appendTo('body');
       iframe.load(function(e)
       {
           var doc = getDoc(iframe[0]);
           var docRoot = doc.body ? doc.body : doc.documentElement;
           var data = docRoot.innerHTML;
           //data is returned from server.

       });

   }     
});

//editservices
$("#editserviceform").submit(function(e)
{
$('.ishowload').css('display','block');
   //$('.container-fluid').css('display','none');
   var formObj = $(this);

   if(window.FormData !== undefined)  // for HTML5 browsers
   {
       var formData = new FormData(this);
       $.ajax({
           url: 'forms.php?editservice=aaa',
           type: 'POST',
           data:  formData,
           mimeType:"multipart/form-data",
           contentType: false,
           cache: false,
           processData:false,
           success: function(data, textStatus, jqXHR)
           {  
            console.log(data);
            var data1 = data.split(">>>");
            if(data1[0]=='success')
            {
            $('.ishowload').css('display','none');
             // $('.container-fluid').css('display','block'); 
               $(".service1").css('display','none');       
             $(".service2").css('display','block');
             }
             else if(data1[0]=='wrong_exe')
             {
              swal('Wrong Dimension','The Image '+data1[1]+' have wrong size','error');
             $(".service1").css('display','block');       
             $(".service2").css('display','none');
             }
             else
             {
        swal('Error','Unable to Update','error');
             $(".service1").css('display','block');       
             $(".service2").css('display','none');
             } 
           /* var datas=data.split(",,,");
             $(".service1").css('display','none');       
             $(".for_service_data").css('display','block');       
             $(".service2").html(datas[2]);*/   
              //swal('Success!','Details are updated successfully','success');    
           },
      });
       e.preventDefault();
       e.unbind();
  }
  else  //for olden browsers
   {
       //generate a random id
       var  iframeId = 'unique' + (new Date().getTime());

       //create an empty iframe
       var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

       //hide it
       iframe.hide();

       //set form target to iframe
       formObj.attr('target',iframeId);

       //Add iframe to body
       iframe.appendTo('body');
       iframe.load(function(e)
       {
           var doc = getDoc(iframe[0]);
           var docRoot = doc.body ? doc.body : doc.documentElement;
           var data = docRoot.innerHTML;
           //data is returned from server.

       });

   }     
});

}); // document brackets close
 
