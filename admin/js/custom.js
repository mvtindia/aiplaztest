$(document).ready(function(){

    $('.datepicker').datepicker({ format:'dd-mm-yyyy' });

$('.editpic').click(function(){
    $(this).hide();
    $('.dispic').show();
});

 $("#edit").click(function(){
    $('.rd').show();
    $('#edit').hide();
        $(".rd").animate({right: '5px'});
    });
$("#close").click(function(){
    $('.rd').hide();
    $('#edit').show();
        $(".rd").animate({left: '5px'});
    });

$('.status').click(function(){
  var statusval = $(this).closest('td').find('.reg').val();
  $.ajax({
    url:'actions.php?statusval='+statusval,
    success:function(data)
    {
     // console.log(data);
     $('.wrapper').html(data);
    }
  });
});

$('.activestatus').click(function(){
  var statusval = $(this).closest('td').find('.reg').val();
  $.ajax({
    url:'actions.php?activestatus='+statusval,
    success:function(data)
    {
     // console.log(data);
     $('.wrapper').html(data);
    }
  });
});


 $('.editslide').click(function(){
        var slidecode = $(this).closest('div').find('.slidecode').val();
        console.log(slidecode);

        $.ajax({
            url:'sliders.php?code='+slidecode,
            success:function(data)
            {
                $(".wrapper").html(data);
            }
        });
    });

    $('.editmega').click(function(){
        var slidecode = $(this).closest('div').find('.slidecode').val();
        console.log(slidecode);

        $.ajax({
            url:'megaevent.php?code='+slidecode,
            success:function(data)
            {
                $(".wrapper").html(data);
            }
        });
    });

    $('.editstory').click(function(){
        var slidecode = $(this).closest('div').find('.slidecode').val();
        console.log(slidecode);

        $.ajax({
            url:'storyedit.php?code='+slidecode,
            success:function(data)
            {
                $(".wrapper").html(data);
            }
        });
    });

//confirm password code End

$("#oldpass").blur(function(){
var oldpas = $("#oldpass").val();
var pswrd = $("#pswrd").val();
    //alert(oldpass);
    //alert(pswrd);
$.ajax({
  url: "process.php",
                type: "POST",
                data: {oldpas:oldpas,pswrd:pswrd},
                success: function(data){
                   if(data=="matches"){ 
                       $('#oldpass').css('border-color','green');
                       $("#passsubmit").removeAttr('disabled');
                    } else {
                       $('#oldpass').css('border-color','red');
                       $("#passsubmit").attr("disabled","disabled");
                    }


                  //$('.result').css('display','block');
                  //$('.result').html(data);
                  //console.log('working:'+data);
                }
                });  
      });

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
$("#events_form").submit(function(e)
{
 e.preventDefault();
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
 
        var formData = new FormData(this);
        //alert(formData);
        var newpass = $("#pass").val();
        var checkVal = $("#cpass").val();
        //alert(newpass);
        //alert(checkVal);
        if (newpass == '') {
          $("#pass").after('<span class="error"></span>');
            $("#pass").after('<span class="error">Please enter a password.</span>');
            hasError = true;
        } else if (checkVal == '') {
            $("#cpass").after('<span class="error">Please re-enter your password.</span>');
            hasError = true;
        } else if (newpass != checkVal ) {
            //$("#cpass").after('<span class="error"></span>');
            //$("#cpass").after('<span class="error">Passwords do not match.</span>');
              $('.cpasserr').css('display','block');
              $('.cpasserr').html(data);

            hasError = true;
        }
          else if (newpass == checkVal)
          {
            hasError = false;
          //alert("abc");
        if(hasError == false) {
          //alert(newpass);
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
              $('.result').css('display','block');
              $('.result').html(data);
              // $('form#events_form')[0].reset();
            },
       });
          }
        };
        if(hasError == true) {return false;}
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
//confirm password code End
   
});