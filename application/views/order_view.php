
  <div class="container">
    <h3>Order Management</h3>
    <br />
    <button class="btn btn-success" onclick="add_order()"><i class="glyphicon glyphicon-plus"></i> Add Order</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
        <th> ID</th>
					<th> USER</th>
					<th> Start Time</th>
                    <th> End Time</th>
                    <th>Cart Info</th>
                    <th> Pick Address</th>
                    <th> Delivery Address</th>
                    <th> Final Address</th>
                    <th> Order Type</th>
                    <th> Amount</th>
                    <th> Driver</th>
                    <th> Status</th>
                    <th> Contact Name</th>
                    <th> Contact Number</th>


          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($orders as $order){?>
				     <tr>
                     <td><?php echo $order->order_id;?></td>
				                <td><?php echo $order->order_user_id;?></td>
								 <td><?php echo $order->order_start_time;?></td>
								<td><?php echo $order->order_end_time;?></td>
                <td><?php echo $order->cart_name;?></td>
                <td><?php echo $order->order_pick_address;?></td>

                <td><?php echo $order->order_delivery_address;?></td>
  
                <td><?php echo $order->order_mid_address;?></td>

                <td><?php echo $order->order_type;?></td>
                <td><?php echo $order->order_amount;?></td>
                <td><?php echo $order->order_driver_id;?></td>
                <td><label class="badge badge-info"><?php echo $order->order_status;?></label></td>
                <td><?php echo $order->order_contact_name;?></td>
                <td><?php echo $order->order_contact_num;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_order(<?php echo $order->order_id;?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_order(<?php echo $order->order_id;?>)"><i class="icon-trash"></i></button>
 
 
								</td>
				      </tr>
				     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
        <th> ID</th>
					<th> USER</th>
					<th> Start Time</th>
                    <th> End Time</th>
                    <th>Cart Info</th>
                    <th> Pick Address</th>

                    <th> Delivery Address</th>

                    <th> Final Address</th>

                    <th> Order Type</th>
                    <th> Amount</th>
                    <th> Driver</th>
                    <th> Status</th>
                    <th> Contact Name</th>
                    <th> Contact Number</th>
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
 
 
    function add_order()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit_order(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('order/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="order_id"]').val(data.order_id);
            $('[name="order_name"]').val(data.order_user_id);

            $('[name="order_start_time"]').val(data.order_start_time);
            $('[name="order_end_time"]').val(data.order_phone_num);
            $('[name="cart_name"]').val(data.order_cart_name);
            $('[name="order_pick_address"]').val(data.order_pick_address);
            $('[name="order_pick_lugar"]').val(data.order_pick_lugar);
            $('[name="order_delivery_address"]').val(data.order_delivery_address);
            $('[name="order_deli_lugar"]').val(data.order_deli_lugar);   
            
            $('[name="order_mid_address"]').val(data.order_mid_address);
            $('[name="order_mid_lugar"]').val(data.order_mid_lugar);
            $('[name="order_type"]').val(data.order_type);
            $('[name="order_amount"]').val(data.order_amount);
            $('[name="order_driver_id"]').val(data.order_driver_id);
            $('[name="order_status"]').val(data.order_status);
            $('[name="order_contact_name"]').val(data.order_contact_name);
            $('[name="order_contact_num"]').val(data.order_contact_num);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit order'); // Set title to Bootstrap modal title
 
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
          url = "<?php echo site_url('order/order_add')?>";
      }
      else
      {
        url = "<?php echo site_url('order/order_update')?>";
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
 
    function delete_order(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('order/order_delete')?>/"+id,
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
      <h3 class="modal-title">Order Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="order_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">USER</label>
              <div class="col-md-9">
                <input name="order_user_id" placeholder="User" class="form-control" type="text">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Start Time</label>
              <div class="col-md-9">
								<input name="order_start_time" placeholder="Start Time" class="form-control" type="text">
 
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">End Time</label>
                <div class="col-md-9">
                    <input name="order_end_time" placeholder="End Time" class="form-control" type="text">

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Cart Info</label>
                <div class="col-md-9">
                    <input name="cart_info" placeholder="End Time" class="form-control" type="text">

                </div>
            </div>
            <div class="form-group">
							<label class="control-label col-md-3">Pick Address</label>
							<div class="col-md-9">
								<input name="order_pick_address" placeholder="Pick Address" class="form-control" type="text">
 
							</div>
			</div>
            <div class="form-group">
							<label class="control-label col-md-3">Pick Lugar</label>
							<div class="col-md-9">
								<input name="order_pick_lugar" placeholder="Pick Lugar" class="form-control" type="text">
 
							</div>
			</div>            

          <div class="form-group">
              <label class="control-label col-md-3">Delivery Address</label>
              <div class="col-md-9">
                <input name="order_delivery_address" placeholder="Delivery Address" class="form-control" type="text">
              </div>
          </div>
            <div class="form-group">
							<label class="control-label col-md-3">Delivery Lugar</label>
							<div class="col-md-9">
								<input name="order_deli_lugar" placeholder="Delivery Lugar" class="form-control" type="text">
 
							</div>
			</div>
          <div class="form-group">
              <label class="control-label col-md-3">Final Address</label>
              <div class="col-md-9">
                <input name="order_mid_address" placeholder="Final Address" class="form-control" type="text">
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-md-3">Final Lugar</label>
              <div class="col-md-9">
                <input name="order_mid_lugar" placeholder="Final Lugar" class="form-control" type="text">
              </div>
          </div>         
         <div class="form-group">
              <label class="control-label col-md-3">Order Type</label>
              <div class="col-md-9">
                <input name="order_type" placeholder="Type" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3"> Amount($)</label>
              <div class="col-md-9">
                <input name="order_amount" placeholder="Amount" class="form-control" type="text">
              </div>
            </div>

          <div class="form-group">
              <label class="control-label col-md-3">Driver</label>
              <div class="col-md-9">
                <input name="order_driver_id" placeholder="Driver" class="form-control" type="text">
              </div>
            </div>
         <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                <input name="order_status" placeholder="Status" class="form-control" type="text">
              </div>
            </div>
         <div class="form-group">
              <label class="control-label col-md-3">Contact Name</label>
              <div class="col-md-9">
                <input name="order_contact_name" placeholder="Contact Name" class="form-control" type="text">
              </div>
            </div>
         <div class="form-group">
              <label class="control-label col-md-3">Contact Number</label>
              <div class="col-md-9">
                <input name="order_contact_num" placeholder="Contact Number" class="form-control" type="text">
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