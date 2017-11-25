           <form class="form" id="editImageForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Image Name" value="<?php echo $image->name;?>" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Description:</label>
                <div class="col-sm-7">
                  <input type="text" name="description" class="form-control" placeholder="Enter Short Description" value="<?php echo $image->description;?>" />
                  <div id="editUsernameCheck"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Active</label>
                <div class="col-sm-7">
                  <select class="form-control" name="deleted_status">
                  <?php foreach ($statuses as $status) : ?>
                    <option value="<?=$status->id?>" <?php if($image->deleted_status==$status->id) echo "selected"; ?>><?=$status->name?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Category:</label>
                <div class="col-sm-7">
                  <select class="form-control" name="category">
                  <?php foreach ($categories as $category) : ?>
                    <option value="<?=$category->id?>" <?php if($image->category_id==$category->id) echo "selected"; ?>><?=$category->name?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Edit Image</button>
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