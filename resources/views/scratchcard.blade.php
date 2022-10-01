<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Onam 2022 | Oxygen Digital Shop</title>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mainsheet.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/scratch-card.css') }}" >
	
		<!-- Including JS File Here -->
		
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
		<div class="col-xs-12 topcard justify-content-center center" style="background-color: none; margin-right: 0;" >
			<div class="row topcardcontent justify-content-center center" align='center'>
				<div class="row justify-content-center center" align='center'>
					<div class="col-xs-6" style="padding: 0px;">
						<div class="row justify-content-center center" align='center'>
							<img class="campaign-logo" src="{{ URL::asset('images/gift/campaign-logo/cropped-onam-small.png') }}">
						</div>
					</div>
					<div class="col-xs-6">
					<div class="row">
							<img src="{{ URL::asset('images/oxygensmall.png') }}">
						</div>
						<br>
						<br>
						<div class="row">
						<div class="container" id="js-container">
							@if(session('dpstatus'))
								@php
									$dpstatus = session('dpstatus');
									$gift = session('gift');
									$registration = session('registration');
								@endphp
  							<canvas class="canvas" id="js-canvas" width="300" height="250"></canvas>
  							@if($dpstatus == 'Success')
									<form class="form" style="visibility: hidden;">
										<h2>Congratulations!</h2>
										<h3>You have won!</h3>
										<p><code>{{ $gift }}</code></p>
										<div>
				  							<h2>Dear {{$registration->first_name}} {{$registration->last_name}} congratulations. You will be contacted on {{$registration->phone}} with further details. Sit tight!</h2>
										</div>
										<div>
											<h2>Thank you for your participation on behalf of Oxygen, Your Digital Expert. Happy Onam!</h2>
										</div>
									</form>
								@elseif($dpstatus == 'Failed')
									<form class="form" style="visibility: hidden;">
										<h2>Sorry!</h2>
										<h3>Better luck next time!</h3>
										<div>
											<h2>Thank you for you participation on behalf of Oxygen, Your Digital Expert. Happy Onam!</h2>
										</div>
									</form>		
								@endif
							@endif 
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>

	<script src="{{ URL::asset('js/scratch-card.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    	 $(document).ready(function(){
    	 	var loaded = false;
    	 	$('#categoryselection').change(function(){
    	 		var id = $(this).val();
    	 		var campaign = $('#campaignid').val();
    	 		$("option[class='removable']").remove();
    	 		$.ajax({
    	 			url: '/api/getGiftSubCategories',
    	 			type: "POST",
    	 			data: {campaign: campaign, category: id},
    	 			dataType: "json",
    	 			success: function(response){
    	 				//console.log(response);
    	 				//console.log(response.length);
    	 				for(var i=0;i<response.length;i++){
    	 					var divid = response[i].id;
    	 					var divname = response[i].name;
    	 					var option = "<option "+ '{{ old("division") == '+divid+' ? "selected":""}}'+" value='"+divid+"' class='removable'>"+divname+"</option>";
    	 					$("#subcategoryselection").append(option); 
    	 				}
    	 			}
    	 		});
    	 	});
    	 	var category = $('#categoryselection').val();
    	 	//console.log(category);
    	 	if(category != "" || category != '0'){
    	 		var id = category;
    	 		var campaign = $('#campaignid').val();
    	 		$("option[class='removable']").remove();
    	 		$.ajax({
    	 			url: '/api/getGiftSubCategories',
    	 			type: "POST",
    	 			data: {campaign: campaign, category: id},
    	 			dataType: "json",
    	 			success: function(response){
    	 				//console.log(response);
    	 				//console.log(response.length);
    	 				for(var i=0;i<response.length;i++){
    	 					var divid = response[i].id;
    	 					var divname = response[i].name;
    	 					var option = "<option "+ '{{ old("division") == '+divid+' ? "selected":""}}'+" value='"+divid+"' class='removable'>"+divname+"</option>";
    	 					$("#subcategoryselection").append(option); 
    	 				}
    	 			}
    	 		});
    	 	}
    	 });
    </script>
</html>
