(function ($) {

  Drupal.behaviors.vn_setReferer = {
    attach: function (context, settings) {
       
       (jQuery).ajax({
            
                url: '/referer', 
                data: {
                        op: 'set',
                        url: window.location.href,
                        referer: document.referrer
                       
                      }, 
                    type: 'POST', 
                    dataType: 'json'
                    /*
                    , 
                    success: function(data) 
                            { 
                                if(!data.error) {
                                    console.log('The header is arrived!');
                                }
                                return false;
                            } 
                     */
            }); // end of (jQuery).ajax
        



       
    }
  };

}(jQuery));
