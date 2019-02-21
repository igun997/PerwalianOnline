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
  $("#addsemester").on('click',function(event) {
    event.preventDefault();
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Tambah Semester");
          form = [[{
            label:"Semester",
            name:"nama_semester",
            type:"text"
          },{
            label:"Tahun Ajar",
            name:"id_tajar",
            id:"id_tajar",
            type:"select2"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,12);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          select2builder(base_url+"admin/listtajar",dialog.find("#id_tajar"));
          dialog.find("#save").on('submit',function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            console.log(dform);
            ins = post(base_url+"admin/addsemester",dform);
            if (ins.status == 1) {
              bootbox.hideAll();
              table_semester.ajax.reload();
              toastr.success(ins.msg);
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });
  });
  $("#mainsemester").on('click', '.hapussemester', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    if (confirm("Apakah Anda Yakin ? ")) {
      del = post(base_url+"admin/delsemester",{id_semester:id});
      if (del.status == 1) {
        table_semester.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });
  $("#mainsemester").on('click', '.updatesemester', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    data = table_semester.row($(this).data("index")).data();
    var dialog = bootbox.dialog({
      title: 'Prepare Menu ',
      message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
    });
    dialog.init(function() {
      setTimeout(function() {
        dialog.find(".modal-title").html("Ubah Semester");
        form = [[{
          label:"Semester",
          name:"nama_semester",
          type:"text",
          value:data[1]
        },{
          label:"Tahun Ajar",
          name:"id_tajar",
          id:"id_tajar",
          type:"select2"
        }]];
        btn = {name:"Simpan",class:"success",type:"submit"};
        html = builder(form,btn,"save",true,12);
        dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
        select2builder(base_url+"admin/listtajar",dialog.find("#id_tajar"));
        getdata = post(base_url+"admin/detailsemester",{id_semester:id})
        if(getdata.status == 0){
          bootbox.hideAll();
          toastr.error("Data Tidak Ditemukan");
        }
        dialog.find("#id_tajar").val(getdata.data.id_tajar).trigger("change");
        dialog.find("#save").on('submit',function(event) {
          event.preventDefault();
          dform = $(this).serializeArray();
          console.log(dform);
          dform[dform.length] = {name:"id_semester",value:id};
          ins = post(base_url+"admin/upsemester",dform);
          if (ins.status == 1) {
            bootbox.hideAll();
            table_semester.ajax.reload();
            toastr.success(ins.msg);
          }else {
            toastr.error(ins.msg);
          }
        });
      },2000);
    });
  });
});
