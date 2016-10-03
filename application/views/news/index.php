<?php foreach ($news as $news_item): ?>
          <div class="hero-unit" style="padding: 20px; margin-bottom: 10px;">
            <h2><?php echo $news_item['fc_title'] ?></h2>

            <div class="row-fluid">
            <?php $filename = 'images/thumbs/'.$news_item['fc_img']; ?>
            <?php if (file_exists($filename)): ?>
                <div class="span3">
                  <img class="img-rounded" src="/images/thumbs/<?php echo $news_item['fc_img'];?>" alt="">
                </div><!--/span-->
                <div class="span9">
            <?php else:?>
                <div class="span12">
            <?php endif; ?>
                  <p><?php echo mb_substr($news_item['ft_text'], 0, 250);?> ...</p>
                </div><!--/span-->
              </div><!--/row-->
              <div class="row-fluid"> <!-- -->
                <div class="span9">
                <!--Формирование подписи с датой, автором и колличеством комментариев -->
                  <p class="muted" style="font-size: 16px;"><em><?php echo $news_item['fd_date'] ?> | <a href="<?php echo base_url().'index.php/writer_articles/'.$news_item['fn_iduser']?>"><?php echo $news_item['fc_surename_writer'];?> <?php echo $news_item['fc_name_writer'];?> </a> | <?php if ($news_item['fn_count_comments'] == 0) echo 'Нет коментариев'; else echo 'Комментариев ('.$news_item['fn_count_comments'].')'; ?></em></p>
                </div><!--/span-->
                <div class="span3">
                  <p><a href="<?php echo base_url(); ?>index.php/article/<?php echo $news_item['fk_id']?>" class="btn btn-primary pull-right">Подробнее...</a></p>
                </div><!--/span-->
              </div><!--/row-->
          </div><!--/hero-unit-->
<?php endforeach; ?>
<?php echo $this->pagination->create_links(); ?>
  