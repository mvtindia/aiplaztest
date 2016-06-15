$(document).ready(function(){

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

  /*==============Hide and show Photo & Video=============*/


$('#back').click(function(){
  $("#pricetermss").css('display','none');
  $("#photovideo").css('display','none');
  $("#calender-tab").css('display','none');
  $("#details").css('display','block');
  
});
/*==============Hide and show Photo & Video close=============*/  


/*==============Hide and show Price & Terms=============*/


$('#back1').click(function(){

  $("#pricetermss").css('display','none');
  $("#calender-tab").css('display','none');
  $("#photovideo").css('display','block');
  $("#details").css('display','none');
  
});
/*==============Hide and show Price & Terms close=============*/

//show upload photo
$('.uploadphoto').click(function(){
    $(this).css('display','none');
    $('.upphoto').css('display','block');
});

//show upload video
$('.uploadvideo').click(function(){
    $(this).css('display','none');
    $('.upvideo').css('display','block');
});

 // signup form start

$("#signup_form").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'actions.php?value=101',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
        if(data == 'already')
        {
            swal("Failure!", "Email Id already Exist!", "error");
        }
        else if(data == 'done')
        {
            $("#signup_form")[0].reset();
            $('.showmsg').css('display','block');
            $('.showmsg').html('<font color="green">Successfully Registered. Now You can Login To Your Account!</font>');
            setTimeout(
                  function() 
                  {
                    $("#first-block").css('display','none');
                    $("#third-block").css('display','none');
                    $(".showmsg").css('display','none');
                    $("#second-block").css('display','block');
                  }, 2000);
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
    


// signup form end

$("#login").submit(function(e)
{
 
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        $('.showload').css('display','block');
        $('.showimg').css({'display':'block','margin':'0 auto','width':'53px'});
        $('.modal-content').css({'top':'212px','box-shadow':'none','background-color':'transparent','border':'none'});
        $('.hidecontent').css('display','none');
 
        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?login=01',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
                $('.showmsg').css('display','block');    
                if(data == 'wrong data')
                {
                $('.modal-content').removeAttr('style');
                  $('.showload').css('display','none');
                  $('.showimg').css({'display':'none','margin':'0 auto','width':'53px'});
                  $('.hidecontent').css('display','block');
                  $('.showmsg').html('<font color="red">Wrong Email Or Password</font>');

                }
                else if(data == 'done')
                {
                    $("#login")[0].reset();
                    $('.showmsg').html('<font color="green">You are Successfully Logged In</font>');
                    $('#myNavbar').load(window.location + ' #myNavbar');  
                    $("#myModal2").modal('hide');
                    $('.showload').css('display','none');

                    var url = $('.urlval').val();

                    if(url != "")
                    {
                      location.reload();
                    }
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

//profile image upload here
$("#upload_profile").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'actions.php?upload=001',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        $('#messages').html(data);
         $('#forclose').click(function(){
            window.location.href="dashboard.php";
         });
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
        console.log('error');
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 

//end here
//updation of data start  here

$("#updatedata").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'actions.php?update=003',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
          if(data == 'not')
        {
            swal("Oops!", "Unable To Update Your Profile Details", "error");
        }
        else if(data == 'done')
        {
            $("#login")[0].reset();
            swal("Success", "Profile Details are Updated Successfully ", "success");
            $('.confirm').click(function(){
                window.location.href="dashboard.php";
            });
        }   

        
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
        console.log('error');
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 

//end  here

// change password start here

$("#change_pass").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'actions.php?change_pass=003',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
            console.log(data);
          if(data == 'not')
        {
            swal("Oops!", "Unable To Update", "error");
        }
        else if(data == 'done')
        {
            swal("Success", "Password Changed Please Login Again", "success");
            $('.confirm').click(function(){
                window.location.href="index.php";
            });
        }  
        else if(data == 'donot')
        {
          swal("Oops!", "Password Does Not Matched", "error");
        } 
        else if(data == 'cupass')
        {
          swal("Oops!", "Please Check Your Password", "error");
        }
        else if(data == 'wrong')
        {
           swal("Oops!", "Please Login First", "error");
        }

        
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
        console.log('error');
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 
    
/* add place form start */
     $('form#add_place').submit(function() {
      $('.ishowload').css('display','block');
       var formData = new FormData($(this)[0]);
       //console.log('submitted');
       $.ajax({
           url: 'actions.php?place=001',
           type: 'POST',
           data: formData,
           async: false,
           success: function(data){
               $('.ishowload').css('display','none');
            var datas=data.split(",,,");
              console.log(data);
              if(datas[1]=='success')
              {       
              $('.placeid').val(datas[0]);
              $("#photovideo").css('display','block');
              $("#details").css('display','none');
              }
              else if(datas[0]=='error')
              {
                  swal({ title: 'Error', text: 'Something Went Wrong.', timer: 2000
});
              }
               else if(datas[0]=='login')
              {
                  swal({ title: 'Login First', text: 'You Have to login', timer: 2000
});
              }
             },
           cache: false,
           contentType: false,
           processData: false
       });
       return false;
   });

// photo n videos form submit ajax


$("form#photovideo").submit(function(e)
{
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        $('.ishowload').css('display','block');
        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?photo=123',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
              data1 = data.split(">>>");
              console.log(data1[0]+" "+data1[1]);
             if(data1[0]=="success"){
                 $('.ishowload').css('display','none');
              $("#pricetermss").css('display','block');
             $("#photovideo").css('display','none');
                }
             else if(data1[0]=='wrong_exe')
             {
                  swal('Wrong Dimension','The Image '+data1[1]+' have wrong size','error');
                  $('.ishowload').css('display','none');
                  $('.container-fluid').css('display','block');
                  $("#pricetermss").css('display','none');
                  $("#photovideoo").css('display','block');
             }
             else
             {
               swal('error','could not update','error');
                  $('.ishowload').css('display','none');
                  $('.container-fluid').css('display','block');
                  $("#pricetermss").css('display','none');
                  $("#photovideoo").css('display','block');
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




 $('#back2').click(function(){
                  $("#pricetermss").css('display','block');
                  $("#photovideo").css('display','none');
                  $("#calender-tab").css('display','none');
                  $("#details").css('display','none');

                });


//priceterms
$("#pricetermss").submit(function(e)
{
$('.ishowload').css('display','block');
   var formObj = $(this);

   if(window.FormData !== undefined)  // for HTML5 browsers
   {

       var formData = new FormData(this);
       $.ajax({
           url: 'actions.php',
           type: 'POST',
           data:  formData,
           mimeType:"multipart/form-data",
           contentType: false,
           cache: false,
           processData:false,
           success: function(data, textStatus, jqXHR)
           { 
            var datas=data.split(",,,");


            // if(datas[0]=="success"){    
                 $('.ishowload').css('display','none');
             $("#pricetermss").css('display','none');

              $("#calender-tab").css('display','block');
              $("#calender-tab").html(datas[1]);
            

             console.log(data);
            /* }
             else{
                 $('.ishowload').css('display','none');
              $('.container-fluid').css('display','block');
              $("#calender-tab").css('display','none');
             $("#pricetermss").css('display','block');
             }*/

                $('#back2').click(function(){
                  $("#pricetermss").css('display','block');
                  $("#photovideo").css('display','none');
                  $("#calender-tab").css('display','none');
                  $("#details").css('display','none');

                });

                

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



   
//var plabel=$('#plabel').val();

  //alert(plabel);
/*var plabel=$('#plabel').val();
var pstatus=$('.pstatus').val();
var pdate1=$('#pdate1').val();
var pdate2=$('#pdate2').val();
var ptime1=$('#ptime1').val();
var ptime2=$('#ptime2').val();
var repetition=$('.repetition').val();
var ptime2=$('#ptime2').val();*/

$('.pwd').keyup(function(){
    $('.showmsg').css('display','block');
    var password = $('.pwd');
passwordCheck(password);
});



/* edit place form start */
     $('form#edit_place').submit(function() {
      $('.ishowload').css('display','block');
       var formData = new FormData($(this)[0]);
       //console.log('submitted');
       $.ajax({
           url: 'actions.php?eplace=001',
           type: 'POST',
           data: formData,
           async: false,
           success: function(data){
               $('.ishowload').css('display','none');
            var datas=data.split(",,,");
              console.log(data);
              if(datas[1]=='success')
              {       
              $('.placeid').val(datas[0]);
              swal('Success','Updated Successfully','success');
              $("#ephotovideo").css('display','block');
              $("#edetails").css('display','block');
              }
              else if(datas[0]=='error')
              {
                  swal({ title: 'Error', text: 'Unable to Update details.', timer: 2000
});
              }
               else if(datas[0]=='login')
              {
                  swal({ title: 'Login First', text: 'You Have to login First', timer: 2000
});
              }
             },
           cache: false,
           contentType: false,
           processData: false
       });
       return false;
   });

//photo delete on click
$('.cross-hover').click(function(){
  $(this).css('display','none');
  $(this).prev().css("cssText", "display: none !important;");
  var pid=$(this).data('pid');
  var pg=$('#pg').val();
  var plid=$('#placeid1').val();

   $.ajax({
           url: 'actions.php?delpic=el_del&pid='+pid+'&pg='+pg+'&plid='+plid,
           success: function(data){
            console.log(data);
           if(data=="success"){  
              window.location.href="edit-place.php?placeid="+plid+"&unique1=20";
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });
 });

//photo delete on click
$('.scross-hover').click(function(){
  $(this).css('display','none');
  $(this).prev().css("cssText", "display: none !important;");
  var pid=$(this).data('pid');
  var pg=$('#pg').val();
  var plid=$('#placeid1').val();

   $.ajax({
           url: 'actions.php?sdelpic=el_del&pid='+pid+'&pg='+pg+'&plid='+plid,
           success: function(data){
            console.log(data);
           if(data=="success"){  
              window.location.href="edit-service.php?sid="+plid;
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });
 });

//video delete on click
$('.vcross-hover').click(function(){
  $(this).css('display','none');
  $(this).prev().css("cssText", "display: none !important;");
  var pid=$(this).data('pid1');
  var pg1=$('#pg1').val();
  var pg2=$('#pg2').val();
  var plid=$('#placeid1').val();
   $.ajax({
           url: 'actions.php?delvideo=vdel&vpid='+pid+'&vpg1='+pg1+'&vpg2='+pg2+'&vplid='+plid,
           success: function(data){
            console.log(data);
           if(data=="success"){  
              //$("#ephotovideo").css('display','none');
              window.location.href="edit-place.php?placeid="+plid+"&unique1=20";
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });
 });

$('.svcross-hover').click(function(){
  $(this).css('display','none');
  $(this).prev().css("cssText", "display: none !important;");
  var pid=$(this).data('pid1');
  var pg1=$('#pg1').val();
  var pg2=$('#pg2').val();
  var plid=$('#placeid1').val();
   $.ajax({
           url: 'actions.php?sdelvideo=vdel&vpid='+pid+'&vpg1='+pg1+'&vpg2='+pg2+'&vplid='+plid,
           success: function(data){
            console.log(data);
           if(data=="success"){  
              //$("#ephotovideo").css('display','none');
              window.location.href="edit-service.php?sid="+plid;
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });
 });

// update photo n videos form submit ajax


$("form#ephotovideo").submit(function(e)
{
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        $('.ishowload').css('display','block');
        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?qephoto=123',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
              var data1 = data.split(">>>");
             if(data1[0]=="success"){
                 $('.ishowload').css('display','none');
              $("#epricetermss").css('display','block');
             $("#ephotovideo").css('display','block');
             swal('Success','Updated Successfully','success');
             }
             else if(data1[0]=='wrong_exe')
             {
                  swal('Wrong Dimension','The Image '+data1[1]+' have wrong size','error');
                   $('.ishowload').css('display','none');
              $('.container-fluid').css('display','block');
              $("#epricetermss").css('display','none');
             $("#ephotovideoo").css('display','block');
             }
             else{
               swal('Error','Wrong Extension','error');
                   $('.ishowload').css('display','none');
              $('.container-fluid').css('display','block');
              $("#epricetermss").css('display','none');
             $("#ephotovideoo").css('display','block');
             }
             //console.log(data);
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


//calender price  update

$('.onclcick_submit_price').click(function(){
  var clid = $(this).val();
  var m = $(this).attr('id');
  var value_in =""; 
  $('.'+m).each(function(){
    value_in = value_in+$(this).val()+",";
  });
  value_in = value_in.split(',');
  var ppn = value_in[0];
  var pph = value_in[1];
  var wppn = value_in[2];
     $.ajax({
           url: 'actions.php?calneder_id='+clid+'&cal_ppn='+ppn+'&cal_pph='+pph+'&cal_wppn='+wppn,
           success: function(data){
            console.log(data);
           if(data=="ok"){  
              swal({ title: "Updated!",  text: "Price Updated Successfully",   timer: 1000,   showConfirmButton: true });
           }
           else
           {
            alert("not");
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });
});
//end here


//calender price  update
$('.onclcick_submit_price1').click(function(){
  var clid = $(this).val();
  var m = $(this).attr('id');
  var value_in =""; 
  $('.'+m).each(function(){
    value_in = value_in+$(this).val()+",";
  });
  value_in = value_in.split(',');
  var ppn = value_in[0];
  var pph = value_in[1];
  var wppn = value_in[2];
     $.ajax({
           url: 'actions.php?calneder_id1='+clid+'&cal_ppn='+ppn+'&cal_pph='+pph+'&cal_wppn='+wppn,
           success: function(data){
            console.log(data);
           if(data=="ok"){  
              swal({ title: "Updated!",  text: "Price Updated Successfully",   timer: 1000,   showConfirmButton: true });
           }
           else
           {
            alert("not");
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });
});
//end here

//delete price calenderdata
$('.onclcick_delete_price').click(function(){
var d_cal = $(this).val();
    $.ajax({
           url: 'actions.php?deletecalneder_id='+d_cal,
           success: function(data){
            console.log(data);
           if(data=="ok"){  
             // $('.for_re').load(window.location + ' .for_re');
              // $(this).attr('disabled');
              $('#the'+d_cal).parent('div').parent('div').css('display','none');
           }
           else
           {
            alert("not");
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });

});
//end here

//delete price servicedata
$('.onclcick_delete_price1').click(function(){
var d_cal = $(this).val();
    $.ajax({
           url: 'actions.php?deletecalneder_id1='+d_cal,
           success: function(data){
            console.log(data);
           if(data=="ok"){  
             // $('.for_re').load(window.location + ' .for_re');
              // $(this).attr('disabled');
              $('#the'+d_cal).parent('div').parent('div').css('display','none');
           }
           else
           {
            alert("not");
           } 
           },
           cache: false,
           contentType: false,
           processData: false
       });

});
//end here


// update price of place Start HERE
$("form#epricetermss").submit(function(e)
{
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        $('.ishowload').css('display','block');
        var formData = new FormData(this);
        $.ajax({
            url: 'actions.php?qeprice_place=123',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
              console.log(data);
             if(data=="success"){
                 $('.ishowload').css('display','none');
                 swal('Success','Updated Successfully','success');
              $("#epricetermss").css('display','block');
             $(".for_claender_data").css('display','block');
             }

             else{
                 $('.ishowload').css('display','none');
              $("#epricetermss").css('display','block');
             }
             //console.log(data);
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
//end  HERE


$('#add_cal_price').click(function(){
$('#cal_data_cl').css('display','block');
});

$(".enquiry_form").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: 'forms.php?senquiry=101',
        type: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {   
        console.log(data);
        if(data == 'error')
        {
                  swal({ title: 'Error', text: 'Error in sending your Enquiry', timer: 2000});
        }
        else if(data == 'success')
        {
            $(".enquiry_form")[0].reset();
                  swal({ title: 'Success', text: 'Your Enquiry is sent!', timer: 2000});         
        }
        console.log(data);
    },
     error: function(jqXHR, textStatus, errorThrown) 
     {
                  swal({ title: 'Error', text: 'Error in sending your Enquiry', timer: 2000});
     }          
    });
    e.preventDefault(); //Prevent Default action. 
    e.unbind();
}); 

// reviews n ratings form

$("#place_ratings").submit(function(e)
{
    var formObj = $(this);
 
    if(window.FormData !== undefined)  // for HTML5 browsers
    {
        var formData = new FormData(this);
        $.ajax({
            url: 'new-actions.php?ratings=submit',
            type: 'POST',
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus, jqXHR)
            {
               if(data == 'given')
               {
                $("#place_ratings")[0].reset();
                swal('Success','Reviews Submitted Successfully','success');
               }
               else if(data == 'not login')
               {
                    $('.signlog').click();

                    $('.urlval').val('reload');

                   // $(".container-fluid" ).load( "demo-venue.php", {"placeid":"exist"});
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


$('.note-click').click(function(){
  var noteid = $(this).data('note');
  console.log(noteid);
  $.ajax({
    url:'new-actions.php?noteid='+noteid,
    success: function(data)
    {
      var notes =  $('.notes_count').html();
       notes = parseInt(notes)-1;
      if(notes>0)
      {
        $('.notes_count').html(notes);
      }
      else
      {
        $('.notes_count').css('display','none');
      }
      $('#note'+noteid).css('background','#fff');

    }
  });
});

}); // document ready close

function passwordCheck(password){
var passw=  /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
var patt = new RegExp(passw);
var res = patt.test(password.val());  
    if(res){
     $('.showmsg').html("");
     $('#signup').prop('disabled',false);
    } 
    else{    
        $('.showmsg').html("<font color='red'>Password should contain atleast One Digit</font>");
     $('#signup').prop( "disabled", true );
    }   
}

