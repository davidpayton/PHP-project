
  <div class="container">
    <h3>Messenger Service Management</h3>

    <br />

    <h4>Distance Price</h4>
      <div>
         <input type="text" id="distance_value" value="<?php echo $data["value"]->distance_price_value; ?>">
        <button class="btn btn-success" onclick="submitPrice()">Change Price</button>
      </div>
      <br />
    <br />
      <h4>Bank Management</h4>
      <br />
    <button class="btn btn-success" onclick="add_bank()"><i class="icon-plus"></i> Add bank</button>
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>ID</th>
                    <th>Bank Photo</th>
					<th>Bank Price</th>
          <th>Bank Name</th>
          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach ($data['banks'] as $bank) {?>
				     <tr>
				         <td><?php echo $bank->bank_id; ?></td>
						<td><img src="<?php echo $bank->bank_photo; ?>" width="100" height="32"></td>
						<td><?php echo $bank->bank_price; ?></td>
            <td><?php echo $bank->bank_name; ?></td>

								<td>
									<button class="btn btn-warning" onclick="edit_bank(<?php echo $bank->bank_id; ?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_bank(<?php echo $bank->bank_id; ?>)"><i class="icon-trash"></i></button>
								</td>
				      </tr>
				     <?php }?>



      </tbody>

      <tfoot>
        <tr>
        <th>ID</th>
                    <th>Bank Photo</th>
					<th>Bank Price</th>
          <th>Bank Name</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
    
    <br />
    <div>
    <h4>Service Management</h4>
      <br />
    <button class="btn btn-success" onclick="add_service()"><i class="icon-plus"></i> Add Service</button>
    <br />
    <br />
    <table id="table_service_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>ID</th>
                    <th>Service Photo</th>
					<th>Service Price</th>
          <th>Service Name</th>
          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach ($data['services'] as $service) {?>
				     <tr>
				         <td><?php echo $service->service_id; ?></td>
						<td><img src="<?php echo $service->service_photo; ?>" width="100" height="32"></td>
						<td><?php echo $service->service_price; ?></td>
            <td><?php echo $service->service_name; ?></td>

								<td>
									<button class="btn btn-warning" onclick="edit_service(<?php echo $service->service_id; ?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_service(<?php echo $service->service_id; ?>)"><i class="icon-trash"></i></button>
								</td>
				      </tr>
				     <?php }?>



      </tbody>

      <tfoot>
        <tr>
        <th>ID</th>
                    <th>Service Photo</th>
					<th>Service Price</th>
          <th>Service Name</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
    </div>

  </div>
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_bank()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_bank(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      var options = {
        "url":  "<?php echo site_url('messenger/bank_ajax_edit/') ?>/" + id,
        type: 'GET',
        complete: function(response)
        {
          var data = JSON.parse(response.responseText);
            $('[name="bank_id"]').val(data.bank_id);
            $('[name="bank_price"]').val(data.bank_price);
            $('[name="bank_name"]').val(data.bank_name);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit bank');

          }
        };

    $("#form").ajaxSubmit(options);

    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('messenger/bank_add') ?>";
      }
      else
      {
        url = "<?php echo site_url('messenger/bank_update') ?>";
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

    function delete_bank(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('messenger/bank_delete') ?>/"+id,
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

     $(document).ready( function () {
      $('#table_service_id').DataTable();
  } );
    var save_method_service; //for save method string
    var table_service;


    function add_service()
    {
      save_method_service = 'add';
      $('#form_service')[0].reset(); // reset form on modals
      $('#modal_form_service').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_service(id)
    {
      save_method_service = 'update';
      $('#form_service')[0].reset(); // reset form on modals

      var options = {
        "url":  "<?php echo site_url('messenger/service_ajax_edit/') ?>/" + id,
        type: 'GET',
        complete: function(response)
        {
          var data = JSON.parse(response.responseText);
            $('[name="service_id"]').val(data.service_id);
            $('[name="service_price"]').val(data.service_price);
            $('[name="service_name"]').val(data.service_name);
            $('#modal_form_service').modal('show');
            $('.modal-title').text('Edit Service');

          }
        };

    $("#form_service").ajaxSubmit(options);

    }



    function save_service()
    {
      var url;
      if(save_method_service == 'add')
      {
          url = "<?php echo site_url('messenger/service_add') ?>";
      }
      else
      {
        url = "<?php echo site_url('messenger/service_update') ?>";
      }

      var options = {
        "url": url,
        type: 'post',
        complete: function(response)
        {
          $('#modal_form_service').modal('hide');
          location.reload();
          if($.isEmptyObject(response.responseJSON.error)){
              alert('Image Upload Successfully.');
          }else{
              alert('Image Upload Error.');
            }
          }
        };
        $("#form_service").ajaxSubmit(options);
    }

    function delete_service(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('messenger/service_delete') ?>/"+id,
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

    function submitPrice() {
      // $("#price_form").submit();
      // site_url('messenger/update_value')
      var id = $("#distance_value").val();
      $.ajax({
        type: "POST",
        url: "<?=site_url('messenger/update_value')?>",
        data: {
          record_id: id
        },
        success: function(response) {

        },
        error: function(err) {

        }
      });

    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title">Bank Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body form">
        <form id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" value="" name="bank_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                <input name="bank_photo" placeholder="Photo" class="form-control" type="file">
              </div>
            </div>

						<div class="form-group">
							<label class="control-label col-md-3">Price</label>
							<div class="col-md-9">
								<input name="bank_price" placeholder="Price" class="form-control" type="text">

							</div>
						</div>
            <div class="form-group">
							<label class="control-label col-md-3">Name</label>
							<div class="col-md-9">
								<input name="bank_name" placeholder="Name" class="form-control" type="text">

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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form_service" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title">Service Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body form">
        <form id="form_service" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" value="" name="service_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                <input name="service_photo" placeholder="Photo" class="form-control" type="file">
              </div>
            </div>

						<div class="form-group">
							<label class="control-label col-md-3">Price</label>
							<div class="col-md-9">
								<input name="service_price" placeholder="Price" class="form-control" type="text">

							</div>
						</div>
            <div class="form-group">
							<label class="control-label col-md-3">Name</label>
							<div class="col-md-9">
								<input name="service_name" placeholder="Name" class="form-control" type="text">

							</div>
						</div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_service()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </body>
</html>