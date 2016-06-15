$(document).ready(function(){
	
	//slide1 button
	$(".ckeditorsave").click(function(){
		var content=CKEDITOR.instances.editor1.getData();
		 var path = $('#path').val();
               console.log(path);
			    var text = content.replace('color:#', 'color:');
		$.ajax({
			url:'updatedisclaimer.php?content='+text+'&path='+path,
			success: function(data)
			{
             $("#message").html(data);
			}
		});
	});
	
$(".printbtn").click(function(){
	window.location.href="newreport.php";
});


$('form#addtypeform').submit(function() {
		var content=CKEDITOR.instances.editor1.getData();
		//var contents=CKEDITOR.instances.editor2.getData();
       var formData = new FormData($(this)[0]);
       var text = content.replace('color:#', 'color:');
	  // var texts = contents.replace('color:#', 'color:');
       //console.log('submitted');
      // console.log(contents);
       $.ajax({
           url: 'insertproduct.php?content='+text,
           type: 'POST',
           data: formData,
           async: false,
           success: function(data){
             $("#message").html(data);
             //location.reload();
           },
           cache: false,
           contentType: false,
           processData: false
       });
       return false;
   })




$('form#addtypeform1').submit(function() {
    var content=CKEDITOR.instances.editor1.getData();
    //var contents=CKEDITOR.instances.editor2.getData();
       var formData = new FormData($(this)[0]);
       var text = content.replace('color:#', 'color:');
    // var texts = contents.replace('color:#', 'color:');
       //console.log('submitted');
      // console.log(contents);
       $.ajax({
           url: 'upproduct.php?content='+text,
           type: 'POST',
           data: formData,
           async: false,
           success: function(data){
             $("#message").html(data);
             //location.reload();
           },
           cache: false,
           contentType: false,
           processData: false
       });
       return false;
   });
   	
});

