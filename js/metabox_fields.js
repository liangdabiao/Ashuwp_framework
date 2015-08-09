/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 2.2
**/

jQuery(document).ready(function(){
  var ashu_upload_frame;
  var value_id;
  jQuery('.ashu_upload_button').live('click',function(event){
    value_id =jQuery( this ).attr('id');
    event.preventDefault();
    if( ashu_upload_frame ){
      ashu_upload_frame.open();
      return;
    }
    
    ashu_upload_frame = wp.media({
      title: 'Insert image',
      button: {
        text: 'Insert',
      },
      multiple: false
    });
    
    ashu_upload_frame.on('select',function(){
      attachment = ashu_upload_frame.state().get('selection').first().toJSON();
      //jQuery('#'+value_id+'_input').val(attachment.url).trigger('change');
      jQuery('input[name='+value_id+']').val(attachment.url).trigger('change');
    });
    
    ashu_upload_frame.open();
	
	});
	
	jQuery('.ashuwp_url_input').each(function(){
	  jQuery(this).bind('change focus blur', function(){
	    $select = '#' + jQuery(this).attr('name') + '_div';
      $value = jQuery(this).val();
      if($value){
        var index1=$value.lastIndexOf('.');
        var index2=$value.length;
        var file_type=$value.substring(index1,index2);
        if(jQuery.inArray(file_type,['.png','.jpg','.gif','.bmp'])!='-1'){
          $file_view = '<img src ="'+$value+'" />';
        }else{
          $file_view = '<img src ="'+ashu_file_view.file_png+'" />';
        }
        jQuery($select).html('').append($file_view);
      }
	  });
	});
});