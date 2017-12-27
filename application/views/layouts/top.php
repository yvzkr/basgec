<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="Teknoplan" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="Teknoplan" content="" />
  <meta name="author" content="" />
  <!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <![endif]-->
  <title>Teknoplan Mühendislik </title>
  <!-- BOOTSTRAP CORE STYLE  -->
  <link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONT AWESOME ICONS  -->
  <link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLE  -->

  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" />
  <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->



</head>
<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php
            if($this->session->user['id']){
          ?>
          <strong>Email: </strong><?=$this->session->user['email']?>
          &nbsp;&nbsp;
          <a href="<?=base_url()?>home/logout" class="btn btn-danger btn-sm">Logout</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER END-->
  <div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!– Buraya Logo getirebiliriz –>
      </div>

      <div class="left-div">
        <div class="user-settings-wrapper">
          <ul class="nav">

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
              </a>

            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- LOGO HEADER END-->
  <section class="menu-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="navbar-collapse collapse ">
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <?php
                  if($this->session->user['id']){
              ?>
              <li><a href="<?= base_url('/departments/')?>">Departman</a></li>
              <li><a href="<?= base_url('/personels/')?>">Personel Bilgileri</a></li>
              <li><a href="<?= base_url('/cards/')?>">Kart Bilgileri</a></li>
              <li><a href="<?= base_url('/card_activities/')?>">Günlük giriş çıkış</a></li>
              <li><a href="<?= base_url('/job_rotations/')?>">Vardiya</a></li>
              <li><a href="<?= base_url('/personel_activities/')?>">Personel Aktiviteleri</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Arşivlenmiş Kayıtlar
                <span class="caret"></span></a></a>
                  <ul style="background-color: #3d3d3d ;" class="dropdown-menu" >
                    <li><a href="<?= base_url('/archive_personels/')?>">Personel</a><li>
                    <li><a href="<?= base_url('/archive_cards/')?>">Kart Bilgileri</a><li>
                    <li><a href="<?= base_url('/archive_card_activities/')?>">Kart Aktivite</a><li>
                    <li><a href="<?= base_url('/archive_personel_activities/')?>">Personel Aktivite</a><li>
                  </ul>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- MENU SECTION END-->
  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">


          <h1 class="page-head-line">
            <?= $title ?>
            <?php if( isset( $model_name ) ){ ?>
              <a href="<?= current_url() ?>/new" class="btn btn-default pull-right">
                <i class="fa fa-plus" ></i>
                Yeni <?= $model_name ?> Ekle
              </a>
            <?php } ?>
          </h1>
        </div>
      </div>
      <?php if( $this->session->flashdata("danger") ){ ?>
      <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata("danger") ?>
      </div>
      <?php } ?>
