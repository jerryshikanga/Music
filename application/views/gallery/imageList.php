    <script type="text/javascript">
      $(document).ready(function() {
        $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
        });

    //call a function to handle file upload on select file
    $('input[type=file]').on('change', fileUpload);

        $('#addImageButton').click(function(){
          $.ajax({
            url : "<?php echo site_url('gallery/add_image_modal'); ?>",
            type : "post",
            dataType : "html",
            success : function(html){
              $("#add-image-modal-content").html(html);
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

      function view(src, name)
      {
          var html = "<a href="+src;
          html += "'' rel='title' class='mask'><img src='"+src;
          html += "' alt='"+name;
          html += "' class='img-responsive zoom-img'> </a> ";
          $('#view-image-modal-content').html(html);
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
              url: "<?php echo site_url('gallery/uploadImage');?>", 
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

    <div id="editImageModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Image Info Details</h4>
          </div>
          <div class="modal-body" id="edit-image-modal-content">
            
          </div>
        </div>
      </div>
    </div>


    <div id="viewImageModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">View Image</h4>
          </div>
          <div class="modal-body" id="view-image-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addImageModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add an Image</h4>
          </div>
          <div class="modal-body" id="add-image-modal-content">
          
          </div>
        </div>
      </div>
    </div>

    <div id="addImageCategoryModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add an Image Category</h4>
          </div>
          <div class="modal-body" id="add-image-category-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Images</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('admin'); ?>">Home</a></li>
          <li class="active">Images</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Images List</h5>
            <p class="mb20">Add, View and Edit Images</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" id="addImageButton" data-toggle="modal" data-target="#addImageModal"><span class="fa fa-plus"></span> Add Image</button>
            <button type="button" onclick="addImageCategory()" class="btn btn-success" id="addImageCategoryButton" data-toggle="modal" data-target="#addImageCategoryModal"><span class="fa fa-plus"></span> Add Image Category</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Category</th>
                    <th>Date Uploaded</th>
                    <th>Last Modified</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($images as $image){?>
                  <tr>
                    <td><?php echo $image->id; ?></td>
                    <td><?php echo $image->name; ?></td>
                    <td><?php echo $image->active; ?></td>
                    <td><?php echo $image->category; ?></td>
                    <td><?php echo format_date($image->date_uploaded); ?></td>
                    <td><?php echo format_date($image->last_modified); ?></td>
                    
                    <td><?php echo $image->description; ?></td>
                    <td>
                      <?php $image->src = base_url($image->src); ?>
                      <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editImageModal" onclick="edit('<?php echo $image->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                      <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#viewImageModal" onclick="view('<?php echo $image->src; ?>', '<?=$image->name?>')"><span class="glyphicon glyphicon-zoom-out"></span>&nbsp;View</span>
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