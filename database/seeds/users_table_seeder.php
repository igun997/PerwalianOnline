<?php

use Illuminate\Database\Seeder;

class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = new \SIAK\JurusanModel;
        $jurusan->nama_jurusan = "Sistem Informasi";
        $jurusan->status_jurusan = "aktif";
        $jurusan->save();
        $obj = new \SIAK\UsersModel;
        $obj1 = new \SIAK\UsersModel;
        $obj2 = new \SIAK\UsersModel;
        $obj3 = new \SIAK\UsersModel;
        $obj4 = new \SIAK\UsersModel;
        $obj->nama_lengkap = "Indra Gunanda";
        $obj->username = "10515211";
        $obj->password = md5("10515211");
        $obj->jk = "laki-laki";
        $obj->email = "indra.gunanda@gmail.com";
        $obj->alamat = "Banjar";
        $obj->no_hp = "081214267695";
        $obj->level = "mhs";
        $obj->id_jurusan = 1;
        $obj->status_absen = "ya";
        $obj->hapus = "tidak";
        $obj->save();
        $obj1->nama_lengkap = "Andri Gunanda";
        $obj1->username = "admin";
        $obj1->password = md5("admin");
        $obj1->jk = "laki-laki";
        $obj1->email = "andri.gunanda@gmail.com";
        $obj1->alamat = "Banjar";
        $obj1->no_hp = "081214267691";
        $obj1->level = "admin";
        $obj1->hapus = "tidak";
        $obj1->save();
        $obj2->nama_lengkap = "Andri Gunanda";
        $obj2->username = "jurusan";
        $obj2->password = md5("jurusan");
        $obj2->jk = "laki-laki";
        $obj2->id_jurusan = 1;
        $obj2->email = "andr.gunanda@gmail.com";
        $obj2->alamat = "Banjar";
        $obj2->no_hp = "081224267691";
        $obj2->level = "jurusan";
        $obj2->hapus = "tidak";
        $obj2->save();
        $obj3->nama_lengkap = "sekretariat";
        $obj3->username = "sekretariat";
        $obj3->password = md5("sekretariat");
        $obj3->jk = "laki-laki";
        $obj3->email = "sekretariat@gmail.com";
        $obj3->alamat = "Banjar";
        $obj3->id_jurusan = 1;
        $obj3->no_hp = "081224267661";
        $obj3->level = "sekretariat";
        $obj3->hapus = "tidak";
        $obj3->save();
        $obj4->nama_lengkap = "dosen";
        $obj4->username = "dosen";
        $obj4->password = md5("dosen");
        $obj4->jk = "laki-laki";
        $obj4->email = "dosen@gmail.com";
        $obj4->alamat = "Banjar";
        $obj4->id_jurusan = 1;
        $obj4->no_hp = "081224567661";
        $obj4->level = "dosen";
        $obj4->hapus = "tidak";
        $obj4->save();
    }
}
