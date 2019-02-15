<?php
function datatablesConvert($res=[],$select="")
{
  $data = [];
  $data["data"] = [];
  foreach ($res as $key => $value) {
    $inner = [];
    $exp = explode(",",$select);
    foreach ($exp as $k => $v) {
      $inner[] = $value["$v"];
    }
    $data["data"][] = $inner;
  }
  return $data;
}
function select2Convert($data=[],$op=[])
{
  $s = [];
  $s[] = ["text"=>"== Pilih ==","id"=>""];
  foreach ($data as $key => $value) {
    $s[] = ["text"=>$value[$op["text"]],"id"=>$value[$op["id"]]];
  }
  return $s;
}
