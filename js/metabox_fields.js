/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 3.0
**/
jQuery(document).ready(function($){
  var upload_frame,
      gallery_frame,
      value_id;
      
  $('.ashu_upload_button').on( 'click', function( event ){
    
    event.preventDefault();
    
    value_id =$( this ).attr('id');
    
    if(upload_frame){
      upload_frame.open();
      return;
    }
    
    upload_frame = wp.media({
      title: 'Insert image',
      button: {
        text: 'Insert'
      },
      multiple: false
    });
    
    upload_frame.on('select',function(){
      var attachment = upload_frame.state().get('selection').first().toJSON();
      //$('#'+value_id+'_input').val(attachment.url).trigger('change');
      $('input[name='+value_id+']').val(attachment.url).trigger('change');
    });
    
    upload_frame.open();
    
  });
  
  $('.ashuwp_url_input').each(function(){
    $(this).on('change focus blur', function(){
      $select = '#' + $(this).attr('name') + '_div';
      $value = $(this).val();
      if($value){
        var index1=$value.lastIndexOf('.');
        var index2=$value.length;
        var file_type=$value.substring(index1,index2);
        if($.inArray(file_type,['.png','.jpg','.gif','.bmp'])!='-1'){
          $file_view = '<img src ="'+$value+'" />';
        }else{
          $file_view = '<img src ="'+ashu_file_view.file_png+'" />';
        }
        $($select).html('').append($file_view);
      }
    });
  });
  
  $('.gallery_container').on('click', 'a.add_gallery', function(event){
    event.preventDefault();
    
    gallery_input = $(this).parent().find('.gallery_input');
    gallery_view = $(this).parent().find('.gallery_view');
    attachment_ids = gallery_input.val();
    
    if( gallery_frame ){
      gallery_frame.open();
      return;
    }
    
    gallery_frame = wp.media({
      title: 'Add to gallary',
      button: {
        text: 'Add to gallary'
      },
      multiple: true
    });
    
    gallery_frame.on('select', function(){
      var selection = gallery_frame.state().get('selection');
      selection.map( function( attachment ){
        attachment = attachment.toJSON();

        if ( attachment.id ) {
          attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
          gallery_view.append('<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment.url + '" /><ul class="actions"><li><a href="#" class="delete" title="Delete image">Delete</a></li></ul></li>');
        }
      });
      
      gallery_input.val(attachment_ids);
      
    });
    
    gallery_frame.open();
    
  });
  
  $('.gallery_container').on('click', 'a.delete', function(event){
    
    gallery_container = $(this).closest('.gallery_container');
    
    $(this).closest('li.image').remove();
    
    var attachment_ids = '';
    gallery_container.find('li.image').css('cursor','default').each(function() {
      var attachment_id = $(this).attr( 'data-attachment_id' );
        attachment_ids = attachment_ids + attachment_id + ',';
    });
    
    gallery_container.find('.gallery_input').val( attachment_ids );
    
    return false;
  });
  
  $('.gallery_view').sortable({
    items: 'li.image',
    cursor: 'move',
    scrollSensitivity:40,
    forcePlaceholderSize: true,
    forceHelperSize: false,
    helper: 'clone',
    opacity: 0.65,
    placeholder: 'wc-metabox-sortable-placeholder',
    start:function(event,ui){
      ui.item.css('background-color','#f6f6f6');
    },
    stop:function(event,ui){
      ui.item.removeAttr('style');
    },
    update: function(event, ui) {
      var attachment_ids = '';
      $(this).find('li.image').css('cursor','default').each(function() {
        var attachment_id = $(this).attr( 'data-attachment_id' );
            attachment_ids = attachment_ids + attachment_id + ',';
      });
      $(this).parent().find('.gallery_input').val( attachment_ids );
    }
  });
});

/* ========================================================================
 * Bootstrap: tab.js v3.3.5
 * http://getbootstrap.com/javascript/#tabs
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // TAB CLASS DEFINITION
  // ====================

  var Tab = function (element) {
    // jscs:disable requireDollarBeforejQueryAssignment
    this.element = $(element)
    // jscs:enable requireDollarBeforejQueryAssignment
  }

  Tab.VERSION = '3.3.5'

  Tab.TRANSITION_DURATION = 150

  Tab.prototype.show = function () {
    var $this    = this.element
    var $ul      = $this.closest('ul:not(.dropdown-menu)')
    var selector = $this.data('target')

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
    }

    if ($this.parent('li').hasClass('active')) return

    var $previous = $ul.find('.active:last a')
    var hideEvent = $.Event('hide.bs.tab', {
      relatedTarget: $this[0]
    })
    var showEvent = $.Event('show.bs.tab', {
      relatedTarget: $previous[0]
    })

    $previous.trigger(hideEvent)
    $this.trigger(showEvent)

    if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) return

    var $target = $(selector)

    this.activate($this.closest('li'), $ul)
    this.activate($target, $target.parent(), function () {
      $previous.trigger({
        type: 'hidden.bs.tab',
        relatedTarget: $this[0]
      })
      $this.trigger({
        type: 'shown.bs.tab',
        relatedTarget: $previous[0]
      })
    })
  }

  Tab.prototype.activate = function (element, container, callback) {
    var $active    = container.find('> .active')
    var transition = callback
      && $.support.transition
      && ($active.length && $active.hasClass('fade') || !!container.find('> .fade').length)

    function next() {
      $active
        .removeClass('active')
        .find('> .dropdown-menu > .active')
          .removeClass('active')
        .end()
        .find('[data-toggle="tab"]')
          .attr('aria-expanded', false)

      element
        .addClass('active')
        .find('[data-toggle="tab"]')
          .attr('aria-expanded', true)

      if (transition) {
        element[0].offsetWidth // reflow for transition
        element.addClass('in')
      } else {
        element.removeClass('fade')
      }

      if (element.parent('.dropdown-menu').length) {
        element
          .closest('li.dropdown')
            .addClass('active')
          .end()
          .find('[data-toggle="tab"]')
            .attr('aria-expanded', true)
      }

      callback && callback()
    }

    $active.length && transition ?
      $active
        .one('bsTransitionEnd', next)
        .emulateTransitionEnd(Tab.TRANSITION_DURATION) :
      next()

    $active.removeClass('in')
  }


  // TAB PLUGIN DEFINITION
  // =====================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data('bs.tab')

      if (!data) $this.data('bs.tab', (data = new Tab(this)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.tab

  $.fn.tab             = Plugin
  $.fn.tab.Constructor = Tab


  // TAB NO CONFLICT
  // ===============

  $.fn.tab.noConflict = function () {
    $.fn.tab = old
    return this
  }


  // TAB DATA-API
  // ============

  var clickHandler = function (e) {
    e.preventDefault()
    Plugin.call($(this), 'show')
  }

  $(document)
    .on('click.bs.tab.data-api', '[data-toggle="tab"]', clickHandler)
    .on('click.bs.tab.data-api', '[data-toggle="pill"]', clickHandler)

}(jQuery);