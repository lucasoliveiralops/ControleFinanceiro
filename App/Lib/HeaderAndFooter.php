<?php

namespace App\Lib;

class HeaderAndFooter
{
  private static $instance;
  private  $title, $moduleSyle = array(), $moduleJS = array();
  public static function getInstanse()
  {
    if (self::$instance == null) {
      self::$instance = new HeaderAndFooter();
    }
    return self::$instance;
  }

  public function setTitle($title)
  {
    $this->title = $title . ' | ' . NAME_APP;
  }

  public function getTitle()
  {
    return !empty($this->title) ? $this->title : NAME_APP;
  }

  public function addJs($link, $external = false)
  {
    if ($external) {
      $this->moduleJS[] = '<script src="' . $link . '"></script>';
    }
    $this->moduleJS[] = '<script src="view/assets/js/' . $link . '.js"></script>';
  }

  public function getScripts($local = 'header')
  {
    $out = '';
    if ($local == 'header') {
    }
    if ($local == 'footer') {
      $out .= '<script src="view/assets/js/plugins/jquery-1-11.js"></script>';
      $out .= '<script src="view/assets/js/plugins/bootstrap.js"></script>';
      $out .= '<script src="view/assets/js/main.js"></script>';
      $out .= '<script src="view/assets/js/plugins/sweetalert2.js"></script>';
      $out .= '<script src="view/assets/js/plugins/select2.js"></script>';
      $out .= '<script src="view/assets/js/plugins/dataTable.js"></script>';
      if (!empty($this->moduleJS)) {
        foreach ($this->moduleJS as $js) {
          $out .= $js;
        }
        $this->moduleJS = array();
      }
    }
    return $out;
  }

  private function getDefaultStyles()
  {
    $out = '';
    $out .= '<link rel="stylesheet" href="view/assets/css/main.css">';
    $out .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">    ';
    $out .= '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />';
    $out .= '<link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />';
    return $out;
  }
  public function addStyle($link, $external = false)
  {
    if ($external) {
      $this->moduleStyle[] = '<link rel="stylesheet" href="' . $link . '">';
    }
    $this->moduleStyle[] = '<link rel="stylesheet" href="view/assets/css/' . $link . '.css">';
  }
  public function getStyles()
  {
    $out = '';
    if (!empty($this->moduleStyle)) {
      foreach ($this->moduleStyle as $style) {
        $out .= $style;
      }
      $this->moduleStyle = array();
    }
    $out .= self::getDefaultStyles();
    return $out;
  }
}
