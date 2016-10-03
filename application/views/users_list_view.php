<h2>Список пользователей</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Пользователь</th>
      <th>Роль</th>
      <th>Статус</th>
      <th></th>
    </tr>
  </thead>
  <tbody>  
<?php foreach ($users as $user_item): ?> 
  <?php if ($user_item['fb_block']): ?><!--выбор цвета строки в зависимотси от статуса пользователя-->
    <tr class="error">
  <?php else: ?>
    <tr class="success">
  <?php endif; ?>

    <td><?php echo $user_item['fc_login'] ?></td>
    <td><?php if ($user_item['fb_superuser'] == TRUE) echo 'Администратор' ?></td>
    <?php if ($user_item['fb_block']): ?>
      <td >Заблокирован</td>
      <td><a href="<?php echo base_url().'index.php/block/index/'.$user_item['fk_id'].'/0'?>" class="btn btn-success pull-right">Разблокировать</a></td>
    <?php else: ?>
      <td>Разблокирован</td>
      <td><a href="<?php echo base_url().'index.php/block/index/'.$user_item['fk_id'].'/1'?>" class="btn btn-danger pull-right">Заблокировать&nbsp;</a></td>
    <?php endif; ?>
  </tr>  
<?php endforeach; ?>

</tbody>
</table>