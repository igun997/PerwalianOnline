$(document).ready(function() {
  console.log("Login Runn . .");
  $("#login").on('submit',function(event) {
    event.preventDefault();
    dform = $(this).serializeArray();
    cek = post(base_url+"/masuk",dform);
    if (cek.status == 1) {
      toastr.success(cek.msg);
      setTimeout(function () {
        location.href = base_url+"/"+cek.level;
      }, 1000);
    }else {
      toastr.error(cek.msg);
    }
  });
});
