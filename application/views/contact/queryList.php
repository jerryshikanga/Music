    <script type="text/javascript">
      $(document).ready(function() {
        $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
        });

    $('#sendBroadcastForm').bootstrapValidator({
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
        url : '<?php echo site_url('contact/sendBroadcastMail');?>',
        type : 'post',
        data : $('#sendBroadcastForm :input'),
        dataType : 'html',
        success : function(response){
          $('#sendBroadcastForm')[0].reset();
          $('#sendBroadcastModal').modal('hide');
          bootbox.alert(response);
        }
      });
    });

      });

      function edit(id)
      {
      $.ajax({
            url: '<?php echo site_url('gallery/edit_image_modal'); ?>/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-image-modal-content').html(html); 
            }
          });
      }

      function addImageCategory(){
        $.ajax({
          url : '<?php echo site_url('gallery/add_image_category_modal'); ?>/',
          type : 'get',
          dataType : 'html',
          success : function(html){
            $('#add-image-category-modal-content').html(html);
          }
        });
      }

      function view(id)
      {
          $.ajax({
            url : '<?php echo site_url('contact/view_query/'); ?>'+id,
            type : 'post',
            dataType : 'html',
            success : function(response){
              $('#view-query-modal-content').html(response);
            }
          });
      }
    </script>

    <div id="sendBroadcastModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Send a Broadcast Mail</h4>
          </div>
          <div class="modal-body" id="send-broadcast-modal-content">
            <form class="form" id="sendBroadcastForm">
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
                <button type="submit" class="btn btn-primary">Send Broadcast</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="viewQueryModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Reply to Query Broadcast Mail</h4>
          </div>
          <div class="modal-body" id="view-query-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Queries</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('admin'); ?>">Home</a></li>
          <li class="active">Queries</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Images List</h5>
            <p class="mb20">View and Reply to Queries</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" id="sendBroadcastButton" data-toggle="modal" data-target="#sendBroadcastModal"><span class="fa fa-plus"></span> Send Broadcast Mail</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Visitor Name</th>
                    <th>Visitor Email</th>
                    <th>Subject</th>
                    <th>Inquiry</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($queries->result() as $query){?>
                  <tr>
                    <td><?php echo $query->id; ?></td>
                    <td><?php echo $query->visitor_name; ?></td>
                    <td><?php echo $query->visitor_email; ?></td>
                    <td><?php echo $query->subject; ?></td>
                    <td><?php echo format_date($query->inquiry_date); ?></td>
                    <td><?php if($query->status!=0) echo format_date($query->reply_date); else echo "Unreplied" ?></td>
                    <td>
                      <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#viewQueryModal" onclick="view('<?php echo $query->id; ?>')"><span class="glyphicon glyphicon-zoom-out"></span>&nbsp;View</span>
                    </td>
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div>
        </div><!-- col-md-6 -->
      </div><!-- row -->
    </div><!-- contentpanel -->