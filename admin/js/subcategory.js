$(function(){
   var SendURL = $('#url').val();
   function loadNotification (type, theme, message, time){
      $.getScript( SendURL + "admin/assets/js/notification.js" )
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

    function SmoothScroll(element){
	    $('html, body').animate({
	        scrollTop: $(element).offset().top
	    }, 200);
    }


	   $('#subcategoryform').submit(function(e){
        e.preventDefault();
        var cat_name = $.trim($('.categorySelect').val());
        var subcat_name = $.trim($('#subcat_name').val());
        if($.trim(cat_name) == ''){
           $('.category-group').addClass('animated ' + 'bounce').one('animationend oAnimationEnd webkitAnimationEnd mozAnimationEnd', function() {
           $(this).removeClass('animated ' + 'bounce')});
           $('.category-group select, .category-group a').css('border', '1px solid red');
            ShowHideSpinner();
            SmoothScroll('.category-group');
            return false;
         }else if ($.trim(subcat_name) == ''){
           $('.category-group select, .category-group a').css('border', '1px solid #dbe1e8');
           $('.subcatname-group').addClass('animated ' + 'bounce').one('animationend oAnimationEnd webkitAnimationEnd mozAnimationEnd', function() {
           $(this).removeClass('animated ' + 'bounce')});
           $('.subcatname-group input').css('border-color', 'red');
           ShowHideSpinner();
           SmoothScroll('.subcatname-group');
           return false;
         }else{
           $('.subcatname-group input').css('border-color', '#dbe1e8');
            // for ( instance in CKEDITOR.instances ){
            //    CKEDITOR.instances[instance].updateElement();
            //  }
            $.ajax({
                url: SendURL + "admin/back/SubCategory_Setting.php",
                method:"POST",
                data: new FormData($('#subcategoryform')[0]),
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                  $('.spinner').css('display', 'inline-block');
                },
                success:function(data){
                  $('.spinner').css('display', 'none');
                  if($.trim(data) != 'success'){
                    loadNotification ('error', 'metroui', data , 3000);
                    return false;
                  }else{
                    window.location = SendURL + 'admin/subcategories.php';
                    return false;
                  }
                }
            })
        }
    });

     function SendStatus(value, action, subcat_id){
         $.ajax({
           url:SendURL + "admin/back/SubCategory_Setting.php",
           method:"POST",
           data:{value:value, action:action, subcat_id:subcat_id},
           success:function(data){
              loadNotification ('success', 'metroui', "Status Has Been Changed Successfully" , 3000);
           }
         });
     }

     $(document).on('change', '.status', function(){
       var value = $(this).is(":checked") ? 1 : 0;
       var subcat_id = $(this).data('subcat_id');
       SendStatus(value, 'Status', subcat_id);
     });  
    

     $(document).on('change', '.categorySelect', function(){
       var CategoryValue = $.trim($(this).val());
       if(CategoryValue != ''){
         $('.subcategorybtn').prop('disabled', false);
       }else{
         $('.subcategorybtn').prop('disabled', true);
       }
    });  

     var CategoryValue = $.trim($('.categorySelect').val());
     if(CategoryValue != ''){
       $('.subcategorybtn').prop('disabled', false);
     }else{
       $('.subcategorybtn').prop('disabled', true);
     }

     $('.allcheckbox').click(function(){
       if($(this).is(':checked')){
         $('.colcheckbox').prop('checked', true);
         $('.deleteall').fadeIn();
       }else{
         $('.colcheckbox').prop('checked', false);
         $('.deleteall').fadeOut();
       }
     });


     $('.colcheckbox').click(function(){
       if($('.colcheckbox').is(':checked')){
         $('.deleteall').fadeIn();
       }else{
         $('.deleteall').fadeOut();
       }
     });
       
       $(document).on('click', '.deleteall', function(){
       var length = $('[name="colcheckbox[]"]:checked').length;
       if(length > 0){
         var CheckedValue = [];
         $('[name="colcheckbox[]"]:checked').each(function(i){
           CheckedValue.push($(this).val());
         });

          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
             if (result.value) {
                $.ajax({
                  url:SendURL + "admin/back/SubCategory_Setting.php",
                  method:"POST",
                  data:{subcatids:CheckedValue, action:"DeleteBulkRecord"},
                  success:function(data){
                    if($.trim(data) != 'success'){
                       loadNotification ('error', 'metroui', data , 3000);
                       setTimeout(function(){
                          location.reload();
                        }, 3500);
                       return false;
                    }else{
                      if (result.value) {
                        Swal.fire(
                          'Deleted!',
                          'Record Has Been Deleted.',
                          'success'
                        )
                      }
                    }
                    setTimeout(function(){
                      location.reload();
                    }, 3500);

                  }
                });
             }
          });
       }else{
         loadNotification ('error', 'metroui', "Please Select Atleast One Record" , 3000);
         return false;
       }
     });  


     $(document).on('click', '.deletesubcategory', function(){
       var value = $(this).data('subcat_id');
       var element = $(this);
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
           $.ajax({
            url:SendURL + "admin/back/SubCategory_Setting.php",
            method:"POST",
            data:{subcatid:value, action:"DeleteSingleRecord"},
            success:function(data){
              if($.trim(data) != 'success'){
                loadNotification ('error', 'metroui', data , 3000);
                return false;
              }else{
                if (result.value) {
                  Swal.fire(
                    'Deleted!',
                    'Record Has Been Deleted.',
                    'success'
                  )
                }
                element.parent().parent().parent().slideUp();
              }
            }
          });
        }
      });
     });  
})