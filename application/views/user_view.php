
  <div class="container">
    <h3>User Management</h3>
    <br />
    <button class="btn btn-success" onclick="add_user()"><i class="icon-plus"></i> Add User</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>User ID</th>
					<th>User Name</th>
					<th>User Photo</th>
					<th>User Password</th>
					<th>User Phone</th>
          <th>User Email</th>
          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($users as $user){?>
				     <tr>
				         <td><?php echo $user->user_id;?></td>
				         <td><?php echo $user->user_name;?></td>
								 <td><img src="<?php echo $user->user_photo; ?>" width="32" height="32"></td>
								<td>*******</td>
                <td><?php echo $user->user_phone_num;?></td>
                <td><?php echo $user->user_email;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_user(<?php echo $user->user_id;?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_user(<?php echo $user->user_id;?>)"><i class="icon-trash"></i></button>
 
 
								</td>
				      </tr>
				     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
        <th>User ID</th>
					<th>User Name</th>
					<th>User Photo</th>
					<th>User Password</th>
					<th>User Phone</th>
          <th>User Email</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
 
  </div>
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;
 
 
    function add_user()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit_user(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      var options = {
        "url":  "<?php echo site_url('user/ajax_edit/') ?>/" + id,
        type: 'GET',
        complete: function(response)
        {
          var data = JSON.parse(response.responseText);
            $('[name="user_id"]').val(data.user_id);
            $('[name="user_name"]').val(data.user_name);
            $('[name="user_password"]').val(data.user_password);
            $('[name="user_phone_num"]').val(data.user_phone_num);
            $('[name="user_email"]').val(data.user_email);

            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit User'); 

          }
        };

    $("#form").ajaxSubmit(options);

    }
 
 
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('user/user_add')?>";
      }
      else
      {
        url = "<?php echo site_url('user/user_update')?>";
      }
 
      var options = {
        "url": url,
        type: 'post',
        complete: function(response)
        {
          $('#modal_form').modal('hide');
          location.reload();
          if($.isEmptyObject(response.responseJSON.error)){
              alert('Image Upload Successfully.');
          }else{
              alert('Image Upload Error.');
            }
          }
        };
        $("#form").ajaxSubmit(options);
    }
 
    function delete_user(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('user/user_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
      }
    }
 
  </script>
 
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">User Form</h3>
      </div>
      <div class="modal-body form">
        <form id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" value="" name="user_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Username</label>
              <div class="col-md-9">
                <input name="user_name" placeholder="Username" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                <input name="user_photo" placeholder="Photo" class="form-control" type="file">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
								<input name="user_password" placeholder="Password" class="form-control" type="text" disabled>
 
              </div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Phone</label>
							<div class="col-md-9">
								<input name="user_phone_num" placeholder="Phone" class="form-control" type="text">
 
							</div>
						</div>
            <div class="form-group">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
								<input name="user_email" placeholder="Email" class="form-control" type="text">
 
							</div>
						</div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
 
  </body>
</html>