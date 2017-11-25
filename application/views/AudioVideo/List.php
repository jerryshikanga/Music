    <script type="text/javascript">
      $(document).ready(function() {
        $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
        });

        $('#addVideoButton').click(function(){
          $.ajax({
            url : "<?php echo site_url('videos/add_video_form'); ?>",
            type : "post",
            dataType : "html",
            success : function(html){
              $("#add-video-modal-content").html(html);
            }
          });
        });

      });

      function edit(id)
      {
      $.ajax({
            url: '<?php echo site_url('videos/edit_video_modal'); ?>/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-video-modal-content').html(html);
            }
          });
      }

      function rm(nm,id){
        bootbox.confirm("Are you sure you want to delete Company called " + nm + "?", function(result) {
            if(result) {
            
          $.ajax({
          url: '<?php echo base_url(); ?>company/deleteCompany/' + id,
          type: 'post',
          data: {id: id},
          dataType: 'html',   
          success: function(html) {
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
          }
        });
          
          }
          
        }); 
      }
    </script>

    <div id="editVideoModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Video Info Details</h4>
          </div>
          <div class="modal-body" id="edit-video-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addVideoModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add a Video</h4>
          </div>
          <div class="modal-body" id="add-video-modal-content">
          
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Audio/Video</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>patients">Home</a></li>
          <li class="active">Audio/Video</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Audio / Video List</h5>
            <p class="mb20">Add, View and Edit Audio / Video</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" id="addVideoButton" data-toggle="modal" data-target="#addVideoModal"><span class="fa fa-plus"></span> Add Video</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Release Date</th>
                    <th>Description</th>
                    <th>Date Added</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($videos as $video){?>
                  <tr>
                    <td><?php echo $video->id; ?></td>
                    <td><?php echo $video->name; ?></td>
                    <td><?php echo $video->url; ?></td>
                    <td><?php echo format_date($video->release_date); ?></td>
                    <td><?php echo $video->description; ?></td>
                    <td><?php echo format_date($video->date_added); ?></td>
                    <td><?php echo $video->deleted_status; ?></td>
                    <td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editVideoModal" onclick="edit('<?php echo $video->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
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