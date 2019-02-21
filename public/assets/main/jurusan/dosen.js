$(document).ready(function() {
  console.log("Dosen Running");
  table_main = $("#main").DataTable({
    ajax:base_url+"jurusan/readdosen"
  })
  $("#adddosen").on('click', function(event) {
    event.preventDefault();
    var dialog = bootbox.dialog({
      title: 'Prepare Menu ',
      message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
    });
    dialog.init(function() {
      setTimeout(function() {
        dialog.find(".modal-title").html("Tambah Dosen");
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
         ins = post(base_url+"jurusan/adddosen",dform);
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
  $("#main").on('click',".updatedosen", function(event) {
    event.preventDefault();
    id = $(this).data("id");
    getdata = post(base_url+"jurusan/detaildosen",{id_user:id});
    if (getdata.status == 1) {
      var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Ubah Dosen");
          form = [[{
            label:"Nama Lengkap",
            type:"text",
            name:"nama_lengkap",
            value:getdata.data.nama_lengkap
          },{
            label:"Username",
            type:"readonly",
            name:"username",
            value:getdata.data.username
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
            value:getdata.data.email
          }],[
            {
              label:"Nomor HP",
              type:"text",
              name:"no_hp",
              value:getdata.data.no_hp
            },{
              label:"No Telepon",
              type:"text",
              name:"no_telepon",
              value:getdata.data.no_telepon
            },{
              label:"Alamat",
              type:"textarea",
              name:"alamat",
              value:getdata.data.alamat
            }
          ]];
          btn = {name:"Update",class:"warning",type:"submit"};
          html = builder(form,btn,"save",true,4);
          dialog.find(".bootbox-body").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
          selectbuilder([{text:"Laki-Laki",value:"laki-laki"},{text:"Perempuan",value:"perempuan"}],dialog.find("#jk"),[{text:(getdata.data.jk).toUpperCase(),value:getdata.data.jk}]);
          dialog.find("#save").on('submit', function(event) {
            event.preventDefault();
            dform = $(this).serializeArray();
            console.log(dform);
            dform[dform.length] = {name:"id_user",value:getdata.data.id_user};
            toastr.info("Data Sedang Dikirim");
            ins = post(base_url+"jurusan/updosen",dform);
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
    }else {
      toastr.error(getdata.msg);
    }
  });
  $("#main").on('click', '.deletedosen', function(event) {
    event.preventDefault();
    if (confirm("Apakah Anda Yakin ?")) {
      id = $(this).data("id");
      console.log(id);
      del = post(base_url+"jurusan/deldosen",{id_user:id});
      if (del.status == 1) {
        table_main.ajax.reload();
        toastr.success(del.msg);
      }else {
        toastr.error(del.msg);
      }
    }
  });
});
