 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Восстановление пароля</title>
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
      .form-signin input[type="login"],
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
        <?php echo form_open($_SERVER['QUERY_STRING'], $attributes); ?>
        <h2 class="form-signin-heading">Смена пароля</h2>
        <p>Введите новый пароль</p>
        <input type="password" class="input-block-level" required="required" placeholder="Пароль" name="password">
        <?php echo form_error('password');?>
        
        <input type="password" class="input-block-level" required="required" placeholder="Подтверждение пароля" name="password_confirm">
        <?php echo form_error('password_confirm');?>
        <button class="btn btn-large btn-primary btn-block" type="submit">Готово</button>
      </form>

    </div> <!-- /container -->



  </body>
</html>
