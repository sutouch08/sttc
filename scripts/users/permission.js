
function groupViewCheck(el, id)
{
	if(el.is(":checked")){
		$(".view-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".view-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}

function groupAddCheck(el, id)
{
	if(el.is(":checked")){
		$(".add-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".add-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}

function groupEditCheck(el, id)
{
	if(el.is(":checked")){
		$(".edit-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".edit-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}

function groupDeleteCheck(el, id)
{
	if(el.is(":checked")){
		$(".delete-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".delete-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}


function groupApproveCheck(el, id)
{
	if(el.is(":checked")){
		$(".approve-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".approve-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}


function groupAllCheck(el, id)
{
  var view = $("#view-group-"+id);
  var add = $("#add-group-"+id);
  var edit = $("#edit-group-"+id);
  var del  = $("#delete-group-"+id);
  var ap = $('#approve-group-'+id);

	if(el.is(":checked")){
		view.prop("checked", true);
		groupViewCheck(view, id);
		add.prop("checked", true);
		groupAddCheck(add, id);
		edit.prop("checked", true);
		groupEditCheck(edit, id);
		del.prop("checked", true);
		groupDeleteCheck(del, id);
    ap.prop("checked", true);
		groupApproveCheck(ap, id);

	}else{
    view.prop("checked", false);
		groupViewCheck(view, id);
		add.prop("checked", false);
		groupAddCheck(add, id);
		edit.prop("checked", false);
		groupEditCheck(edit, id);
		del.prop("checked", false);
		groupDeleteCheck(del, id);
    ap.prop("checked", false);
		groupDeleteCheck(ap, id);
	}
}


function allCheck(el, id_tab){
  if(el.is(":checked")){
    $("."+id_tab).each(function(index, element) {
      $(this).prop("checked", true);
    });
  }
  else {
    $("."+id_tab).each(function(index, element) {
      $(this).prop("checked", false);
    });
  }
}


function savePermission(){
  var id = $('#id').val();
	var pms = [];

	$('.menu-code').each(function(){
		let menu = $(this).val();
		let view = $('#view-'+menu).is(':checked') ? 1 : 0;
		let add = $('#add-'+menu).is(':checked') ? 1 : 0;
		let edit = $('#edit-'+menu).is(':checked') ? 1 : 0;
		let del = $('#delete-'+menu).is(':checked') ? 1 : 0;
    let ap = $('#approve-'+menu).is(':checked') ? 1 : 0;

		let row = {
			"menu" : menu,
			"view" : view,
			"add" : add,
			"edit" : edit,
			"delete" : del,
      "approve" : ap
		}

		pms.push(row);
	});

	load_in();

	$.ajax({
		url:HOME + 'update_permission',
		type:'POST',
		cache:false,
		data:{
			'id' : id,
			'data' : JSON.stringify(pms)
		},
		success:function(rs) {
			load_out();
			if(rs === 'success') {
				swal({
					title:'Success',
					type:'success',
					timer:1000
				});
			}
			else {
				swal({
					title:'Error!',
					text:rs,
					type:'error'
				});
			}
		}
	})
}
