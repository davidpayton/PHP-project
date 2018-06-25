
  <div class="container">
    <h3>Customer Support Management</h3>

    <br />

      <div>
          <form id="values">
         FAQ URL: <input type="text" id="url_value" name="url" value="<?php echo $data['value'][0]->url; ?>">
         <br /><br />
         Phone Number: <input type="text" id="phone_value" name="phone" value="<?php echo $data['value'][0]->phone; ?>">
         <br /><br />
         Email : <input type="text" id="email_value" name="email" value="<?php echo $data['value'][0]->email; ?>">
         <br /><br />
         <button  class="btn btn-success" onclick="saveData()">Save Data</button>
        </form>
      </div>
      <br />
    <br />
      
  </div>
  <script type="text/javascript">

    function saveData(){
   
        var form = $("#values");
        
         $.post("<?=base_url()?>/support/support_update",
    {
      url: $('#url_value').val(),
      phone: $('#phone_value').val(),
      email:  $('#email_value').val(),
      
    },
    function(data, status){
       location.href();
    });
    }
  </script>
