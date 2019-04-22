<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h4 align="center">Lembar Registrasi Peserta</h4>
    <hr>
    <h5>Data Peserta</h5>
    <p align="center">
      <img style="width:auto;height:200px" src="data:image/jpg;base64,{{base64_encode(file_get_contents(url($data->foto_burung)))}}" alt="">
    </p>
    <p>Nomor Gantangan : {{$data->no_gantangan}}</p>
    <p>Nama : {{$data->users->nama}}</p>
    <p>Alamat : {{$data->users->alamat}}</p>
    <p>Nomor HP : {{$data->users->hp}}</p>
    <p>Email : {{$data->users->email}}</p>
    <h5>Data Event</h5>
    <hr>
    <p>Nama Event  : {{$data->event->nama}}</p>
    <p>Kelas  : {{$data->event->kelas->nama}}</p>
    <p>Tanggal Event  : {{$data->event->tanggal}}</p>
  </body>
</html>
