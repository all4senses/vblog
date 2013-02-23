(function ($) {

  Drupal.behaviors.vb_SendMsgNnewsletterSubscr_fieldHints = {
    attach: function (context, settings) {
      
      //$('#block-vb_blocks-send_msg_n_subscribe input[id="edit-fname"], #block-vb_blocks-send_msg_n_subscribe input[id="edit-lname"], #block-vb_blocks-send_msg_n_subscribe input[id="edit-email"], #block-vb_blocks-send_msg_n_subscribe textarea[id="edit-message"]').each(function(){
      $('#block-vb-blocks-send-msg-n-subscribe input[id="edit-fname"], #block-vb-blocks-send-msg-n-subscribe input[id="edit-lname"], #block-vb-blocks-send-msg-n-subscribe input[id="edit-email"], #block-vb-blocks-send-msg-n-subscribe textarea[id="edit-message"]').each(function(){
        if ($(this).val() == '') {
          $(this).val($(this).attr('title'));
          $(this).addClass('blur');
        }
        else if ($(this).val() == $(this).attr('title')) {
          $(this).addClass('blur');
        }
      });
      
      //$('#block-vb_blocks-send_msg_n_subscribe input[id="edit-fname"], #block-vb_blocks-send_msg_n_subscribe input[id="edit-lname"], #block-vb_blocks-send_msg_n_subscribe input[id="edit-email"], #block-vb_blocks-send_msg_n_subscribe textarea[id="edit-message"]').focus(function(){
      $('#block-vb-blocks-send-msg-n-subscribe input[id="edit-fname"], #block-vb-blocks-send-msg-n-subscribe input[id="edit-lname"], #block-vb-blocks-send-msg-n-subscribe input[id="edit-email"], #block-vb-blocks-send-msg-n-subscribe textarea[id="edit-message"]').focus(function(){        
        if ($(this).val() == $(this).attr('title')) {
          $(this).val('');
          $(this).removeClass('blur');
        }
        
      });
      
      //$('#block-vb_blocks-send_msg_n_subscribe input[id="edit-fname"], #block-vb_blocks-send_msg_n_subscribe input[id="edit-lname"], #block-vb_blocks-send_msg_n_subscribe input[id="edit-email"], #block-vb_blocks-send_msg_n_subscribe textarea[id="edit-message"]').blur(function(){
      $('#block-vb-blocks-send-msg-n-subscribe input[id="edit-fname"], #block-vb-blocks-send-msg-n-subscribe input[id="edit-lname"], #block-vb-blocks-send-msg-n-subscribe input[id="edit-email"], #block-vb-blocks-send-msg-n-subscribe textarea[id="edit-message"]').blur(function(){
        
        if ($(this).val() == '') {
          $(this).val($(this).attr('title'));
          $(this).addClass('blur');
        }
        
      });
      
    }
  };

}(jQuery));