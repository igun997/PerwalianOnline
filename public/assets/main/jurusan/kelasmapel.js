$(document).ready(function() {
  console.log("Kelasmapel Running . . .");
  table_ruang = $("#mainruang").DataTable({
    ajax:base_url+"jurusan/readruangan"
  });
  table_mapel = $("#mainkelas").DataTable({
    ajax:base_url+"jurusan/readkelasmapel"
  });
  $("#addruangan").on('click', function(event) {
    event.preventDefault();
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Tambah Ruangan");
          form = [[{
            label:"Nama Ruangan",
            type:"text",
            name:"nama_ruangan"
          },{
            label:"Kapasitas Ruangan",
            type:"number",
            name:"kuota_ruangan"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,12);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            ins = post(base_url+"jurusan/addruangan",dform);
            if (ins.status == 1) {
              bootbox.hideAll();
              table_ruang.ajax.reload();
              toastr.success(ins.msg);
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });
  });
  $("#mainruang").on('click', '.deleteruangan', function(event) {
    event.preventDefault();
    if (confirm("Apakah Anda Yakin ? ")) {
      del = post(base_url+"jurusan/delruangan",{id_ruangan:$(this).data("id")});
      if (del.status) {
        table_ruang.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });
  $("#mainruang").on('click', '.updateruangan', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    index = $(this).data("index");
    data = table_ruang.row(index).data();
    var dialog = bootbox.dialog({
      title: 'Prepare Menu ',
      message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
    });
    dialog.init(function() {
      setTimeout(function() {
        dialog.find(".modal-title").html("Update Ruangan");
        form = [[{
          label:"Nama Ruangan",
          type:"text",
          name:"nama_ruangan",
          value:data[1]
        },{
          label:"Kapasitas Ruangan",
          type:"number",
          name:"kuota_ruangan",
          value:data[2]
        }]];
        btn = {name:"Update",class:"warning",type:"submit"};
        html = builder(form,btn,"save",true,12);
        dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
        dialog.find("#save").on('submit', function(event) {
          event.preventDefault();
          dform = $(this).serializeArray();
          dform[dform.length] = {name:"id_ruangan",value:id};
          ins = post(base_url+"jurusan/upruangan",dform);
          if (ins.status == 1) {
            bootbox.hideAll();
            table_ruang.ajax.reload();
            toastr.success(ins.msg);
          }else {
            toastr.error(ins.msg);
          }
        });
      },2000);
    });
  });
  $("#addkelasmapel").on('click', function(event) {
    event.preventDefault();
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Tambah Kelas Mata Kuliah");
          form = [[{
            label:"Nama Kelas",
            type:"text",
            name:"nama_kelas"
          },{
            label:"Hari",
            type:"select2",
            name:"hari_kelas",
            id:"hari_kelas"
          },{
            label:"Jam Mulai",
            type:"text",
            id:"mulai_kelas",
            name:"mulai_kelas"
          },{
            label:"Jam Selesai",
            type:"text",
            id:"selesai_kelas",
            name:"selesai_kelas"
          }],[{
            label:"Ruangan",
            name:"id_ruangan",
            id:"id_ruangan",
            type:"select2"
          },{
            label:"Mata Kuliah",
            name:"id_matkul",
            id:"id_matkul",
            type:"select2"
          },{
            label:"Dosen Pengampu",
            name:"id_user",
            id:"id_user",
            type:"select2"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,6);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          dialog.find("#mulai_kelas").datetimepicker({
              format: 'HH:MM:SS'
          });
          dialog.find("#selesai_kelas").datetimepicker({
              format: 'HH:MM:SS'
          });
          hari = ["senin","selasa","rabu","kamis","jumat","sabtu","minggu"];
          hari_cmp = [];
          for (var i = 0; i < hari.length; i++) {
            hari_cmp[i] = {value:hari[i],text:ucfirst(hari[i])};
          }
          selectbuilder(hari_cmp,dialog.find("#hari_kelas"));
          select2builder(base_url+"jurusan/listruangan",dialog.find("#id_ruangan"));
          select2builder(base_url+"jurusan/listmatkul",dialog.find("#id_matkul"));
          select2builder(base_url+"jurusan/listdosen",dialog.find("#id_user"));
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            ins = post(base_url+"jurusan/addkelasmapel",dform);
            if (ins.status == 1) {
              bootbox.hideAll();
              table_mapel.ajax.reload();
              toastr.success(ins.msg);
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });
  });
  $("#mainkelas").on('click', '.deletekelas', function(event) {
    event.preventDefault();
    if (confirm("Apakah Anda Yakin ? ")) {
      del = post(base_url+"jurusan/delkelasmapel",{id_kelas:$(this).data("id")});
      if (del.status) {
        table_mapel.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });
  $("#mainkelas").on('click', '.updatekelas', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    index = $(this).data("index");
    data = table_ruang.row(index).data();
    getdata = post(base_url+"jurusan/detailkelasmapel",{id_kelas:id});
    if (getdata.status == 1) {
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Ubah Kelas Mata Kuliah");
          form = [[{
            label:"Nama Kelas",
            type:"text",
            name:"nama_kelas",
            value:getdata.data.nama_kelas
          },{
            label:"Hari",
            type:"select2",
            name:"hari_kelas",
            id:"hari_kelas"
          },{
            label:"Jam Mulai",
            type:"text",
            id:"mulai_kelas",
            name:"mulai_kelas",
            value:getdata.data.mulai_kelas
          },{
            label:"Jam Selesai",
            type:"text",
            id:"selesai_kelas",
            name:"selesai_kelas",
            value:getdata.data.selesai_kelas
          }],[{
            label:"Ruangan",
            name:"id_ruangan",
            id:"id_ruangan",
            type:"select2"
          },{
            label:"Mata Kuliah",
            name:"id_matkul",
            id:"id_matkul",
            type:"select2"
          },{
            label:"Dosen Pengampu",
            name:"id_user",
            id:"id_user",
            type:"select2"
          }]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,6);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          dialog.find("#mulai_kelas").datetimepicker({
            format: 'HH:MM:SS'
          });
          dialog.find("#selesai_kelas").datetimepicker({
            format: 'HH:MM:SS'
          });
          hari = ["senin","selasa","rabu","kamis","jumat","sabtu","minggu"];
          hari_cmp = [];
          for (var i = 0; i < hari.length; i++) {
            hari_cmp[i] = {value:hari[i],text:ucfirst(hari[i])};
          }
          selectbuilder(hari_cmp,dialog.find("#hari_kelas"),[{text:ucfirst(getdata.data.hari_kelas),value:getdata.data.hari_kelas}]);
          select2builder(base_url+"jurusan/listruangan",dialog.find("#id_ruangan"));
          select2builder(base_url+"jurusan/listmatkul",dialog.find("#id_matkul"));
          select2builder(base_url+"jurusan/listdosen",dialog.find("#id_user"));
          dialog.find("#id_ruangan").val(getdata.data.id_ruangan).trigger("change");
          dialog.find("#id_matkul").val(getdata.data.id_matkul).trigger("change");
          dialog.find("#id_user").val(getdata.data.id_user).trigger("change");
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            dform[dform.length] = {name:"id_kelas",value:id};
            ins = post(base_url+"jurusan/upkelasmapel",dform);
            if (ins.status == 1) {
              bootbox.hideAll();
              table_mapel.ajax.reload();
              toastr.success(ins.msg);
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });
    }else {
      toastr.error("Data Tidak Ditemukan");
    }
  });
});
