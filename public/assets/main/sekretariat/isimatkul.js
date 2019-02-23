$(document).ready(function() {
  console.log("Isi Matkul Runnning . . .");
  table_main = $("#main").DataTable({
    ajax:base_url+"sekretariat/readisimatkul"
  });
});
