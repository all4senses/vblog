(function ($) {

  Drupal.behaviors.vb_trackOldLinks = {
    attach: function (context, settings) {
       
       //$(".yt-direct").colorbox({iframe:true, innerWidth:425, innerHeight:344});

       function tracking(url){
         console.log('track - ' + url);
       }
       
    }
  };

}(jQuery));
