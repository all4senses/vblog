function tracking(url){
  console.log('track - ' + url);
}
       
(function ($) {

  Drupal.behaviors.vb_trackOldLinks = {
    attach: function (context, settings) {

       tracking('xxx');
       
//       function tracking(url){
//         console.log('track - ' + url);
//       }
       
    }
  };

}(jQuery));
