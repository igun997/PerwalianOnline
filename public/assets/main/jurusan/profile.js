$(document).ready(function() {
  console.log("profile.js Running .. ");
  $("#save").on('submit', function(event) {
    event.preventDefault();
    dform = $(this).serializeArray();
    up = post(base_url+"jurusan/upprofile",dform);
    if (up.status == 1) {
      toastr.success(up.msg);
      setTimeout(function () {
        location.reload();
      }, 1000);
    }else {
      toastr.error(up.msg);
    }
  });
});
