<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>InoNews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link href="/css/bootstrap.css" rel="stylesheet">-->


    <style type="text/css">body{padding-top:60px;padding-bottom:40px;min-width: 1100px;}.sidebar-nav{padding:9px 0;}</style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="/css/bootstrap.css" rel="stylesheet" media="screen">

  </head>
  <body>

    <!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
    <script type="text/javascript" src="/js/jquery-3.1.0.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!--<script src="/js/myAjax.js"></script>-->

    <div class="navbar navbar-inverse navbar-fixed-top" >
      <div class="navbar-inner">
        <div class="container-fluid">
          <?php if ($admin == TRUE): ?>
          <a class="brand" href="<?php echo base_url()."index.php/writer_articles/".$id; ?>">InoNews</a>
          <?php endif; ?>
          <div class="nav-collapse">
            <?php if (isset($login)): ?>
            <p class="navbar-text pull-right">
              &nbsp;&nbsp;Здравствуйте, <?php echo $login; ?> <a href="<?php echo base_url(); ?>index.php/login/log_out" class="navbar-link">Выйти</a>
            </p>
            <?php endif; ?>
            <form class="navbar-search pull-right" action="<?php echo base_url(); ?>index.php/search" method="POST">
              <input type="text" class="search-query" placeholder="Поиск" name="search">
            </form>
            <ul class="nav">
              <li><a href="<?php echo base_url(); ?>">Главная</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/about">О сайте</a></li>
              <?php if (!isset($login)): ?>
              <!--<li><a href="<?php //echo base_url(); ?>index.php/registry" data-toggle="modal">Регистрация</a></li>-->
              <li><a href="#" data-toggle="modal" data-target="#registryModal" class="navbar-link">Регистрация</a></li>
              <!--<li><a href="<?php //echo base_url(); ?>index.php/login" class="navbar-link">Войти</a></li>-->
              <li><a href="#" data-toggle="modal" data-target="#loginModal" class="navbar-link">Войти</a></li>
              <?php endif; ?>
              <?php if ($admin == TRUE): ?>
              <li><a href="<?php echo base_url(); ?>index.php/users_list" data-toggle="modal">Пользователи</a></li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <!--Начало body -->
    <div class="container-fluid"> <!-- -->
      <div class="row-fluid"> <!-- -->
        <div class="span3"> <!--firs row-->
          <!--firs sidebar -->
          <?php if ($admin == TRUE): ?>
          <div class="well sidebar-nav">
            <p><a href="<?php echo base_url() ?>index.php/add_article" class="btn btn-primary btn-block">Добавить статью</a></p>
          </div> <!--End firs sidebar -->
          <?php endif; ?>
          <!--Second sidebar -->
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Последние статьи</li>
              <?php foreach ($last_article as $article_item): ?>
              <li><a href="<?php echo base_url().'index.php/article/'.$article_item['fk_id'] ?>">&#9679; <?php echo $article_item['fc_title'] ?></a></li>
              <?php endforeach; ?>
            </ul><!-- end first list-->
          </div><!--/span--><!--End firs sidebar -->
          <!--Third sidebar-->
          <?php if ($admin == TRUE): ?>
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Топ авторов</li>
              <?php foreach ($writers as $writer_item): ?>
              <li><a href="<?php echo base_url().'index.php/writer_articles/'. $writer_item['fk_id'] ?>"><?php echo $writer_item['fc_surename'].' '.$writer_item['fc_name']; ?> (<?php echo $writer_item['fn_count_article']; ?>)</a></li>
              <?php endforeach; ?>
<!--              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
-->           </ul>
          </div> <!--End third sidebar -->
          <?php endif; ?>
        </div> <!--End first row -->
        <!-- Start second row -->
        <div class="span9">


