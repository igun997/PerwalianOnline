<?php
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
function updatesetting(Request $req)
{
  if ($req->input("type") == "set") {
    $set = \SIAK\SettingModel::where(["meta_key"=>$req->key])->update(["meta_value"=>$req->value]);
  }else if($req->input("type") == "unset") {
    $set = \SIAK\SettingModel::where(["meta_key"=>$req->key])->update(["meta_value"=>$req->value]);
  }else {
    return (["status"=>0,"msg"=>"Command not Found"]);
  }
  if ($set) {
    return (["status"=>1,"msg"=>"Pengaturan Di Simpan"]);
  }else {
    return (["status"=>0,"msg"=>"Command not Found"]);
  }
}
?>
