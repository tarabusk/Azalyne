/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        $('body').on('added_to_cart',function(e,data) { alert ('llllffll');
        /*
          if ($('#hidden_cart').length == 0) { //add cart contents only once
          $(this).append('<a href="#TB_inline?width=300&height=250&inlineId=hidden_cart" id="show_hidden_cart" title="<h2>Cart</h2>" class="thickbox" style="display:none"></a>');

          // Some customization:
          var s = '';
          s += '<div class="widget_shopping_cart_content">';
          s += '<p>';
          s += '<h4>Product added to chart</h4>';
          s += '</p>';
          s += '<p class="buttons">';
          s += '	<a href="" onclick="javascript:tb_remove();return false;" class="button wc-forward">Continue Shopping</a>';
          s += '	<a href="/store/checkout/" class="button checkout wc-forward">Checkout</a>';
          s += '</p>';
          s += '</div>';

          $(this).append('<div id="hidden_cart" style="display:none">'+s+'</div>');

          }
          $('#show_hidden_cart').click();
          */
        });

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
