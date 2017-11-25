           <form class="form" id="editVideoForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Video Name" value="<?php echo $video->name;?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Link:</label>
                <div class="col-sm-7">
                  <input type="text" name="url" class="form-control" placeholder="Enter Video Link" value="<?php echo $video->url;?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description:</label>
                <div class="col-sm-7">
                  <input type="text" name="description" class="form-control" placeholder="Enter Short Description" value="<?php echo $video->description;?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Active</label>
                <div class="col-sm-7">
                  <select class="form-control" name="deleted_status">
                  <?php foreach ($statuses as $status) : ?>
                    <option value="<?=$status->id?>" <?php if($video->deleted_status==$status->id) echo "selected"; ?>><?=$status->name?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit Video</button>
              </div>
            </form>

<script type="text/javascript">
      $(document).ready(function() {
          $('#editImageForm').bootstrapValidator({
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
                  deleted_status: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in image status!"
                          }
                      }
                  },
                  category: {
                      validators: {
                          notEmpty: {
                              message: "You're required to fill in image category!"
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
            url: '<?php echo site_url('gallery/editImage'); ?>/<?php echo $image->id;?>',
            type: 'post',
            data: $('#editImageForm :input'),
            dataType: 'json',   
            success: function(response) {
              $('#editImageForm')[0].reset();
              $('#editImageModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                window.location.reload();
              });
            }
          });
        });
      });
    </script>