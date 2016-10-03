
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/container-->

  </body>
  <?php if (!isset($login)): ?>
  <footer>

      <!-- Модальное окно -->
    <div id="registryModal" class="modal fade" aria-hidden="true" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <!-- Заголовок модального окна -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Регистрация</h4>
          </div>
          <!-- Основная часть модального окна, содержащая форму для регистрации -->
          <div class="modal-body">
            <!-- Форма для регистрации -->
            <!--<?php //$attributes = array('class' => 'form-horizontal'); ?>
            <?php //echo form_open('registry/index', $attributes); ?>-->
            <form method="POST" id="form_registry" action="javascript:void(null);" onsubmit="call_registry()" class = 'form-horizontal'>
              <!-- Блок для ввода логина -->
              <div class="control-group">
                <label for="login" class="control-label col-xs-3">Логин:</label>
                <div class="controls">
                  <input type="text" class="form-control" required="required" id="login" name="login" placeholder="<?php echo set_value('login'); ?>"> <!-- pattern="[A-Za-z]{6,}"-->
                  <div id="login"></div>
                </div>
              </div>
              <!-- Блок для ввода email -->
              <div class="control-group">
                <label for="email" class="control-label col-xs-3">Email:</label>
                <div class="controls">
                  <input type="email" class="form-control" required="required" id="email" name="email" placeholder="<?php echo set_value('email'); ?>">
                  <div id="email"></div>
                </div>
              </div>
              <!-- Блок для ввода пароля-->
              <div class="control-group">
                <label for="password" class="control-label col-xs-3">Пароль:</label>
                <div class="controls">
                  <input type="password" class="form-control" required="required" id="password" name="password">
                </div>
                <div id="password"></div>
              </div>
              <!-- Блок для ввода подтверждения пароля-->
              <div class="control-group">
                <label for="passwordconfirm" class="control-label col-xs-3">Подтвердите пароль:</label>
                <div class="controls">
                  <input type="password" class="form-control" required="required" id="password_confirm" name="password_confirm">
                </div>
                <div id="password_confirm"></div>
              </div>
              <div>
                <input type="submit" class="btn btn-primary pull-right btn-primary" name="submit" id="btn" value="Зарегестрироваться"/>
              </div>
            </form>
            <!--конец формы-->
          </div>
        </div>
        <div class="text-center" id="errors_registry"></div>
      </div>
    </div>

<script type="text/javascript" language="javascript">
  function call_registry() { //ajax регистрация
      var msg   = $('#form_registry').serialize(); // Сеарилизуем объект
      $.ajax({
          url:     "<?php echo base_url().'index.php/registry/index'; ?>",
          type:     "POST", //метод отправки
          dataType: "html", //формат данных
          data: msg,
          success: function(data) {
            $('#errors_registry').html(data);
          },
          error:  function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
          }
      });
  }
</script>

    <!-- Модальное окно логина-->
    <div id="loginModal" class="modal fade" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <!-- Заголовок модального окна -->
          <button type="button" class="close" data-dismiss="modal" style="margin-right: 15px; margin-top: 10px; ">&times;</button>
           <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#auth">Авторизация</a></li>
            <li><a data-toggle="tab" href="#restore">Забыли пароль?</a></li>
          </ul>
          <!-- Основная часть модального окна, содержащая форму для авторизации -->
          <div class="modal-body">
            <!-- Форма для авторизации -->
            <!--<?php //$attributes = array('class' => 'form-horizontal'); ?>
            <?php //echo form_open('registry/index', $attributes); ?>-->
            <div class="tab-content">
              <div id="auth" class="tab-pane fade in active">
                <form method="POST" id="form_login" action="javascript:void(null);" onsubmit="call_login()" class = 'form-horizontal'>
                  <!-- Блок для ввода логина -->
                  <div class="control-group">
                    <label for="login" class="control-label">Логин:</label>
                    <div class="controls">
                      <input type="text" class="form-control" required="required" id="login" name="login" placeholder=""> <!-- pattern="[A-Za-z]{6,}"-->
                      <div id="login"></div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label for="password" class="control-label">Пароль:</label>
                    <div class="controls">
                      <input type="password" class="form-control" required="required" id="password" name="password">
                    </div>
                  </div>
                  <div class="control-group">
                    <label for="remember" class="control-checkbox"></label>
                    <div class="controls">
                      <input type="checkbox" name="remember"> Запомнить меня
                    </div>
                  </div>
                  <div>
                    <input type="submit" class="btn btn-primary pull-right btn-primary" name="submit" id="btn" value="Войти"/>
                  </div>
                </form>
                <br />
                <br />
                <div class="text-center" id="errors_login"></div>
              </div><!--конец панели-->
              <div id="restore" class="tab-pane fade">
                <form method="POST" id="form_restore" action="javascript:void(null);" onsubmit="call_restore()" class = 'form-horizontal'>
                  <p class="text-center">На введенный вами адрес электронной почты будет отправленно письмо с сылкой на восстановление пароля</p>
                  <!-- Блок для ввода email -->
                  <div class="control-group">
                    <label for="login" class="control-label">Email:</label>
                    <div class="controls">
                      <input type="text" class="form-control" required="required" id="email" name="email" placeholder=""> <!-- pattern="[A-Za-z]{6,}"-->
                      <div id="login"></div>
                    </div>
                  </div>
                  <div>
                    <input type="submit" class="btn btn-primary pull-right btn-primary" name="submit" id="btn" value="Отправить письмо"/>
                  </div>
                </form>
                <br />
                <br />
                <div class="text-center" id="errors_restore"></div>
              </div>
            <!--конец панели-->
          </div>
        </div>

      </div>
      </div>
    </div>

<script type="text/javascript" language="javascript"> 
  $('#loginModal').on('hidden.bs.modal', function(event) { //выполнение действий при закрытии модального окна логина
    $('#errors_login').html('');
    $('#errors_restore').html('');
  });

    $('#registryModal').on('hidden.bs.modal', function(event) { //выполнение действий при закрытии модального окна регистрации
    $('#errors_registry').html(''); //отчистка ошибок
  });
</script>

<script type="text/javascript" language="javascript">
  function call_login() { //ajax регистрация
    var msg   = $('#form_login').serialize(); // Сеарилизуем объект
    $.ajax({
          url:     "<?php echo base_url().'index.php/login/index/1'; ?>",
          type:     "POST", //метод отправки
          dataType: "html", //формат данных
          data: msg,
          success: function(data) {
            $('#errors_login').html(data);
          },
          error:  function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
          }
    });
  }
</script>

<script type="text/javascript" language="javascript">
  function call_restore() { //ajax регистрация
      var msg   = $('#form_restore').serialize(); // Сеарилизуем объект
      $.ajax({
          url:     "<?php echo base_url().'index.php/restore/restore/1'; ?>",
          type:     "POST", //метод отправки
          dataType: "html", //формат данных
          data: msg,
          success: function(data) {
            $('#errors_restore').html(data);
          },
          error:  function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
          }
      });
  }
</script>

  </footer>
  <?php endif; ?>
</html>
