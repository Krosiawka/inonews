          <style>
            textarea {
            width: 90%; /* Ширина поля в процентах */
            height: 200px; /* Высота поля в пикселах */
            resize: none; /* Запрещаем изменять размер */
            }
          </style>
<h1>Добавить новость</h1>

<div class="container-fluid">
	<?php $attributes = array('class' => 'form-horizontal', 'enctype' => "multipart/form-data"); ?>
	<?php echo form_open_multipart('news/add_article', $attributes); ?>
		<div class="control-group">
        	<label class="control-label"  for="title">Название статьи*:</label>
        	<div class="controls">

            	<input type="text" class="form-control" id="usr" name="title" style="width: 90%;" required="required" value="<?php echo set_value('title');?>">
                <?php  echo form_error('title'); ?>
            </div>
        </div>
            <div class="control-group">
        	    <label class="control-label" for="text">Текст статьи*:</label>
            	<div class="controls">
            		<textarea name="text" class="form-control" rows="15" cols="1000" required="required"><?php echo set_value('text');?></textarea>
                    <?php  echo form_error('text'); ?>
            	</div>
            </div>
            <p class="muted">Поля с * обязательны для заполнения!</p>
            <div class="control-group">
            	Изображение: <input type="file" name="userfile" />
            </div>
            <a href="<?php echo $_SERVER['HTTP_REFERER']?>" class="btn btn-danger pull-right">Отмена</a>
            <input type="submit" class="btn btn-primary pull-right btn-primary" value="Опубликовать"/>

	</form>
    <!--<input type="button" class="btn btn-danger pull-right btn-primary" value="Отмена"/>-->
</div>


