$(document).ready(function() {
  console.log("Kurikulum Running . . ");
  table_main = $("#main").DataTable({
    ajax:base_url+"jurusan/readkurikulum"
  });
  table_result = $("#main_result").DataTable({

  })
  $("#savekurikulum").on('click',function(event) {
    event.preventDefault();
    if (confirm("Apakah Kamu Yakin  ? ")) {
      ins = {nama_kurikulum:$("#addkurikulum").val()};
      set = post(base_url+"jurusan/addkurikulum",ins);
      if (set.status == 1) {
        table_main.ajax.reload();
        toastr.success(set.msg);
      }else {
        toastr.error(set.msg);
      }
    }
  });
  $("#main").on('click', '.hapuskur', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    if (confirm("Apakah anda yakin ? ")) {
      del = post(base_url+"jurusan/delkurikulum",{id_kurikulum:id});
      if (del.status == 1) {
        table_main.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });
  $("#main").on('click', '.aturkur', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    $("#content_result").css("display","none");
    $("#preload").css("display","block");
    location.href = "#preload";
    set = get(base_url+"jurusan/aturkurikulum/"+id+"/stop");
    if (set.status == 1) {
        idkuri = set.id;
        $("#content_result").find(".title_box").html("Daftar Mata Kuliah Kurikulum "+set.kurikulum);
        table_result.ajax.url(base_url+"jurusan/aturkurikulum/"+id+"/start").load();
        $("#content_result").css("display","block");
        $("#content_result").find("#addmatkul").on('click', function(event) {
          event.preventDefault();
          var dialog = bootbox.dialog({
            title: 'Prepare Menu ',
            message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
          });
          dialog.init(function() {
            setTimeout(function() {
              dialog.find(".modal-title").html("Tambah Mata Kuliah Terkait");
              form = [[{
                label:"Kode Mata Kuliah",
                name:"kode_matkul",
                type:"text"
              },{
                label:"Nama Mata Kuliah",
                name:"nama_matkul",
                type:"text"
              },{
                label:"Semester",
                name:"id_semester",
                id:"id_semester",
                type:"select2"
              },{
                label:"Total SKS",
                name:"total_sks",
                id:"total_sks",
                type:"select2"
              },{
                label:"Total Pertemuan",
                name:"pertemuan",
                type:"number"
              },{
                name:"id_kurikulum",
                value:set.id,
                type:"hidden"
              },{
                label:"Jenis Mata Kuliah",
                name:"jenis",
                id:"jenis",
                type:"select2"
              }]];
              btn = {name:"Simpan",class:"success",type:"submit"};
              html = builder(form,btn,"save",true,12);
              dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
              sks = [];
              ix = 0;
              for (var i = 2; i <= 8; i++) {
                sks[ix++] = {text:i,value:i};
              }
              selectbuilder(sks,dialog.find("#total_sks"));
              selectbuilder([{text:"Wajib",value:"wajib"},{text:"Pilihan",value:"pilihan"}],dialog.find("#jenis"));
              getlist = get(base_url+"jurusan/listsemester/");
              smtr = [];
              if (getlist.status == 1) {
                for (var i = 0; i < getlist.data.length; i++) {
                  smtr[i] = {text:getlist.data[i].nama_semester,value:getlist.data[i].id_semester};
                }
              }else {
                toastr.error("Data Semester Tahun Ajar Kosong !");
              }
              selectbuilder(smtr,dialog.find("#id_semester"));
              dialog.find("#save").on('submit',  function(event) {
                event.preventDefault();
                dform = $(this).serializeArray();
                console.log(dform);
                ins = post(base_url+"jurusan/addmatkul",dform);
                if (ins.status == 1) {
                  table_result.ajax.reload();
                  bootbox.hideAll();
                  toastr.success(ins.msg)
                }else {
                  toastr.error(ins.msg)
                }
              });
            },200);
          });
        });
        $("#content_result").find("#main_result").on('click', '.editmatkul', function(event) {
          event.preventDefault();
          getmatkul = post(base_url+"jurusan/detailmatkul",{id_matkul:$(this).data("id")});
          if(getmatkul.status == 1){
            var dialog = bootbox.dialog({
              title: 'Prepare Menu ',
              message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
            });
            dialog.init(function() {
              setTimeout(function() {
                dialog.find(".modal-title").html("Ubah Mata Kuliah Terkait");
                form = [[{
                  label:"Kode Mata Kuliah",
                  name:"kode_matkul",
                  type:"text",
                  value:getmatkul.data.kode_matkul
                },{
                  label:"Nama Mata Kuliah",
                  name:"nama_matkul",
                  type:"text",
                  value:getmatkul.data.nama_matkul
                },{
                  label:"Semester",
                  name:"id_semester",
                  id:"id_semester",
                  type:"select2"
                },{
                  label:"Total SKS",
                  name:"total_sks",
                  id:"total_sks",
                  type:"select2"
                },{
                  label:"Total Pertemuan",
                  name:"pertemuan",
                  type:"number",
                  value:getmatkul.data.pertemuan
                },{
                  name:"id_kurikulum",
                  value:getmatkul.data.id_kurikulum,
                  type:"hidden"
                },{
                  label:"Jenis Mata Kuliah",
                  name:"jenis",
                  id:"jenis",
                  type:"select2"
                }]];
                btn = {name:"Update",class:"warning",type:"submit"};
                html = builder(form,btn,"save",true,12);
                dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
                sks = [];
                ix = 0;
                for (var i = 2; i <= 8; i++) {
                  sks[ix++] = {text:i,value:i};
                }
                selectbuilder(sks,dialog.find("#total_sks"),[{value:getmatkul.data.total_sks,text:getmatkul.data.total_sks}]);
                selectbuilder([{text:"Wajib",value:"wajib"},{text:"Pilihan",value:"pilihan"}],dialog.find("#jenis"),[{value:getmatkul.data.jenis,text:ucfirst(getmatkul.data.jenis)}]);
                getlist = get(base_url+"jurusan/listsemester");
                smtr = [];
                if (getlist.status == 1) {
                  for (var i = 0; i < getlist.data.length; i++) {
                    smtr[i] = {text:getlist.data[i].nama_semester,value:getlist.data[i].id_semester};
                  }
                }else {
                  toastr.error("Data Semester Tahun Ajar Kosong !");
                }
                selectbuilder(smtr,dialog.find("#id_semester"),[{value:getmatkul.data.id_semester,text:getmatkul.data.nama_semester}]);
                dialog.find("#save").on('submit',  function(event) {
                  event.preventDefault();
                  dform = $(this).serializeArray();
                  console.log(dform);
                  dform[dform.length] = {name:"id_matkul",value:getmatkul.data.id_matkul};
                  ins = post(base_url+"jurusan/upmatkul",dform);
                  if (ins.status == 1) {
                    table_result.ajax.reload();
                    bootbox.hideAll();
                    toastr.success(ins.msg)
                  }else {
                    toastr.error(ins.msg)
                  }
                });
              },200);
            });
          }else{
            toastr.error(getmatkul.msg);
          }
        });
        $("#content_result").find("#main_result").on('click', '.hapusmatkul', function(event) {
          event.preventDefault();
          if (confirm("Apakah Anda Yakin ? ")) {
            id = $(this).data("id");
            del = post(base_url+"jurusan/delmatkul",{id_matkul:id});
            if (del.status == 1) {
              table_result.ajax.reload();
              toastr.success(del.msg);
            }else {
              toastr.error(del.msg);
            }
          }
        });
    }else {
      toastr.error("Terputus Dari Server");
    }
    setTimeout(function () {
      $("#preload").css("display","none");
      location.href = "#content_result";
    }, 1000);

  });

});
