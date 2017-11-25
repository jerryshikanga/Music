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
							<div class="map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d325516.3770455822!2d30.532690549999998!3d50.40203550000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cf4ee15a4505%3A0x764931d2170146fe!2sKyiv%2C+Ukraine!5e0!3m2!1sen!2sin!4v1435638348391"  allowfullscreen></iframe>						
						</div>
					</div>
					
				</div>
			</div>
<!-- Contact -->

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
					url : "<?php echo base_url('contact/addContactUsQuery'); ?>",
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