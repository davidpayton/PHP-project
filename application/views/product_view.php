
  <div class="container">
    <h3>Product Management</h3>
    <br />
    <button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
			<th> ID</th>
			<th> Product Name</th>
			<th>Product Photo</th>
			<th>Product Price</th>
			<th>Product Quantity</th>
            <th>Liter</th>
            <th>Product Group</th>
            <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($products as $product){?>
				     <tr>
				        <td><?php echo $product->product_id;?></td>
				        <td><?php echo $product->product_name;?></td>
						<td><img src = "<?php echo $product->product_photo; ?>" width="32" height="32"></td>
						<td><?php echo $product->product_price;?></td>
                        <td><?php echo $product->product_quantity;?></td>
                        <td><?php echo $product->product_liter;?></td>
                        <td><?php echo $product->product_group_name;?></td>
						<td>
							<button class="btn btn-warning" onclick="edit_product(<?php echo $product->product_id;?>)"><i class="icon-pencil"></i></button>
							<button class="btn btn-danger" onclick="delete_product(<?php echo $product->product_id;?>)"><i class="icon-trash"></i></button>
                		</td>
				      </tr>
				     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
            <th> ID</th>
			<th> Name</th>
			<th> Photo</th>
			<th> Price</th>
			<th>Quantity</th>
            <th>Liter</th>
            <th>Group</th>
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
 
 
    function add_product()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit_product(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      var options = {
        "url":  "<?php echo site_url('product/ajax_edit/') ?>/" + id,
        type: 'GET',
        complete: function(response)
        {
            var data = JSON.parse(response.responseText);
            $('[name="product_id"]').val(data.product_id);
            $('[name="product_name"]').val(data.product_name);
            $('[name="product_price"]').val(data.product_price);
            $('[name="product_quantity"]').val(data.product_quantity);
            $('[name="product_liter"]').val(data.product_liter);
            $('[name="product_group_name"]').val(data.product_group_name);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit product'); // Set title to Bootstrap modal title
          }
        };
        $("#form").ajaxSubmit(options);
    }
 
 
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('product/product_add')?>";
      }
      else
      {
        url = "<?php echo site_url('product/product_update')?>";
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
 
    function delete_product(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('product/product_delete')?>/"+id,
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
      <h3 class="modal-title">Product Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
      <form id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" value="" name="product_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Name</label>
              <div class="col-md-9">
                <input name="product_name" placeholder="productname" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                <input name="product_photo" placeholder="Photo" class="form-control" type="file">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Price</label>
              <div class="col-md-9">
								<input name="product_price" placeholder="Price" class="form-control" type="text">
 
              </div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Quantity</label>
							<div class="col-md-9">
								<input name="product_quantity" placeholder="Quantity" class="form-control" type="text">
 
						</div>
			</div>
            <div class="form-group">
							<label class="control-label col-md-3">Liter</label>
							<div class="col-md-9">
								<input name="product_liter" placeholder="Liter" class="form-control" type="text">
 
							</div>
			</div>
           <div class="form-group">
							<label class="control-label col-md-3">Group</label>
							<div class="col-md-9">
								<input name="product_group_name" placeholder="Group" class="form-control" type="text">
 
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