
  <div class="container">
    <h3>Company Management</h3>
    <br />
    <button class="btn btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> Add Company</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
        <th> ID</th>
					<th> Name</th>
					<th> Password</th>
                    <th> Number</th>
                    <th> Email</th>
                    <th> Office Num</th>
                    <th> Business</th>
                    <th> Month of shipment</th>
                    <th> Credit Limit</th>
          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($users as $user){?>
				     <tr>
                     <td><?php echo $user->user_id;?></td>
				                <td><?php echo $user->user_name;?></td>
								 <td>********</td>
								<td><?php echo $user->user_phone_num;?></td>
                <td><?php echo $user->user_email;?></td>
                <td><?php echo $user->user_office_num;?></td>
                <td><?php echo $user->user_business;?></td>
                <td><?php echo $user->user_month_ship;?></td>
                <td><?php echo $user->user_credit_limit;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_user(<?php echo $user->user_id;?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_user(<?php echo $user->user_id;?>)"><i class="icon-trash"></i></button>
 
 
								</td>
				      </tr>
				     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
        <th> ID</th>
                    <th> Name</th>
					<th> Password</th>
                    <th> Number</th>
                    <th> Email</th>
                    <th> Office Num</th>
                    <th> Business</th>
                    <th> Month of shipment</th>
                    <th> Credit Limit</th>
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
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('company/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="user_id"]').val(data.user_id);
            $('[name="user_name"]').val(data.user_name);

            $('[name="user_password"]').val(data.user_password);
            $('[name="user_phone_num"]').val(data.user_phone_num);
            $('[name="user_email"]').val(data.user_email);
            $('[name="user_office_num"]').val(data.user_office_num);
            $('[name="user_business"]').val(data.user_business);
            $('[name="user_month_ship"]').val(data.user_month_ship);
            $('[name="user_month_ship"]').val(data.user_credit_limit);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 
 
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('company/user_add')?>";
      }
      else
      {
        url = "<?php echo site_url('company/user_update')?>";
      }
 
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function delete_user(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('company/user_delete')?>/"+id,
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
      <h3 class="modal-title">Company Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="user_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Name</label>
              <div class="col-md-9">
                <input name="user_name" placeholder="Name" class="form-control" type="text">
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

          <div class="form-group">
              <label class="control-label col-md-3">Office Number</label>
              <div class="col-md-9">
                <input name="user_office_num" placeholder="Office Number" class="form-control" type="text">
              </div>
            </div>

          <div class="form-group">
              <label class="control-label col-md-3">Business</label>
              <div class="col-md-9">
                <input name="user_business placeholder="Business" class="form-control" type="text">
              </div>
            </div>
         <div class="form-group">
              <label class="control-label col-md-3">Month of Shipment</label>
              <div class="col-md-9">
                <input name="user_month_ship" placeholder="Month of Shipment" class="form-control" type="text">
              </div>
        </div> 
         <div class="form-group">
              <label class="control-label col-md-3">Credit Limit</label>
              <div class="col-md-9">
                <input name="user_credit_limit" placeholder="Credit Limit" class="form-control" type="text">
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