<!DOCTYPE html>
<html>
<head>
	<title>Star Rating Project</title>
	<meta charset="utf-8">
<!-- 	<meta name="viewport" content="width-device-width, initial-scale=1.0">
 -->	
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="index.js"></script>
	 <!-- http://codepen.io/rafaelcastrocouto/pen/xowHE Codepen to get other character values--> 
	<style>
		.rating span:before { 
            content: "\2606"; 
        } 
        .rating .blank:before { 
            content: "\2605"; 
        } 
        .rating{ 
        	font-size:26px; 
        }
        #preivew{ 
            font-size: 14px; 
        }
        .btn{ 
            background-color:blue; 
            border:none; 
            color:white; 
            padding:5px; 
            text-align:center; 
            text-decoration:none; 
            display:inline-block; 
            font-size:16px; 
        }   
	</style>
</head>
<body>
	<div class="head">
	<div class="alert alert-primary" role="alert">
  	A Simple Image rating System—check it out!<hr>
  	To start Click on the Button New Image
	</div>
	</div>
	<div class="card" style="width: 40rem;">
		<div><img src="" class="card-img-top" id="img"><div id="preview"></div></div>

  	<div class="card-body">
    <p class="card-text">
    	
    	<div class="rating"></div>
    
    <div id="newimage" class="btn">New Image</div>
	</p>
  	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
	<script>
		$(document).ready(function(){
		var newload = true;
 		var randomimage = 0;

 			$('#newimage').click(function(){
 				loadimage();
 			});
 			

 			$('.rating').on('mouseenter','span', function(){            
 			 	$(this).toggleClass('blank'); 
 			});
 			$('.rating').on('mouseleave','span', function(){            
 				$(this).toggleClass('blank'); 
 			});
 			$('.rating').on('click','span', function(){  
 				if (newload) {
 				var index = $(this).index()+1;  
 				var dataString = 'image='+randomimage+'&vote='+index;
 				$('rating span').css("color","black");
 				$(this).prevAll().css("color","red");
 				$(this).css("color","red");
 				$.ajax({
 				type : "POST",
 				url : "add.php",
 				data : dataString,
 				datatype : "json",
 				success : function(data){
 					console.log(data);
 					newload = false; $('.rating').on('mouseenter','span', function(){            $(this).toggleClass('blank'); });
 					$('.rating').append(' <strong>'+data['type']+'</strong>');
 				}
 			});          
 				console.log(index);
 			}
 			});
 		function loadimage(){
 			$('.head').html('');
 			$('.head').append('<div class="alert alert-primary" role="alert">'+
  			'Give The Image Rating!! Click New Image to View Next Image'+
			'</div>');
 			$('.rating').html('');
 			$('.rating').append('<span></span><span></span><span></span><span></span><span></span>');
 			newload = true;
 			$.ajax({
 				type : "POST",
 				url : "server.php",
 				datatype : "json",
 				success : function(data){
 					console.log(data);
 					randomimage = data['id'];
 					$("#img").attr("src",data['image']);
 					$('#preview').html('Total Votes: '+data['votes']+' Average: '+data['average']);
 				}
 			});
 		}
		});
	</script>
</body>
</html>