    <script type="text/javascript">
      $(document).ready(function() {
        $("#active_").change(function() {
          if(this.checked) {
              $('#active').val(1);
          }
        else
          $('#active').val(0);
        });

        $('#addUserButton').click(function(){
          $.ajax({
            url : "<?php echo site_url('users/add_user_form'); ?>",
            type : "post",
            dataType : "html",
            success : function(html){
              $("#add-user-modal-content").html(html);
            }
          });
        });

      });

      function edit(id)
      {
      $.ajax({
            url: '<?php echo site_url('users/edit_user_modal'); ?>/' + id,
            type: 'post',
            dataType: 'html',   
            success: function(html) {
             $('#edit-user-modal-content').html(html);
               
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

    <?php

      function format_date($datetime)
      {
        $date = date('jS F Y', (strtotime($datetime)));
        return $date;
      }
      ?>

    <div id="editUserModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit User Info Details</h4>
          </div>
          <div class="modal-body" id="edit-user-modal-content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="addUserModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add a User</h4>
          </div>
          <div class="modal-body" id="add-user-modal-content">
          
          </div>
        </div>
      </div>
    </div>

    <div class="pageheader">
      <h2><i class="fa fa-users"></i> List of Users</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>patients">Home</a></li>
          <li class="active">Users</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Users List</h5>
            <p class="mb20">Add, View and Edit Users</p>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success" id="addUserButton" data-toggle="modal" data-target="#addUserModal"><span class="fa fa-plus"></span> Add User</button>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Date Created</th>
                    <th>Last Login</th>
                    <th>Active Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($users->result() as $user){?>
                  <tr>
                    <td><?php echo $user->user_id; ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->role_name; ?></td>
                    <td><?php echo format_date($user->date_created); ?></td>
                    <td><?php echo format_date($user->last_login); ?></td>
                    <td><?php if($user->active == 1) echo "Active"; else echo "Inactive"; ?></td>
                    <td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal" onclick="edit('<?php echo $user->user_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
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