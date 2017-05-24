
// Optimaal Digitaal tabs-functions.js
// ----------------------------------------------------------------------------------
// dit script zorgt de tab-mogelijkheid op de filterpagina
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.5.19
// @desc.   Caroussel voor tipkaarten op filterpagina
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme


// =========================================================================================================


function doTabs(document, window, $, undefined) {
    'use strict';

    var $tabWidget = $('.js-tab-widget');

    var setupTabs = function($tab, $allTabs, $tabPanels, $tabListItems, i) {
        $tab
            .attr({
                'id': 'tab-link-' + i,
                'tabindex': '-1',
                'role': 'tab',
                'aria-selected': 'false',
                'aria-controls': 'tab-panel-' + i
            });

        if (i === 0) {
            $tab
                .attr({
                    'tabindex': '0',
                    'aria-selected': 'true',
                    'aria-describedby': 'tab-widget-description'
                })
                .addClass('tab-widget__link--active')
                .removeClass('tab-widget__link--not-yet-activated');
        }

        $tab.on('click', function(e) {
            e.preventDefault();

            tabClick($(this),  $allTabs, $tabPanels, i);
        });
      
        $tab.on('focus', function(e) {
            tabClick($(this),  $allTabs, $tabPanels, i);
        });

        $tab.on('keydown', function (e) {
            tabKeydown($(this), $allTabs, $tabPanels, $tabListItems, i, e);
        });
    };

    var setupTabPanels = function(tabPanel, i) {
        tabPanel
            .attr({
                'id': 'tab-panel-' + i,
                'role': 'tabpanel',
                'aria-hidden': 'true',
                'aria-labelledby': 'tab-link-' + i
            });

        if (i === 0) {
            tabPanel
                .attr('aria-hidden', 'false')
                .addClass('tab-widget__tab-content--active');
        }
    };

    var tabClick = function($thisTab, $allTabs, $tabPanels, i) {
        $allTabs
            .attr({
                'tabindex': -1,
                'aria-selected': 'false'
            })
            .removeAttr('aria-describedby')
            .removeClass('tab-widget__link--active');

        $thisTab
            .attr({
                'tabindex': 0,
                'aria-selected': 'true',
                'aria-describedby': 'tab-widget-description'
            })
            .addClass('tab-widget__link--active');

        $tabPanels
            .attr('aria-hidden', 'true')
            .removeClass('tab-widget__tab-content--active');

        $tabPanels.eq(i)
            .attr('aria-hidden', 'false')
            .addClass('tab-widget__tab-content--active');
    };

    var tabKeydown = function($thisTab, $allTabs, $tabPanels, $tabListItems, i, e) {
        var keyCode = e.which,
            $nextTab = $thisTab.parent().next().is('li') ? $thisTab.parent().next().find('a') : false,
            $previousTab = $thisTab.parent().prev().is('li') ? $thisTab.parent().prev().find('a') : false,
            $firstTab = $thisTab.parent().parent().find('li:first').find('a'),
            $lastTab = $thisTab.parent().parent().find('li:last').find('a');

        switch(keyCode) {
            // Left/Up
            case 37:
            case 38:
                e.preventDefault();
                e.stopPropagation();

                if (!$previousTab) {
                    $lastTab.focus();
                } else {
                    $previousTab.focus();
                }

                break;

            // Right/Down
            case 39:
            case 40:
                e.preventDefault();
                e.stopPropagation();

                if (!$nextTab) {
                    $firstTab.focus();
                } else {
                    $nextTab.focus();
                }

                break;

            // Home
            case 36:
                e.preventDefault();
                e.stopPropagation();

                $firstTab.focus();

                break;

            // End
            case 35:
                e.preventDefault();
                e.stopPropagation();

                $lastTab.focus();

                break;

            // Enter/Space
            case 13:
            case 32:
                e.preventDefault();
                e.stopPropagation();

                break;
        }
    };

    $tabWidget.each(function () {
        var $this = $(this),
            $tabList = $this.find('> ul'),
            $tabListItems = $tabList.find('li'),
            $allTabs = $tabListItems.find('a'),
            $tabPanels = $this.find('> div > div');

        $tabList.attr('role', 'tablist');
        $tabListItems.attr('role', 'presentation');

        $allTabs.each(function (i) {
            setupTabs($(this), $allTabs, $tabPanels, $tabListItems, i);
        });

        $tabPanels.each(function (i) {
            setupTabPanels($(this), i);
        });
    });


}


// =========================================================================================================


// media query change
function WidthChange(mq) {



	if (mq.matches) {
		// window width is at least 600px
//		console.log('toon tabs');
		doTabs(document, window, jQuery);
		
	}
	else {
		// window width is less than 600px
//		console.log('verberg tabs');
	}


}

// =========================================================================================================

// media query event handler
if (matchMedia) {
	var mq = window.matchMedia('(min-width: 600px)');
	mq.addListener(WidthChange);
	WidthChange(mq);
}

