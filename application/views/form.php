    <!-- Модальное окно -->
    <div id="registryModal" class="modal fade" role="dialog" tabindex="-1">
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
            <?php echo validation_errors(); ?>
            <?php $attributes = array('class' => 'form-horizontal'); ?>
            <?php echo form_open('registry/index', $attributes); ?>
              <!-- Блок для ввода логина --> 
              <div class="control-group">
                <label for="login" class="control-label col-xs-3">Логин:</label>
                <div class="controls">
                  <input type="text" class="form-control" required="required" id="login" name="login" placeholder="<?php echo set_value('login'); ?>"> <!-- pattern="[A-Za-z]{6,}"-->
                  <?php  echo form_error('login'); ?>
                </div>
              </div>
              <!-- Блок для ввода email -->
              <div class="control-group">
                <label for="email" class="control-label col-xs-3">Email:</label>
                <div class="controls">
                  <input type="email" class="form-control" required="required" id="email" name="email" placeholder="<?php echo set_value('email'); ?>">
                  <?php  echo form_error('email'); ?>
                </div>
              </div>
              <!-- Конец блока для ввода email-->
              <div class="control-group">
                <label for="password" class="control-label col-xs-3">Пароль:</label>
                <div class="controls">
                  <input type="password" class="form-control" required="required" id="password" name="password">
                </div>
                <?php  echo form_error('password'); ?>
              </div>
              <div class="control-group">
                <label for="passwordconfirm" class="control-label col-xs-3">Подтвердите пароль:</label>
                <div class="controls">
                  <input type="password" class="form-control" required="required" id="password_confirm" name="password_confirm">
                </div>
                <?php  echo form_error('password_confirm'); ?>
              </div>
              <div>
                <input type="submit" class="btn btn-primary pull-right btn-primary" name="submit" value="Зарегестрироваться"/>
              </div>
            </form>
            <!--конец формы-->

          </div>
        </div>

      </div>
    </div>