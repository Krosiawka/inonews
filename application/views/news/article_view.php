          <div class="hero-unit" style="padding: 20px; margin-bottom: 10px;">
            <h2><?php echo $news['fc_title']; ?></h2>
            <?php $filename = "images/".$news['fc_img']; ?>
            <?php if (file_exists($filename)): ?>
                <div class="row-fluid" style="text-align: center; margin-bottom: 20px; ">
                    <div class="span7" style="float: none; display: inline-block;">
                    <img src="/images/<?php echo $news['fc_img']; ?>" alt="">
                    </div>
                </div><!--/span-->
            <?php endif; ?>
            <div class="row-fluid"><!--<div class="span9">-->
                <p><?php echo $news['ft_text']; ?></p>
            </div><!--/span-->
            <br />

            <div class="row-fluid"> <!-- -->
                <p class="muted" style="font-size: 14px;"><em><?php echo $news['fd_date']; ?> | <a href="<?php echo base_url().'index.php/writer_articles/'.$news['fn_iduser']?>"><?php echo $news['fc_surename_writer'];?> <?php echo $news['fc_name_writer'];?> </a> |
                <?php if ($count == 0)  echo 'Нет коментариев'; else echo 'Комментариев ('.$count.")";?></em></p>

          <style>
            textarea {
            width: 98%; /* Ширина поля в процентах */
            height: 60px; /* Высота поля в пикселах */
            resize: none; /* Запрещаем изменять размер */
            }
          </style>

                <?php if ($checked): ?> <!-- Блок создания комментария-->
                <div class="hero-unit" style="padding: 10px; margin-bottom: 10px; background-color: #DCDCDC">
                    <?php $attributes = array('class' => 'form-horizontal', 'style' => " margin-bottom: 2px"); ?>
                    <?php echo form_open_multipart('article/'.$news['fk_id'], $attributes); ?>
                        <p style="height: 16px">Комментировать:</p>
                        <div class="row-fluid" style=" margin-bottom: 1px">
                                <textarea name="text" class="form-control" required="required"></textarea>
                                <?php  echo form_error('text'); ?>
                                <br />
                                <div style=" margin-top: 10px">
                                <input type="submit" class="btn btn-primary pull-right btn-small" value="Добавить"/>
                                </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>

                <?php foreach ($comments as $comment_item): ?> <!-- Комментарии к статье --> 
                   <!--блок комментариев -->
                <div class="hero-unit" style="padding: 10px; margin-bottom: 10px; background-color: #DCDCDC">
                    <div class="row-fluid">
                        <?php if (($admin == TRUE) or ($id == $comment_item['fn_iduser'])): ?>
                        <a href="<?php echo base_url()?>index.php/comments/delete/<?php echo $comment_item['fk_id']?>" class="btn btn-danger pull-right btn-mini">&times;</a>
                        <input type="submit" id="11" class="btn btn-success pull-right btn-mini" value="редактировать" onclick="set(<?php echo $comment_item['fk_id'] ?>)">
                        <?php endif; ?>
                        <p style="height: 16px"><?php echo $comment_item['fc_user'] ?>:</p>
                    </div>
                    <div class="row-fluid">
                        <p id="<?php echo $comment_item['fk_id'] ?>" style="font-size: 14px;"><?php echo $comment_item['ft_text'] ?></p>
                    </div>
                    <p class="muted" style="font-size: 12px;"><em><?php echo $comment_item['fd_date'] ?></em></p>
                </div>
                <?php endforeach; ?>
            </div><!--/row-->
          </div><!--/hero-unit-->

    <?php if($checked and ($count !== 0)): ?>
      <!-- Модальное окно -->
    <div id="commentModal" class="modal fade" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <!-- Заголовок модального окна -->
          <div class="modal-header">
            <h4 class="modal-title">Редактировать комментарий</h4>
          </div>
          <!-- Основная часть модального окна, содержащая форму для комментария -->
          <div class="modal-body">
            <!-- Форма для редактирования комментария -->
            <form method="POST" id="form_comment" action="javascript:void(null);"  class = 'form-horizontal'>
              <!-- Блок для ввода комментария -->
              <div class="control-group">
                  <textarea name="text" class="form-control" required="required" id="comment"></textarea><!-- pattern="[A-Za-z]{6,}"-->
              </div>
              <div>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Отмена</button>
                <input type="submit" class="btn btn-primary pull-right" value="Редактировать"/>
              </div>
            </form>
            <!--конец формы-->
          </div>
        </div>
        <div class="text-center" id="errors_comment"></div>
      </div>
    </div>

<script type="text/javascript" language="javascript">
  function call_comment(id) {
      var msg   = $('#form_comment').serialize(); // Сеарилизуем объект
      var myurl = "<?php echo base_url();?>" + "index.php/comments/update/" + id.toString();
      $.ajax({
          url:      myurl.toString(),
          type:     "POST", //метод отправки
          dataType: "html", //формат данных
          data: msg,
          success: function(data) {
            $('#errors_comment').html(data);
          },
          error:  function(xhr, str){
            alert('Возникла ошибка: ' + xhr.responseCode);
          }
      });
  }

    function set(id) {
       var text = $('p#'+ id).text();
       $('textarea#comment').val(text); //tmp
       $('#form_comment').attr('onsubmit',"call_comment(" + id + ")");
       $("#commentModal").modal('show');
    }

</script>
<?php endif; ?>