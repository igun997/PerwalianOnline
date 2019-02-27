$(document).ready(function() {
  table_main = $("#main").DataTable({
    ajax:base_url+"admin/readbaak"
  })
  $("#add").on('click',function(event) {
    event.preventDefault();
    var dialog = bootbox.dialog({
      title: 'Prepare Menu ',
      message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
    });
    dialog.init(function() {
      setTimeout(function() {
        dialog.find(".modal-title").html("Tambah Admin BAAK");
        form = [[{
          label:"Nama Lengkap",
          type:"text",
          name:"nama_lengkap",
        },{
          label:"Username",
          type:"text",
          name:"username"
        },{
          label:"Password",
          type:"text",
          name:"password"
        },{
          label:"Jenis Kelamin",
          type:"select2",
          name:"jk",
          id:"jk"
        }],[{
          label:"Email",
          type:"email",
          name:"email"
        }],[
          {
            label:"Nomor HP",
            type:"text",
            name:"no_hp"
          },{
            label:"No Telepon",
            type:"text",
            name:"no_telepon"
          },{
            label:"Alamat",
            type:"textarea",
            name:"alamat"
          }
        ]];
        btn = {name:"Simpan",class:"success",type:"submit"};
        html = builder(form,btn,"save",true,4);
        dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
        selectbuilder([{text:"Laki-Laki",value:"laki-laki"},{text:"Perempuan",value:"perempuan"}],dialog.find("#jk"));
        dialog.find("#save").on('submit', function(event) {
          event.preventDefault();
          dform = $(this).serializeArray();
          console.log(dform);
          toastr.info("Data Sedang Dikirim");
         ins = post(base_url+"admin/addbaak",dform);
         if (ins.status == 1) {
           table_main.ajax.reload();
           toastr.success(ins.msg);
           bootbox.hideAll();
         }else {
           toastr.error(ins.msg);
         }
        });
      },2000);
    });
  });
  $("#main").on('click', '.hapusbaak', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    c = confirm("Apakah Anda Yakin ?");
    if (c) {
      toastr.info("Permintaan Sedang Dikirim . . ");
      del = post(base_url+"admin/delbaak",{id_user:id});
      if (del.status == 1) {
        toastr.success(del.msg);
        bootbox.hideAll();
        table_main.ajax.reload();
      }else {
        toastr.error(del.msg);
      }
    }
  });
  $("#main").on('click', '.detailbaak', function(event) {
    event.preventDefault();
    index = $(this).data("index");
    id = $(this).data("id");
    data = table_main.row(index).data();
    dataUser = post(base_url+"admin/detailbaak",{id_user:id});
    if (dataUser.status == 0) {
      bootbox.hideAll();
      toastr.error(dataUser.msg);
    }else {
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Detail Admin Jurusan");
          form = [[{
            label:"Nama Lengkap",
            type:"text",
            name:"nama_lengkap",
            value:data[1]
          },{
            label:"Username",
            type:"disabled",
            name:"username",
            value:data[2]
          },{
            label:"Password",
            type:"text",
            name:"password"
          },{
            label:"Jenis Kelamin",
            type:"select2",
            name:"jk",
            id:"jk"
          }],[{
            label:"Email",
            type:"email",
            name:"email",
            value:data[3]
          },{
            label:"Jurusan",
            type:"select2",
            name:"id_jurusan",
            id:"id_jurusan"
          }],[
            {
              label:"Nomor HP",
              type:"text",
              name:"no_hp",
              value:dataUser.data.no_hp
            },{
              label:"No Telepon",
              type:"text",
              name:"no_telepon",
              value:dataUser.data.no_telepon
            },{
              label:"Alamat",
              type:"textarea",
              name:"alamat",
              value:dataUser.data.alamat
            }
          ]];
          btn = {name:"X",class:"danger",type:"submit"};
          html = builder(form,btn,"save",true,4);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          select2builder(base_url+"admin/listjurusan",dialog.find("#id_jurusan"));
          dialog.find("#id_jurusan").val(dataUser.data.id_jurusan).trigger('change');
          selectbuilder([{text:"Laki-Laki",value:"laki-laki"},{text:"Perempuan",value:"perempuan"}],dialog.find("#jk"),[{value:dataUser.data.jk,text:(dataUser.data.jk).toUpperCase()}]);
          dialog.find("input").attr("disabled",true);
          dialog.find("select").attr("disabled",true);
          dialog.find("textarea").attr("disabled",true);
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            bootbox.hideAll();
          });

        },2000);
      });
    }
  });
  $("#main").on('click', '.updatebaak', function(event) {
    event.preventDefault();
    index = $(this).data("index");
    id = $(this).data("id");
    data = table_main.row(index).data();
    dataUser = post(base_url+"admin/detailbaak",{id_user:id});
    if (dataUser.status == 0) {
      bootbox.hideAll();
      toastr.error(dataUser.msg);
    }else {
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Ubah Admin Jurusan");
          form = [[{
            label:"Nama Lengkap",
            type:"text",
            name:"nama_lengkap",
            value:data[1]
          },{
            label:"Username",
            type:"disabled",
            name:"username",
            value:data[2]
          },{
            label:"Password",
            type:"text",
            name:"password"
          },{
            label:"Jenis Kelamin",
            type:"select2",
            name:"jk",
            id:"jk"
          }],[{
            label:"Email",
            type:"email",
            name:"email",
            value:data[3]
          }],[
            {
              label:"Nomor HP",
              type:"text",
              name:"no_hp",
              value:dataUser.data.no_hp
            },{
              label:"No Telepon",
              type:"text",
              name:"no_telepon",
              value:dataUser.data.no_telepon
            },{
              label:"Alamat",
              type:"textarea",
              name:"alamat",
              value:dataUser.data.alamat
            }
          ]];
          btn = {name:"Simpan",class:"success",type:"submit"};
          html = builder(form,btn,"save",true,4);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          dialog.find("#id_jurusan").val(dataUser.data.id_jurusan).trigger('change');
          selectbuilder([{text:"Laki-Laki",value:"laki-laki"},{text:"Perempuan",value:"perempuan"}],dialog.find("#jk"),[{value:dataUser.data.jk,text:(dataUser.data.jk).toUpperCase()}]);
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            console.log(dform);
            toastr.info("Data Sedang Dikirim");
            dform[dform.length] = {name:"id_user",value:id};
            ins = post(base_url+"admin/upbaak",dform);
            if (ins.status == 1) {
              table_main.ajax.reload();
              toastr.success(ins.msg);
              bootbox.hideAll();
            }else {
              toastr.error(ins.msg);
            }
          });
        },2000);
      });
    }
  });
});
