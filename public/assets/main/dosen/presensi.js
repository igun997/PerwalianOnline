$(document).ready(function() {
  console.log("presensi.js");
  var topik = "";
  var id_kelas = "";
  var id_presensi = "";
  var pertemuan_ins = "";
  $("#box_result").find("#hadir_semua").on('click',function(event) {
    event.preventDefault();
    $("#box_result").find(".opsi").each(function(index, el) {
      $(this).val("H").trigger("change");
      toastr.info("Semua Di Hadirkan");
    });
  });
  $("#box_result").find("#tidak_hadir").on('click',function(event) {
    event.preventDefault();
    $("#box_result").find(".opsi").each(function(index, el) {
      $(this).val("A").trigger("change");
      toastr.info("Semua Tidak Hadir");
    });
  });
  $("#box_result").find("#stoppoint").on('click',function(event) {
    event.preventDefault();
    if (confirm("Apakah Anda Yakin ?")) {

      up = post(base_url+"dosen/upcheckpoint",{pertemuan_ke:pertemuan_ins,id_presensi:id_presensi});
      if (up.status == 1) {
        dform ="";
        n = 0;
        $("#box_result").find(".opsi").each(function(index, el) {
          id_user = $(this).data("id");
          dform += "#id_presensi-"+id_presensi+"|id_user-"+id_user+"|presensi-"+$(this).val();
        });
        console.log(dform);
        ins = post(base_url+"dosen/stoppoint",{q:dform});
        if (ins.status == 1) {
          toastr.success(ins.msg);
          setTimeout(function () {
            location.reload();
          }, 1000);
        }else {
          toastr.error(ins.msg);
        }
      }else {
        toastr.error(ins.msg);
      }
    }
  });
  $("#box_result").find("#checkpoint").on('click',function(event) {
    event.preventDefault();
    topik = $("#box_result").find("#topik_bahasan").val();
    console.log(topik);
    check = post(base_url+"dosen/checkpoint",{topik_pembahasan:topik,id_kelas:id_kelas});
    if (check.status == 1) {
      toastr.success("Sukses Membuat Checkpoint");
      id_presensi = check.id;
      $(this).attr('disabled', true);
    }else {
      toastr.error("Gagal Membuat Checkpoint");
    }
  });
  $("#box_result").find("#total_pertemuan").on('click', '.pertemuan', function(event) {
    event.preventDefault();
    ke = $(this).data("ke");
    id = $(this).data("id");
    pertemuan_ins = ke;
    getpeserta = post(base_url+"dosen/getpeserta",{id_kelas:id,pertemuan_ke:ke});
    if (getpeserta.status == 1) {
      table = [];
      for (var i = 0; i < getpeserta.data.length; i++) {
        console.log(getpeserta.data[i].td);
          table[i] = "<tr><td>"+getpeserta.data[i].no+"</td><td>"+getpeserta.data[i].nim+"</td><td>"+getpeserta.data[i].nama_lengkap+"</td><td>"+getpeserta.data[i].semester+"</td>"+getpeserta.data[i].td+"<td>"+getpeserta.data[i].aksi+"</td></tr>";
      }
      $("#content_table").html(table.join(""));
    }else {
      toastr.error("Terputus Dari Server");
    }
  });
  $(".absen").on('click', function(event) {
    event.preventDefault();
    id = $(this).data("id");
    console.log(id);
    id_kelas = id;
    $("#box_result").css("display","none");
    $("#preload").css("display","block");
    location.href = "#preload";
    get = post(base_url+"dosen/getabsen",{id_kelas:id});
    if (get.status == 1) {
      $("#box_result").find("#pertemuan_terakhir").html(get.data.pertemuan_terakhir);
      $build = [];
      $("#kehadiran_kolom").attr("colspan",get.data.total_pertemuan);
      for (var i = 1; i <= get.data.total_pertemuan; i++) {
        $build[i] = "<button class='btn btn-default pertemuan' data-id='"+id+"' data-ke='"+i+"'>"+i+"</button>";
      }
      $("#total_pertemuan").html($build.join(""));
      setTimeout(function () {
        $("#preload").css("display","none");
        $("#box_result").css("display","block");
      }, 1500);

    }else {
       setTimeout(function () {
         $("#preload").css("display","none");
         toastr.error("Terputus Dengan Server");
       }, 1500);
    }
  });
});
