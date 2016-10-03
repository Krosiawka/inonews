  var base_url = 'http://InoNews.ru';


  function call_comment(id) {
      var msg   = $('#form_comment').serialize(); // Сеарилизуем объект
      var myurl = base_url + "index.php/comments/update/" + id.toString();
      //$('textarea#comment').val(urle);
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
    
    function set(id)
    {
 
       var text = $('p#'+ id).text();
   
       $('textarea#comment').val(text); //tmp
       $('#form_comment').attr('onsubmit',"call_comment(" + id + ")");
       $("#commentModal").modal('show');
    }


  $('#loginModal').on('hidden.bs.modal', function(event) { //выполнение действий при закрытии модального окна логина
    $('#errors_login').html('');
    $('#errors_restore').html('');
  });

    $('#registryModal').on('hidden.bs.modal', function(event) { //выполнение действий при закрытии модального окна регистрации
    $('#errors_registry').html(''); //отчистка ошибок
  });



  function call_login() {
      var msg   = $('#form_login').serialize(); // Сеарилизуем объект
      $.ajax({
          url:     base_url + 'index.php/login/index/1',
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



  function call_restore() {
      var msg   = $('#form_restore').serialize(); // Сеарилизуем объект
      $.ajax({
          url:     base_url + 'index.php/restore/restore/1',
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


  function call_registry() {
      var msg   = $('#form_registry').serialize(); // Сеарилизуем объект
      $.ajax({
          url:     base_url + 'index.php/registry/index',
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
