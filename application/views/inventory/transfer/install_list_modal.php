<div class="modal fade" id="installListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">รายการติดตั้งเสร็จแล้ว</h4>
       </div>
       <div class="modal-body">
         <div class="row" style="max-height:75vh; overflow:auto;">
           <table class="table table-striped border-1">
             <thead>
               <tr>
                 <th class="fix-width-40 text-center">
                   <label>
                     <input type="checkbox" class="ace" id="select-all" onchange="selectAll()" />
                     <span class="lbl"></span>
                   </label>
                 </th>
                 <th class="fix-width-150">PEA NO (เก่า)</th>
                 <th class="fix-width-150">PEA NO (ใหม่)</th>
                 <th class="fix-width-100 text-center">เขต</th>
								 <th class="fix-width-100 text-center">วันที่ติดตั้ง</th>
                 <th class="min-width-100">ผู้ติดตั้ง</th>
               </tr>
             </thead>
             <tbody id="items-table">

             </tbody>
           </table>
         </div>
       </div>
       <div class="modal-footer">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-right">
           <button type="button" class="btn btn-sm btn-info btn-100" onclick="addToTransfer()">เพิ่มเข้าเอกสาร</button>
         </div>
       </div>
		</div>
	</div>
</div>

<script id="items-template" type="text/x-handlebarsTemplate">
  {{#each this}}
    {{#if nodata}}
      <tr>
        <td colspan="6" class="middle text-center">--- ไม่พบรายการ ---</td>
      </tr>
    {{else}}
      <tr>
        <td class="middle text-center">
          <label>
            <input type="checkbox" class="ace sel" value="{{id}}" />
            <span class="lbl"></span>
          </label>
        </td>
        <td>{{u_pea_no}}</td>
        <td>{{i_pea_no}}</td>
        <td>{{area_name}}</td>
        <td>{{work_date}}</td>
				<td>{{worker}}</td>
      </tr>
    {{/if}}
  {{/each}}
</script>
