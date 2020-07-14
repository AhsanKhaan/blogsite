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

    function SmoothScroll(element){
	    $('html, body').animate({
	        scrollTop: $(element).offset().top
	    }, 200);
    }


	   $('#vendorform').submit(function(e){
        e.preventDefault();
        var vendor_name = $.trim($('#vendor_name').val());
        if($.trim(vendor_name) == ''){
           $('.vendorname-group').addClass('animated ' + 'bounce').one('animationend oAnimationEnd webkitAnimationEnd mozAnimationEnd', function() {
           $(this).removeClass('animated ' + 'bounce')});
           $('.vendorname-group input').css('border-color', 'red');
            ShowHideSpinner();
            SmoothScroll('.vendorname-group');
            return false;
         }else{
           $('.vendorname-group input').css('border-color', '#dbe1e8');
            // for ( instance in CKEDITOR.instances ){
            //    CKEDITOR.instances[instance].updateElement();
            //  }
            $.ajax({
                url: SendURL + "admin/back/Vendor_Setting.php",
                method:"POST",
                data: new FormData($('#vendorform')[0]),
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
                     window.location = SendURL + 'admin/vendor.php';
                    return false;
                  }
                }
            })
        }
    });

     function SendStatus(value, action, vendor_id){
         $.ajax({
           url:SendURL + "admin/back/Vendor_Setting.php",
           method:"POST",
           data:{value:value, action:action, vendor_id:vendor_id},
           success:function(data){
              loadNotification ('success', 'metroui', "Status Has Been Changed Successfully" , 3000);
           }
         });
     }
     $(document).on('change', '.status', function(){
       var value = $(this).is(":checked") ? 1 : 0;
       var vendor_id = $(this).data("vendor_id");
       SendStatus(value, 'Status', vendor_id);
     });  
    
     $(document).on('change', '.display_status', function(){
       var value = $(this).is(":checked") ? 1 : 0;
       var vendor_id = $(this).data('vendor_id');
       SendStatus(value, 'HomeStatus', vendor_id);
     });  

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
                  url:SendURL + "admin/back/Vendor_Setting.php",
                  method:"POST",
                  data:{vendorids:CheckedValue, action:"DeleteBulkRecord"},
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

     $(document).on('click', '.deletevendor', function(){
       var value = $(this).data('vendor_id');
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
            url:SendURL + "admin/back/Vendor_Setting.php",
            method:"POST",
            data:{vendorid:value, action:"DeleteSingleRecord"},
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