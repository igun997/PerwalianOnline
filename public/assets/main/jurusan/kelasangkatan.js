$(document).ready(function() {
  console.log("kelasangkatan running . . .");
  table_main = $("#main").DataTable({
    ajax:base_url+"jurusan/readkelasangkatan"
  });
  $("#addkelasangkatan").on('click', function(event) {
    event.preventDefault();
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Tambah Kelas Angkatan");
          form = [[{
            label:"Kode Kelas",
            name:"kode_kelas",
            type:"text"
          },{
            label:"Nama Kelas",
            name:"nama_kelas",
            type:"text"
          },{
            label:"Tahun Ajaran",
            name:"id_tajar",
            id:"id_tajar",
            type:"select2"
          },{
            label:"Dosen Wali",
            name:"id_user",
            id:"id_user",
            type:"select2"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,12);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          select2builder(base_url+"jurusan/listtajar",dialog.find("#id_tajar"));
          select2builder(base_url+"jurusan/listdosen",dialog.find("#id_user"));

          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            ins = post(base_url+"jurusan/addkelasangkatan",dform);
            if (ins.status == 1) {
              bootbox.hideAll();
              table_main.ajax.reload();
              toastr.success(ins.msg);
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });
  });
  $("#main").on('click', '.updatekelas', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    index = $(this).data("index");
    getdata = post(base_url+"jurusan/detailkelasangkatan",{id_kelasawal:id});
    if (getdata.status == 1) {
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Tambah Kelas Angkatan");
          form = [[{
            label:"Kode Kelas",
            name:"kode_kelas",
            type:"text",
            value:getdata.data.kode_kelas
          },{
            label:"Nama Kelas",
            name:"nama_kelas",
            type:"text",
            value:getdata.data.nama_kelas
          },{
            label:"Tahun Ajaran",
            name:"id_tajar",
            id:"id_tajar",
            type:"select2"
          },{
            label:"Dosen Wali",
            name:"id_user",
            id:"id_user",
            type:"select2"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,12);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          select2builder(base_url+"jurusan/listtajar",dialog.find("#id_tajar"));
          select2builder(base_url+"jurusan/listdosen",dialog.find("#id_user"));
          dialog.find("#id_tajar").val(getdata.data.id_tajar).trigger("change");
          dialog.find("#id_user").val(getdata.data.id_user).trigger("change");
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            dform[dform.length] = {name:"id_kelasawal",value:getdata.data.id_kelasawal};
            ins = post(base_url+"jurusan/upkelasangkatan",dform);
            if (ins.status == 1) {
              bootbox.hideAll();
              table_main.ajax.reload();
              toastr.success(ins.msg);
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });

    }else {
      toastr.error(get.msg);
    }
  });
  $("#main").on('click', '.deletekelas', function(event) {
    event.preventDefault();
    if (confirm("Apakah Anda Yakin ?")) {
      del = post(base_url+"jurusan/delkelasangkatan",{id_kelasawal:$(this).data("id")});
      if (del.status == 1) {
        table_main.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });
});
