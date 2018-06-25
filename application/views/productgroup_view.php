
  <div class="container">
    <h3>Alcohol Group Management</h3>
    <br />
    <button class="btn btn-success" onclick="add_productgroup()"><i class="icon-plus"></i> Add productgroup</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>ID</th>
					<th>Name</th>
                    <th>Photo</th>
          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach ($productgroups as $productgroup) {?>
				     <tr>
				         <td><?php echo $productgroup->product_group_id; ?></td>
				         <td><?php echo $productgroup->product_group_name; ?></td>
                                 <td><img src="<?php echo $productgroup->product_group_image; ?>" width="110" height="32"></td>
    								<td>
									<button class="btn btn-warning" onclick="edit_productgroup(<?php echo $productgroup->product_group_id; ?>)"><i class="icon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_productgroup(<?php echo $productgroup->product_group_id; ?>)"><i class="icon-trash"></i></button>


								</td>
				      </tr>
				     <?php }?>



      </tbody>

      <tfoot>
        <tr>
        <th>ID</th>
					<th>Name</th>
                    <th>Photo</th>
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


    function add_productgroup()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_productgroup(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals


      var options = {
        "url":  "<?php echo site_url('productgroup/ajax_edit/') ?>/" + id,
        type: 'GET',
        complete: function(response)
        {
          var data = JSON.parse(response.responseText);
          $('[name="productgroup_id"]').val(data.productgroup_id);
            $('[name="productgroup_name"]').val(data.productgroup_name);
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit productgroup'); 

          }
        };

    $("#form").ajaxSubmit(options);
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('productgroup/productgroup_add') ?>";
      }
      else
      {
        url = "<?php echo site_url('productgroup/productgroup_update') ?>";
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
              // $(".preview").css("display","block");
              // $(".preview").find("img").attr("src","/uploads/"+response.responseJSON.success);
          }else{
              alert('Image Upload Error.');
            }
          }
        };
        $("#form").ajaxSubmit(options);

       // ajax adding data to database
        //   $.ajax({
        //     url : url,
        //     type: "POST",
        //     data: $('#form').serialize(),
        //     dataType: "JSON",
        //     success: function(data)
        //     {
        //        //if success close modal and reload ajax table
        //        $('#modal_form').modal('hide');
        //       location.reload();// for reload a page
        //     },
        //     error: function (jqXHR, textStatus, errorThrown)
        //     {
        //         alert('Error adding / update data');
        //     }
        // });
    }

    function delete_productgroup(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('productgroup/productgroup_delete') ?>/"+id,
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
        <h3 class="modal-title">Form</h3>
      </div>
      <div class="modal-body form">
        <form id="form" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" value="" name="productgroup_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Name</label>
              <div class="col-md-9">
                <input name="productgroup_name" placeholder="Name" class="form-control" type="text" >
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Photo</label>
              <div class="col-md-9">
                <input name="productgroup_image" placeholder="Photo" class="form-control" type="file">
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
