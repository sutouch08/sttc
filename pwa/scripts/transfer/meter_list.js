
window.addEventListener('load', function() {
  updateScanType();
  getItemList();
});




function getSearch() {
  let txt = $('#scan-result').val();

  $('#search-text').val(txt);

  setTimeout(() => {
    searchText();
  }, 100);
}


function stopScan() {
	scanner.stop().then((ignore) => {
		$('#cam').addClass('hide');
    $('#reader-backdrop').addClass('hide');
    $('.sc').removeClass('hide');
	});
}


function searchText() {
  let txt = $.trim($('#search-text').val());

  if(txt.length) {
    $('#search-icon').addClass('hide');
    $('#clear-icon').removeClass('hide');

    setTimeout(() => {
      getItemList();
    }, 100);
  }
}

function clearSearch() {
  $('#search-text').val('');
  $('#clear-icon').addClass('hide');
  $('#search-icon').removeClass('hide');

  setTimeout(() => {
    getItemList();
  }, 100);
}



function getItemList() {
  let search = $.trim($('#search-text').val());
  load_in();
  localforage.getItem('inventory').then((data) => {
    let ds = [];
    if(data != null && data != undefined) {
      if(search != "") {
        ds = data.filter(obj => Object.values(obj).some(val => val.includes(search)));
      }
      else {
        ds = data;
      }
    }

    let source = $('#stock-template').html();
    let output = $('#detail-table');
    render(source, ds, output);
    reIndex();
    load_out();
  });
}



async function syncItemList() {
  await syncItem();
  await getItemList();
}
