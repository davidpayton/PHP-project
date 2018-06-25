
  <div class="container">
    <h3>Administrator Management</h3>
    <br />
    <button class="btn btn-success" onclick="add_admin()"><i class="glyphicon glyphicon-plus"></i> Add Admin</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th> ID</th>
					<th> Admin Name</th>
                    <th> Admin Photo</th>
                    <th> Admin Email</th>
					<th> Admin Password</th>
					<th> Admin Phone</th>

          <th style="width:125px;">Action</th>
        </tr>
      </thead>
      <tbody>
				<?php foreach ($admins as $admin) {?>
				     <tr>
				         <td><?php echo $admin->admin_id; ?></td>
				         <td><?php echo $admin->admin_name; ?></td>
                                 <td><img src="<?php echo $admin->admin_photo; ?>" width="32" height="32"></td>
                                 <td><?php echo $admin->admin_email; ?></td>
                                 <td>********</td>
        
                <td><?php echo $admin->admin_phone_num; ?></td>

								<td>
									<button class="btn btn-warning" onclick="edit_admin(<?php echo $admin->admin_id; ?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_admin(<?php echo $admin->admin_id; ?>)"><i class="icon-trash"></i></button>


								</td>
				      </tr>
				     <?php }?>



      </tbody>

      <tfoot>
        <tr>
        <th> ID</th>
					<th> Name</th>
                    <th> Photo</th>
                    <th> Email</th>
					<th> Password</th>
					<th> Phone</th>
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


    function add_admin()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_admin(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      var options = {
        "url":  "<?php echo site_url('admin/ajax_edit/') ?>/" + id,
        type: 'GET',
        complete: function(response)
        {
          var data = JSON.parse(response.responseText);
            $('[name="admin_id"]').val(data.admin_id);
            $('[name="admin_name"]').val(data.admin_name);
            // $('[name="admin_photo"]').val(data.admin_photo);
            $('[name="admin_email"]').val(data.admin_email);
            $('[name="admin_password"]').val(data.admin_password);
            $('[name="admin_phone_num"]').val(data.admin_phone_num);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit admin'); // Set title to Bootstrap modal title

          }
        };

        $("#form").ajaxSubmit(options);


    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('admin/admin_add') ?>";
      }
      else
      {
        url = "<?php echo site_url('admin/admin_update') ?>";
      }

       // ajax adding data to database
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

    function delete_admin(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('admin/admin_delete') ?>/"+id,
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
        <h3 class="modal-title">admin Form</h3>
      </div>
      <div class="modal-body form">
      <form id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" value="" name="admin_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Name</label>
              <div class="col-md-9">
                <input name="admin_name" placeholder="adminname" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                <input name="admin_photo" placeholder="Photo" class="form-control" type="file">
              </div>
            </div>
            <div class="form-group">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
								<input name="admin_email" placeholder="Email" class="form-control" type="text">

							</div>
						</div>
            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
								<input name="admin_password" placeholder="Password" class="form-control" type="text" disabled>

              </div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Phone</label>
							<div class="col-md-9">
								<input name="admin_phone_num" placeholder="Phone" class="form-control" type="text">

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