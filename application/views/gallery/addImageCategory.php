           <form class="form" id="addCategoryForm">
              <div class="form-group">
                <label class="col-sm-3 control-label">Name:</label>
                <div class="col-sm-7">
                  <input type="text" name="name" class="form-control" placeholder="Enter Category Name" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Category</button>
              </div>
            </form>

<script type="text/javascript">
      $(document).ready(function() {
          $('#addCategoryForm').bootstrapValidator({
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
              }
          })
        .on('success.form.bv', function(e) {
          console.log("In function success.form.bv");
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.ajax({
            url: '<?php echo site_url('gallery/addImageCategory'); ?>',
            type: 'post',
            data: $('#addCategoryForm :input'),
            dataType: 'json',   
            success: function(response) {
              console.log(response);
              $('#addCategoryForm')[0].reset();
              $('#addImageCategoryModal').modal('hide');
              bootbox.alert(response.message, function()
              {
                window.location.reload();
              });
            }
          });
        });
      });
    </script>