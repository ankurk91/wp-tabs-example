(function (window, jQuery) {
    'use strict';
    
    jQuery(function ($) {

        var $tabs = $('h2#wpt-tabs'),
            $sections = $('section.tab-content');
        
        $tabs.find('a.nav-tab').on('click.wptab', (function (e) {
            e.stopPropagation();
            // Hide all tabs
            $tabs.find('a.nav-tab').removeClass('nav-tab-active');
            $sections.removeClass('active');
            // Activate only clicked tab
            var sectionId = $(this).attr('id').replace('-tab', '');
            $('#' + sectionId).addClass('active');
            $(this).addClass('nav-tab-active');
        }));

    });
})(window, jQuery);