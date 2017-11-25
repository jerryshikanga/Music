<!--contect-->
<div class="contact">
				<div class="container">
					<div class="contact-top">
						<h2>Contact Us</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
					</div>
					<div id="errorContainer" class="alert alert-danger">
						
					</div>	
							
					<div class="contact-grids">
						<div class="contact-form">
							<form method="POST" id="contactUsForm" action="<?php echo base_url('contact/addContactUsQuery');?>">
								<div class="contact-bottom">
									<div class="col-md-4 in-contact">
										<span>Name :</span>
										<input type="text" class="text" name="name"  value="" required="" id="nameField">
									</div>
									<div class="col-md-4 in-contact">
										<span>Email :</span>
										<input type="text" class="text" name="email"  value="" required="" id="emailField">
									</div>
									<div class="col-md-4 in-contact">
										<span>Subject :</span>
										<input type="text" class="text" name="subject"  value="" required="" id="subjectField">
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="clearfix"> </div>
								<div class="contact-bottom-top">
									<span>Message :</span>
									<textarea name="queryMessage" required="" id="messageField"> </textarea>
								</div>
								<input type="submit" value="Send">
							</form>
						</div>
						<div class="clearfix"></div>
						<div id="googleMap" style="width:100%;height:400px; padding-top: 500px">
						A map to the location					
						</div>
					</div>
					
				</div>
			</div>
<!-- Contact -->

 <script type="text/javascript">
 	function showMap(){
 		var mapCanvas = document.getElementById('googleMap');
 		var mapCenter = new google.maps.LatLng(-1.258335, 36.8186682);
 		var mapOptions = {
 			center : mapCenter,
 			zoom : 100,
 			mapTypeId : google.maps.MapTypeId.HYBRID
 		}

 		var map = new google.maps.Map(mapCanvas, mapOptions);
 		var mapMarker = new google.maps.Marker({
 			position : mapCenter,
 			animation : google.maps.Animation.BOUNCE
 		});
 		mapMarker.setMap(map);
 	}
 </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoD_HbQzF3PWDKIXSCtbgkNb6HNgVon-A&callback=showMap" type="text/javascript"></script>

<script type="text/javascript">
	$('#errorContainer').hide();
	$('#contactUsForm').submit(function(event) {
		$('#errorContainer').show();
		var form = $("#contactUsForm");
		event.preventDefault();
		$("#contactUsForm").validate(
		{
			debug : true,
			errorLabelContainer: "#errorContainer",
			errorContainer: "#errorContainer",
			submitHandler : function(form){
				$.ajax({
					type : 'POST',
					url : "<?php echo site_url('contact/addContactUsQuery'); ?>",
					data : { 
						name : $('#nameField').val(), 
						email : $('#emailField').val(), 
						subject : $('#subjectField').val(), 
						message : $('#messageField').val() 
					},
					dataType : 'JSON',
					success : function(response){
						console.log(response.message);
						bootbox.alert({
							message : response.message
						});
					},
					complete : function(xhr,status){
						console.log("status : "+status+"\n statusText : "+xhr.statusText+ "\nresponseText"+xhr.responseText);
					}
				});
			} ,
			invalidHandler : function(event, validator){
				console.log("In invalidHandler")
			} ,
			rules : {
				email : {
					required : true,
					email : true
				},
				subject : {
					required : true
				},
				name : {
					required : true
				}, 
				queryMessage : {
					required : true
				}
			},
			messages : {
				email : {
					required : "Email address is required",
					email : "E-mail must be a valid email address"
				},
				subject : {
					required : "Password is required"
				},
				name : {
					required : "Name is required"
				},
				queryMessage : {
					required : "Message is required"
				}
			}
		});
	});
</script>