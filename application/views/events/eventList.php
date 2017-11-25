    <script type="text/javascript">
      $(document).ready(function() {
        $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
        });

        $('#addEventButton').click(function(){
          $.ajax({
            url : "<?php echo site_url('events/add_event_form'); ?>",
            type : "get",
            dataType : "html",
            success : function(html){
              $("#add-event-modal-content").html(html);
            }
          });
        });

      //call a function to handle file upload on select file
    $('input[type=file]').on('change', fileUpload);
 
      });

      function edit(id)
      {
      $.ajax({
            url: '<?php echo site_url('events/edit_event_modal'); ?>/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-event-modal-content').html(html);
               
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

      function fileUpload(event){
        files = event.target.files;
        var file = files[0];
        if(!file.type.match('image.*')) {              
            //check file type
            $("#errorField").html("Please choose an images file.");
        }else if(file.size > 1048576){
            //check file size (in bytes)
            $("#errorField").html("Sorry, your file is too large (>1 MB)");
        }

        $("#addImageFileForm").on('submit',(function(e) {
          $('#addImageFileModal').modal('hide');
          e.preventDefault();
          $.ajax({
              url: "<?php echo site_url('events/uploadImage');?>", 
              type: "POST",           
              data: new FormData(this), 
              contentType: false,       
              cache: false,          
              processData:false,        
              success: function(html) {
                bootbox.alert(html, function()
                {
                  window.location.reload();
                });
              }
              });
      }));
      }
    </script>

    <div id="addImageFileModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add Image File</h4>
          </div>
          <div class="modal-body" id="add-image-file-modal-content">
            <form class="file" id="addImageFileForm" method="POST" enctype="multipart/form-data">
              <div id="dropBox">
                <input type="file" name="userFile" id="fileInput" size="20" enc->
              </div>
              <div id="errorField"></div>
              <div id="progress">
                  <div id="bar"></div>
                 <div id="percent">0%</div >
              </div>
              <div class="clearfix"></div>
              <div id="message"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Upload Image File</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="editEventModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Event Info Details</h4>
          </div>
          <div class="modal-body" id="edit-event-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addEventModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add an Event</h4>
          </div>
          <div class="modal-body" id="add-event-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Events</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>admin">Admin</a></li>
          <li class="active">Events</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Events List</h5>
            <p class="mb20">Add, View and Edit Events</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" id="addEventButton" data-toggle="modal" data-target="#addEventModal"><span class="fa fa-plus"></span> Add Event</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Event Poster</th>
                    <th>Date Hapenning</th>
                    <th>Active Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($events as $event){?>
                  <tr>
                    <td><?php echo $event->id; ?></td>
                    <td><?php echo $event->title; ?></td>
                    <td><?php echo $event->location; ?></td>
                    <td><?php echo $event->description; ?></td>
                    <td><?php echo $event->image; ?></td>
                    <td><?php echo format_date($event->date_happening); ?></td>
                    <td><?php echo $event->status; ?></td>
                    <td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editEventModal" onclick="edit('<?php echo $event->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
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