$(document).ready(function() {
  console.log("Set Akademik Running . .");
  table_tajar = $("#maintajar").DataTable({
    ajax:base_url+"admin/readtajar"
  })
  table_semester = $("#mainsemester").DataTable({
    ajax:base_url+"admin/readsemester"
  })
  $("#addtajar").on('click',  function(event) {
    event.preventDefault();
    var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Tambah Tahun Ajar");
          form = [[{
            label:"Tahun Ajaran",
            name:"nama_tajar",
            type:"text"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,12);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            console.log(dform);
            ins = post(base_url+"admin/addtajar",dform);
            if (ins.status == 1) {
              toastr.success(ins.msg);
              bootbox.hideAll();
              table_tajar.ajax.reload()
            }else {
              toastr.error(ins.msg);
            }
          });
        },400);
      });
  });
  $("#maintajar").on('click', '.updatetajar', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    data = table_tajar.row($(this).data("index")).data();
    console.log(data);
    var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Ubah Tahun Ajar");
          form = [[{
            label:"Tahun Ajaran",
            name:"nama_tajar",
            type:"text",
            value:data[1]
          }]];
          btn = {name:"Simpan",class:"warning",type:"submit"};
          html = builder(form,btn,"save",true,12);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            console.log(dform);
            dform[dform.length] = {name:"id_tajar",value:id};
            ins = post(base_url+"admin/uptajar",dform);
            if (ins.status == 1) {
              toastr.success(ins.msg);
              bootbox.hideAll();
              table_tajar.ajax.reload()
            }else {
              toastr.error(ins.msg);
            }
          });
        },400);
      });
  });
  $("#maintajar").on('click', '.hapustajar', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    data = table_tajar.row($(this).data("index")).data();
    if (confirm("Apakah Kamu Yakin ?")) {
      del = post(base_url+"admin/deltajar",{id_tajar:id});
      if (del.status == 1) {
        bootbox.hideAll();
        table_tajar.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });

});
