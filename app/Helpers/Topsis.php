<?php
namespace Helpers;
/**
 *
 */
class Topsis
{
  public $bobot;
  public $alt;
  public $sample;
  function __construct()
  {

  }
  public function setKriteria($v)
  {
    $this->bobot = $v;
  }
  public function setAlternatif($v)
  {
    $this->alt = $v;
  }
  public function setData($v)
  {
    $this->sample = $v;
  }
  public function run()
  {
    $c = 0;
    $r = [];
    foreach ($this->sample as $key => $value) {
      $rs = [];
      foreach ($value as $k => $v) {
        $col = $v;
        $sqrt = 0;
        foreach ($value as $ky => $vy) {
          $sqrt += pow($vy,2);
        }
        $rs[] = $col/sqrt($sqrt);
      }
      $r[] = $rs;
    }
    // Y
    $y = [];
    foreach ($r as $key => $value) {
      $rs = [];
      foreach ($value as $k => $v) {
        $rs[] = $this->bobot[$key]["bobot"]*$v;
      }
      $y[] = $rs;
    }
    $min = $max = [];
    //-- melakukan iterasi utk setiap kriteria
    $tsy = array_map(null, ...$y);
    $minmax = [];
    $minmax["min"] = [];
    $minmax["max"] = [];
    foreach ($y as $key => $value) {
      $minmax["min"][] = min($value);
      $minmax["max"][] = max($value);
    }
    $dplus = [];
    $dplus["min"] = [];
    $dplus["max"] = [];
    foreach ($tsy as $key => $value) {
      $powmax = [];
      $powmin = [];
      foreach ($value as $k => $v) {
        $powmax[] = pow($minmax["max"][$k] - $v,2);
        $powmin[] = pow($minmax["min"][$k] - $v,2);
      }
      $dplus["max"][] = sqrt(array_sum($powmax));
      $dplus["min"][] = sqrt(array_sum($powmin));
    }
    //V
    $v = [];
    foreach ($dplus["min"] as $key => $value) {
       $v[] = ["nama"=>$this->alt[$key],"nilai"=>$value/($dplus["max"][$key]+$value)];
    }
    return $v;
  }
}
