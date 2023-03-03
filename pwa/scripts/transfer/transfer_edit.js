$(document).ready(function() {
  let id = localStorage.getItem('edit_id');

  if(navigator.onLine) {
    load_in();

    $.ajax({
      url:BASE_URL + 'inventory/transfer/vide_detail/'+id,
      type:'GET',
      cache:false,
      success:function(rs) {
        load_out();
        if(isJson(rs)) {
          let ds = JSON.parse(rs);

          $('#u-serial-code').val(ds.uSerial);
          $('#u-serial').val(ds.uSerial);
          $('#pea-no').val(ds.peaNo);
          $('#run-no').val(ds.powerNo);
          $('#year-no').val(ds.mYear);
          $('#condition').val(ds.cond);
          $('#u-preview').html('<img id="u-image" src="'+ds.u_image_data+'" class="width-100" alt="Item image" />');
          $('#u-blob').val(ds.u_image_data);
          suggest();

          $('#i-serial-code').val(ds.iSerial);
          $('#edit-serial').val(ds.iSerial);
          $('#i-serial').val(ds.iSerial);
          $('#item-code').val(ds.itemCode);
          $('#item-name').val(ds.itemName);
          $('#fromWhsCode').val(ds.fromWhsCode);
          let text = "";
          text += "Serial : "+ds.iSerial+"<br/>";
          text += "Item Code : "+ds.ItemCode+"<br/>";
          text += "Item Name : "+ds.ItemName+"<br/>";

          $('#i-reault').html(text);
          $('#i-preview').html('<img id="i-image" src="'+ds.i_image_data+'" class="width-100" alt="Item image" />');
          $('#i-blob').val(ds.u_image_data);
        }
      }
    });
  }
  else {
    localforage.getItem("transfers").then((data) => {
      if(data != null || data != undefined) {

        let item = data.filter((el) => {
          return el.iSerial = id;
        });

        console.log(item);
        if(item.length == 1) {
          let ds = item[0];
          $('#u-serial-code').val(ds.uSerial);
          $('#u-serial').val(ds.uSerial);
          $('#pea-no').val(ds.peaNo);
          $('#run-no').val(ds.runNo);
          $('#year-no').val(ds.mYear);
          $('#condition').val(ds.cond);
          $('#u-preview').html('<img id="u-image" src="'+ds.uImage+'" class="width-100" alt="Item image" />');
          $('#u-blob').val(ds.uImage);
          suggest();

          $('#i-serial-code').val(ds.iSerial);
          $('#edit-serial').val(ds.iSerial);
          $('#i-serial').val(ds.iSerial);
          $('#item-code').val(ds.itemCode);
          $('#item-name').val(ds.itemName);
          $('#fromWhsCode').val(ds.fromWhsCode);
          let text = "";
          text += "Serial : "+ds.iSerial+"<br/>";
          text += "Item Code : "+ds.ItemCode+"<br/>";
          text += "Item Name : "+ds.ItemName+"<br/>";

          $('#i-reault').html(text);
          $('#i-preview').html('<img id="i-image" src="'+ds.iImage+'" class="width-100" alt="Item image" />');
          $('#i-blob').val(ds.iImage);
        }
        else {
          console.log('nofound');
        }
      }
    });
  }
});
