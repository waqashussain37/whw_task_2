<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://parsleyjs.org/dist/parsley.js"></script>
  <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
   <meta name="csrf-token" content="{{ csrf_token() }}" />
  <style type="text/css">
  	.btnic {
    	background-color: #6a6a6a;
    	border: none;
    	color: white;
    	padding: 5px 16px;
    	text-align: center;
    	font-size: 17px;
    	cursor: pointer;
    	border-radius: 5px;
	}
	button.btnic .fa {
    	font-size: 25px;
	}
 /* .container {
    padding: 30px;
    max-width: 100%;
    width: 600px;
    border: 1px solid #d0c9c9;
    margin-top: 40px;
    box-shadow: 5px 5px #b7b7be, 10px 10px #eeeaea00, 15px 15px #f4f4f4;
}*/
#message{
  padding: 10px;
  background-color: green;
  color: #fff;
  font-size: 16px;
  font-weight: 600px;
}

  </style>

</head>
<body>

<div class="container">
  <h2>@yield('title')</h2>
    @yield('content')
</div>

<script type="text/javascript">
  $(document).ready(function(){
      $('#userFormId').parsley();
      $('#userFormId').submit(function(e){
        e.preventDefault();
        if($('#userFormId').parsley().isValid()){
          $.ajax({
            url:"{{ route('users.store') }}",
            data: $(this).serialize(),
            type: 'POST',
            success:function(response){
               //var responeData = jQuery.parseJSON(response);
               if(response['status'] == 'ok'){
                  $('#message').html(response['message']).fadeIn('slow');
                  setTimeout(function(){
                     $('#message').hide();
                  },5000);
               } else {
                  $('#message').html(response['message']).fadeIn('slow');
                  setTimeout(function(){
                     $('#message').hide();
                  },5000);
               }
            }
          });
        }
      });
  });


$(".deleteRecord").click(function(e){
    e.preventDefault();
    if(!confirm('Are you sure you want to delete this entry?')){
      return false;
    }
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    var el = $(this);
    $.ajax({
        url:"{{url('users')}}"+'/'+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (response){
          if(response['status'] == 'ok'){
            $('#message').html(response['message']).fadeIn('slow');
            setTimeout(function(){
              $('#message').hide();
            },5000);
            $(el).closest('tr').css('background','tomato');
            $(el).closest('tr').fadeOut(500,function(){
              $(this).remove();
            });
          } else{
            $('#message').html(response['message']).fadeIn('slow');
              setTimeout(function(){
                $('#message').hide();
            },5000);
          }
        }
    });
});

$(".editUser").click(function(e){
    e.preventDefault();
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url:"{{url('users')}}"+'/'+id+'/edit',
        type: 'GET',
        success: function (response){
          if(response['status'] == 'ok'){
             $('#userId').val(response['data']['id']);
             $('#firstName').val(response['data']['firstName']);
             $('#lname').val(response['data']['lastName']);
             $('#age').val(response['data']['age']);
             $('#dob').val(response['data']['dob']);
             $('#phoneNumber').val(response['data']['phoneNumber']);
             $('#bio').val(response['data']['bio']);
          } else {
            return false;
          }
        }
    });
});


  $(document).ready(function(){
      $('#userEditFormId').parsley();
      $('#userEditFormId').submit(function(e){
        e.preventDefault();
        if($('#userEditFormId').parsley().isValid()){
          var id = $('#userId').val();
          $.ajax({
            url:"{{url('users')}}"+'/'+id,
            data: $(this).serialize(),
            type: 'PUT',
            success:function(response){
               if(response['status'] == 'ok'){
                  $('#exampleModalCenter').addClass('').removeClass('in');
                  $('.modal-backdrop').addClass('').removeClass('in');
                  $('.modal-backdrop').css('position','unset');
                  $('body').addClass('').removeClass('modal-open');
                  $('body').css('padding-right','unset');
                  $('#exampleModalCenter').hide();
                  $('#message').html(response['message']).fadeIn('slow');
                  setTimeout(function(){
                     $('#message').hide();
                  },5000);
                  var currentRow = $('#row'+id);
                  currentRow.find("td:eq(1)").text(response['data']['firstName']);
                  currentRow.find("td:eq(2)").text(response['data']['lastName']);
                  currentRow.find("td:eq(3)").text(response['data']['email']);
                  currentRow.find("td:eq(4)").text(response['data']['age']);
                  currentRow.find("td:eq(5)").text(response['data']['dob']);
                  currentRow.find("td:eq(6)").text(response['data']['phoneNumber']);
                 
               } else {
                  $('#message').html(response['message']).fadeIn('slow');
                  setTimeout(function(){
                     $('#message').hide();
                  },5000);
               }
            }
          });
        }
      });
  });
</script>

</body>
</html>
