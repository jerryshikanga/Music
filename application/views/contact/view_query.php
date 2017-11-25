            <div class=" row col-sm-10 text-center">
              <div class="row">
                <div class="col-sm-3">Subject</div>
                <div class="col-sm-7"><?php echo $query->subject; ?></div>
              </div>
              <div class="row">
                <div class="col-sm-3">Content</div>
                <div class="col-sm-7"><?php echo $query->message; ?></div>
              </div>
            </div>
            <br>
            <div class="row"><h4>Reply to mail</h4></div>
            <form class="form" id="sendResponseForm">
              <input type="hidden" name="query_id" value="<?php echo $query->id; ?>">
              <input type="hidden" name="email" value="<?php echo $query->visitor_email; ?>">
              <div class="form-group">
                <label class="col-sm-3 control-label">Subject:</label>
                <div class="col-sm-7">
                  <input type="text" name="subject" class="form-control" placeholder="Enter Mail Subject"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Content:</label>
                <div class="col-sm-7">
                  <input type="text" name="content" class="form-control" placeholder="Enter Mail Content"/>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Send Mail</button>
              </div>
            </form>

<script type="text/javascript">
  $(document).ready(function() {
    $('#sendResponseForm').bootstrapValidator({
        message : "This field is invalid",
        feedbackIcons : {
          valid : 'glyphicon glyphicon-ok',
          invalid : 'glyphicon glyphicon-remove',
          validating : 'glyphicon glyphicon-refresh'
        },
        fields : {
          subject : {
            validators : {
              notEmpty : {
                message : "An email subject is required"
              }
            }
          },
          content : {
            validators : {
              notEmpty : {
                message : "Email content is required"
              }
            }
          }
        }
    }).on('success.form.bv', function(event){
      event.preventDefault();
      var form = $(event.target);
      var bv = $(form).data('bootstrapValidator');
      $.ajax({
        url : '<?php echo site_url('contact/sendResponseMail');?>',
        type : 'post',
        data : $('#sendResponseForm :input'),
        dataType : 'html',
        success : function(response){
          $('#sendResponseForm')[0].reset();
          $('#sendResponseModal').modal('hide');
          bootbox.alert(response);
        }
      });
    });
  });
</script>