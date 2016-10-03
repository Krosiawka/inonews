
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/wp-content/themes/clear-theme/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/clear-theme/img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/clear-theme/img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/clear-theme/img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/wp-content/themes/clear-theme/img/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/wp-content/themes/clear-theme/img/favicon.png">


  </head>

  <body>

    <div class="container">
      <?php $attributes = array('class' => 'form-signin'); ?>
      <?php echo form_open('login/index', $attributes); ?>
        <h2 class="form-signin-heading">Авторизация</h2>
        <!--<div class="alert alert-error">
          <a class="close" href="#" data-dismiss="alert">Введены не верные данные</a>
        </div>
        -->
        <input type="text" class="input-block-level" required placeholder="Логин" name="login">
        <?php echo form_error('login');?>
        <?php if (isset($user)) echo $user;?>
        <?php if (isset($block)) echo $block;?>
        <input type="password" class="input-block-level" required placeholder="Пароль" name="password">
        <?php echo form_error('password');?>
        <?php if (isset($password)) echo $password;?>
        <label class="checkbox">
          <input type="checkbox" value="rememberme" name="remember"> Запомнить меня
        </label>
        <button class="btn btn-large btn-primary btn-block" type="submit">Войти</button>
        <div style="margin-top: 20px ">
        <p><a href="restore" >Забыли пароль?</a></p>
        </div>
      </form>



    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/wp-content/themes/clear-theme/js/jquery.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-transition.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-alert.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-modal.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-dropdown.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-scrollspy.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-tab.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-tooltip.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-popover.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-button.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-collapse.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-carousel.js"></script>
    <script src="/wp-content/themes/clear-theme/js/bootstrap-typeahead.js"></script>

  </body>
</html>
