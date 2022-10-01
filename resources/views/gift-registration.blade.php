<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Onam 2022 | Oxygen Digital Shop</title>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mainsheet.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/slide-form.css') }}" >
	
		<!-- Including JS File Here -->

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
    	@if($campaign != null)
		<div class="col-xs-12 topcard justify-content-center center" style="background-color: none; margin-right: 0;" >
			<div class="row justify-content-center center" style="align :center;">
				<ul id="progressbar">
					<li>
						<div id="active1" class="progressdot justify-content-center center" style="align :center;">
							<p>1</p>
						</div>
					</li>
					<li>
						<div id="active2" class="progressdot justify-content-center center" style="align :center;">
							<p>2</p>
						</div>
					</li>
					<li>
						<div id="active3" class="progressdot justify-content-center center" style="align :center;">
							<p>3</p>
						</div>
					</li>
				</ul>
			</div>
			<div class="row topcardcontent justify-content-center center" align='center'>
				<div class="row justify-content-center center" align='center'>
					<div class="col-xs-6" style="padding: 50px;">
						<div class="row justify-content-center center" align='center'>
							<img class="campaign-logo" src="{{ URL::asset('images/gift/campaign-logo/cropped-onam-small.png') }}">
						</div>
					</div>
					<div class="col-xs-6">
					<div class="row justify-content-center center" align='center'>
							<img src="{{ URL::asset('images/oxygensmall.png') }}">
						</div>
						<div class="row justify-content-center center" align='center'>
							<form class="regform" method="POST" action="/giftRegister">
								@csrf
								<!-- Progressbar -->
								<!-- Fieldsets -->
								<fieldset id="first">
									<h2 class="title">Tell us a little bit about you</h2>
									<!-- <label>First Name:*</label> -->
									<input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="Enter your first name *" value="{{ old('first_name') }}" required>
        							@error('first_name')
        								<span class="badge badge-danger">Enter a valid first name</span>
        							@enderror
									<!-- <label>Last Name:*</label> -->
									<input type="hidden" class="form-control" name="last_name" placeholder="Enter your last name *" value="." required>
									<!-- <label>Phone:*</label> -->
        							<input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter your phone number *" value="{{ old('phone') }}" required>
        							@error('phone')
        								<span class="badge badge-danger">Enter a valid phone number</span>
        							@enderror
									<input id="next_btn1" onclick="next_step1()" type="button" value="Next">
									<input type="hidden" name="id" value="{{$campaign->id}}" id="campaignid">
								</fieldset>
								<fieldset id="second">
									<br>
									<br>
									<h2 class="title">What are you looking to buy this Onam?</h2>
									<p class="subtitle">Category: *</p>
									<select name="category" class="form-control" id="categoryselection" required="required">
										<option value="0">Select an option</option>
        								@foreach($categories as $category)
        									<option {{ old('category') == $category->id ? "selected":""}} value="{{ $category->id }}">{{$category->name}}</option>
        								@endforeach
									</select>
        							@error('category')
        								<span class="badge badge-danger">Choose a valid category</span>
        							@enderror
									<p class="subtitle">Sub-Category: *</p>
									<select name="division" id="subcategoryselection" class="form-control" required="required">
										<option value="0">Select an option</option>
									</select>
									@error('division')
									<span class="badge badge-danger">Choose a valid division</span>
									@enderror
									<input type="hidden" name="id" value="{{$campaign->id}}" id="campaignid">
									<input id="pre_btn1" onclick="prev_step1()" type="button" value="Previous">
									<input id="next_btn2" name="next" onclick="next_step2()" type="button" value="Next">
								</fieldset>
								<fieldset id="third">
									<br>
									<br>
									<br>
								<h5 class="title">Want your gift details emailed to you?</h5>
								<label>Please type in your email address in that case:</label>
        						<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        						@error('email')
        							<span class="badge badge-danger">Enter a valid email</span>
        						@enderror
								<input type="hidden" name="id" value="{{$campaign->id}}" id="campaignid">
								<input id="pre_btn2" onclick="prev_step2()" type="button" value="Previous">
								<input class="submit_btn" type="submit" value="Submit">
								</fieldset>
							</form>
							@else
       							<h3>Uh Oh! It appears you have made a mistake you imbecile. There is no gift campaign like that. Go away!</h3>
      						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="{{ URL::asset('js/slide-form.js') }}"></script>
</html>
