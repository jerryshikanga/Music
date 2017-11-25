 <script type="text/javascript">
      $(document).ready(function() {

          $('#datetimepicker').datetimepicker({
              format: 'yyyy-mm-dd hh:ii'
          });
          $('#datetimepicker').datetimepicker('setStartDate', '<?php echo date("Y-m-d"); ?>');

          $('#editEventForm').bootstrapValidator({
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  name: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in name!"
                          }
                      }
                  },
                  location: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in event location!"
                          }
                      }
                  },
                  description : {
                      validators:{
                        notEmpty:{
                          message: "You are required to fill in a description"
                        }
                      }
                  },
                  date_happening : {
                    validators : {
                      notEmpty : {
                        message : "You are required to fill in the event date"
                      }
                    }
                  }
              }
          })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.ajax({
            url: '<?php echo site_url('events/edit_event'); ?>',
            type: 'post',
            data: $('#editEventForm :input'), 
            dataType: 'json',   
            success: function(response) {
              console.log(response);
              $('#editEventForm')[0].reset();
              $('#editEventModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                $('#addImageFileModal').modal('toggle');
              });
            }
          });
        });
      });

</script>




            <form class="form" id="editEventForm">
              <input type="hidden" name="id" class="form-control" placeholder="Enter Short Event name" value="<?=$event->id?>" />
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Short Event name" value="<?=$event->title?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Location</label>
                <div class="col-sm-7">
                  <input type="text" name="location" class="form-control" placeholder="Enter Event Location" value="<?=$event->location?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Event Date:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <div class="bootstrap-timepicker">
                      <input type="text" name="date_happening" value="<?=$event->date_happening?>" id="datetimepicker" class="form-control" placeholder="Enter Date of Event">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description : </label>
                <div class="col-sm-7">
                  <input type="text" name="description" class="form-control" rows="5" placeholder="Enter Short Event Description" value="<?=$event->description?>"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit Event</button>
              </div>
            </form>