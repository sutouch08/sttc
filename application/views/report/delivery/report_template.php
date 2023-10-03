<script id="report-template" type="text/x-handlebarsTemplate">
{{#each this}}
  <div class="page_layout" style="">
    <div style="width:190mm; margin:auto;">
      <table class="table">
        <thead>
          <tr>
            <th colspan="9" style="font-weight:bold;">รายละเอียดมิเตอร์จานหมุนรื้อถอน ตามสัญญาเลขที่ .{{contract_no}}....... งวดที่ ....{{round_no}}......</th>
          </tr>
          <tr>
            <th colspan="9" style="font-weight:bold;">รายการที่ ..{{list_no}}... จัดซื้อมิเตอร์อิเล็กทรอนิกส์พร้อมติดตั้งสับเปลี่ยนทดแทนจานหมุนในพื้นที่ {{sub_area_name}} การไฟฟ้า {{team_full_name}}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center" style="width:10mm;">ลำดับ</td>
            <td class="text-center" style="width:25mm;">ลังที่</td>
            <td class="text-center" style="width:25mm;">วันที่รื้อถอน</td>
            <td class="text-center" style="width:25mm;">PEA No.</td>
            <td class="text-center" style="width:10mm;">เฟส</td>
            <td class="text-center" style="width:20mm;">ขนาด</td>
            <td class="text-center" style="width:20mm;">หน่วย (kWh)</td>
            <td class="text-center" style="width:15mm;">อายุ (ปี)</td>
            <td class="text-center" style="width:40mm;">ลักษณะชำรุด (ถ้ามี)</td>
          </tr>
          {{#each data}}
            <tr>
              <td class="text-center">{{no}}</td>
              <td class="">{{pack_code}}</td>
              <td class="">{{work_date}}</td>
              <td class="text-right">{{pea_no}}</td>
              <td class="text-right">{{phase}}</td>
              <td class="">{{meter_size}}</td>
              <td class="text-right">{{meter_read_end}}</td>
              <td class="text-right">{{meter_age}}</td>
              <td>{{dispose_reason_name}}</td>
            </tr>
            {{/each}}
        </tbody>
      </table>
    </div>
  </div>
{{/each}}
</script>

<script id="sub-area-template" type="text/x-handlebarsTemplate">
  <option value="">เลือกพื้นที่</option>

  {{#each this}}
    <option value="{{id}}" data-team="{{team_id}}">{{name}}</option>
  {{/each}}
</script>

<script id="no-area-template" type="text/x-handlebarsTemplate">
  <option value="">ไม่พบข้อมูล</option>
</script>
