(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

})(jQuery);

function hilfeGuideShow() {
    hilfeResetScreen2();

    let objectScreen1 = document.getElementById('hilfe-guide-screen-1');
    objectScreen1.classList.remove('hilfe-d-none');

    let guideShow = document.getElementById('hilfe-guide-show');
    guideShow.classList.remove('hilfe-d-none');
    guideShow.classList.add('hilfe-d-block');

    let guideMini = document.getElementById('hilfe-guide-mini');
    guideMini.classList.add('hilfe-d-none');


}

function hilfeGuideClose() {
    hilfeResetScreen2();

    let objectScreen1 = document.getElementById('hilfe-guide-screen-1');
    objectScreen1.classList.remove('hilfe-d-none');

    let guideShow = document.getElementById('hilfe-guide-show');
    guideShow.classList.add('hilfe-d-none');
    guideShow.classList.remove('hilfe-d-block');

    let guideMini = document.getElementById('hilfe-guide-mini');
    guideMini.classList.remove('hilfe-d-none');
}

function hilfeGuideShowScreen2(idShow) {
    hilfeResetScreen2();

    let objectScreen2 = document.getElementById(idShow);
    objectScreen2.classList.remove('hilfe-d-none');

    let objectScreen1 = document.getElementById('hilfe-guide-screen-1');
    objectScreen1.classList.add('hilfe-d-none');
}

function hilfeGuideShowScreen1() {
    hilfeResetScreen2();

    let objectScreen1 = document.getElementById('hilfe-guide-screen-1');
    objectScreen1.classList.remove('hilfe-d-none');
}

function hilfeResetScreen2() {
    document.querySelectorAll('.hilfe-guide-screen-2-content').forEach(function(element) {
        element.classList.add('hilfe-d-none');
    });
}

// setTimeout(() => {
//     hilfeGuideShow();
// }, 500);