$(document).ready(function() {
  console.log("Mahasiswa Running ... ");
  $("#cari").on('submit', function(event) {
    event.preventDefault();
    dform = $(this).serializeArray();
    console.log(dform);
    $("#preload").css("display","block");
    location.href = "#content";
    get = post(base_url+"admin/carimahasiswa",dform);
    if (get.status == 0) {
      toastr.error(get.msg);
      setTimeout(function () {
        $("#preload").css("display","none");
      }, 500);
    }else {
      toastr.success(get.msg);
      form = [[{
        label:"NIM",
        type:"disabled",
        name:"",
        value:get.data.username
      },{
        label:"Jurusan",
        type:"disabled",
        name:"",
        value:get.data.nama_jurusan
      },{
        label:"Nama Lengkap",
        type:"disabled",
        name:"",
        value:get.data.nama_lengkap
      },{
        label:"Jenis Kelamin",
        type:"disabled",
        name:"",
        value:(get.data.jk).toUpperCase()
      },{
        label:"Alamat",
        type:"textarea",
        name:"",
        value:get.data.alamat
      },{
        label:"Email",
        type:"disabled",
        name:"",
        value:get.data.email
      },{
        label:"No HP / No Telepon",
        type:"disabled",
        name:"",
        value:get.data.no_hp+"/"+get.data.no_telepon
      },{
        label:"Status Mahasiswa",
        type:"disabled",
        name:"",
        value:(get.data.hapus == "tidak")?(get.data.status_absen == "Ya")?"Aktif":"Terblokir":"Tidak Aktif"
      }]];
      html = builder(form,{name:"Reset Password",type:"submit",class:"warning"},"reset",true,12);
      $("#content").html("<div class='row'><div class='col-md-12'>"+html+"</div></div>");
      $("#content").find("textarea").attr("disabled",true);
      $("#content").find("#reset").on('submit',function(event) {
        event.preventDefault();
        if (confirm("Apakah Anda Yakin  ? ")) {
          reset = post(base_url+"admin/rpmahasiswa",{id_user:get.data.id_user});
          if (reset.status == 1) {
            toastr.success("Password Berhasil di Reset");
            bootbox.alert("Password Baru : <b>"+reset.newpass+"</b>");
          }else {
            toastr.error("Password Gagal di Reset");
          }
        }
      });
      setTimeout(function () {
        $("#preload").css("display","none");
      }, 500);
    }
  });
});
