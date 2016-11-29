$("#signup_form").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: '/actions.php?value=101',
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