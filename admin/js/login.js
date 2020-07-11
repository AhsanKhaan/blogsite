$(function(){
    var SendURL = $('#url').val();


    function loadNotification (type, theme, message, time){
      $.getScript( SendURL + "admin/js/notification.js" )
      .done(function(script, textStatus ) {
        noty(type, theme, message, time);
      })
      .fail(function( jqxhr, settings, exception ) {
      });
    }


    


    function ShowHideSpinner(time = ''){
        var setTime = $.trim(time) == '' ? 1000 : time;
      $('.spinner').css('display', 'inline-block');
      setTimeout(function(){
          $('.spinner').css('display', 'none');
      }, setTime);
    }

 



    $('#loginform').submit(function(e){
        e.preventDefault();
        var email = $.trim($('#email').val());
        var password = $.trim($('#password').val());
        if($.trim(email) == ''){
           $('.email-group').addClass('animated ' + 'bounce').one('animationend oAnimationEnd webkitAnimationEnd mozAnimationEnd', function() {
           $(this).removeClass('animated ' + 'bounce')});
           $('.email-group input, .email-group span').css('border-color', 'red');
           $('.email-group').find('.input-group-text').css('border-color', 'red');
            ShowHideSpinner();
            return false;
        }else if($.trim(password) == ''){
           $('.password-group').addClass('animated ' + 'bounce').one('animationend oAnimationEnd webkitAnimationEnd mozAnimationEnd', function() {
           $(this).removeClass('animated ' + 'bounce')});
           $('.password-group input, .password-group span').css('border-color', 'red');
           $('.email-group input, .email-group span').css('border-color', '#dbe1e8');
           $('.email-group').find('.input-group-text').css('border-color', '#dbe1e8');
           $('.password-group').find('.input-group-text').css('border-color', 'red');
            ShowHideSpinner();
            return false;
        }else{
           $('.password-group input, .password-group span').css('border-color', '#dbe1e8');
           $('.password-group').find('.input-group-text').css('border-color', '#dbe1e8');
            $.ajax({
                url: SendURL + "admin/back/Authorize.php",
                method:"POST",
                data:$(this).serialize(),
                beforeSend:function(){
                  $('.spinner').css('display', 'inline-block');
                },
                success:function(data){
                  $('.spinner').css('display', 'none');
                  if($.trim(data) != 'success'){
                    loadNotification ('error', 'metroui', data , 3000);
                  }else{
                    window.location = SendURL + 'admin/dashboard.php';
                  }
                }
            })
        }
    });
})