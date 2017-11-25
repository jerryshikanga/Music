           <form class="form" id="addVideoForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Video Name"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Link:</label>
                <div class="col-sm-7">
                  <input type="text" name="url" class="form-control" placeholder="Enter Video Link"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Release Date:</label>
                <div class="col-sm-7">
                  <input type="text" name="release_date" value="<?php echo date("Y-m-d H:i"); ?>" id="datetimepicker" class="form-control" placeholder="Enter Date of Release">
                  <span class="add-on"><i class="icon-th"></i></span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description:</label>
                <div class="col-sm-7">
                  <input type="text" name="description" class="form-control" placeholder="Enter Short Description"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Active</label>
                <div class="col-sm-7">
                  <select class="form-control" name="deleted_status">
                  <?php foreach ($statuses as $status) : ?>
                    <option value="<?=$status->id?>" ><?=$status->name?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Video</button>
              </div>
            </form>

<script type="text/javascript">
      $(document).ready(function() {
          $('#datetimepicker').datetimepicker({
              format: 'yyyy-mm-dd hh:ii'
          });
          $('#datetimepicker').datetimepicker('setStartDate', '2012-01-01');
          $('#datetimepicker').datetimepicker('setEndDate', '<?php echo date("Y-m-d"); ?>');

          $('#addVideoForm').bootstrapValidator({
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
                  description: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in a short description!"
                          }
                      }
                  },
                  url: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in image status!"
                          },
                          uri : {
                            message : "You have to fill in a valid url"
                          }
                      }
                  },
                  deleted_status: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in image category!"
                          }
                      }
                  },
                  release_date : {
                    validators : {
                      notEmpty : "You have to enter date of release"
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
            url: '<?php echo site_url('gallery/addImage'); ?>/',
            type: 'post',
            data: $('#addImageForm :input'),
            dataType: 'json',   
            success: function(response) {
              $('#addImageForm')[0].reset();
              $('#addImageModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                $('#addImageFileModal').modal('toggle');
              });
            }
          });
        });
      });
    </script>