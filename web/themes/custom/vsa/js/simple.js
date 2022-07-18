jQuery(document).ready(function() {

    jQuery(function() {
        jQuery("a[class='vedio-play']").click(function() {
            jQuery("#vsaModal").modal("show");
            return false;
        });
    });
    jQuery(".close").click(function() {
        jQuery("#vsaModal").modal("hide");
    });
    jQuery('.view-legal-dictionary .view-header ul li a').each(function() {
        if (jQuery(this).attr('href') === window.location.pathname) {
            jQuery(this).parents('li').addClass('active-trail');
            jQuery(this).addClass('active');
        }
    });
    if (jQuery(window).width() < 768) {
        jQuery("#block-socialicon").insertAfter(jQuery(".footer-top-right"));
    }

    jQuery("#back-to-top").click(function() {
        jQuery("html, body").animate({ scrollTop: 0 }, 3000);
    });

    jQuery(".question-answer-box .field--item").each(function() {
        jQuery(this).find('label').click(function() {
            jQuery('.question-answer-box .field--item').removeClass('selected');
            jQuery(this).parents('.field--item').addClass('selected');
        });
    });

    jQuery(".more-information b").click(function() {
        jQuery(".more-information .body-box").toggle();
    });

    jQuery(".more-information b").click(function() {
        jQuery(".more-information b").toggleClass('more-information abc');
    });


    jQuery(".question-answer-box .field--item").click(function() {
        jQuery('.btn-next.disabled').css('display', 'none');
        jQuery('.question-box .prev-next--button .btn-back').css('margin-right', '175px');
    });


    jQuery(".issue-option-content .field--item").each(function() {
        jQuery(this).find('.issue-form-wrapper').click(function() {
            jQuery('.issue-option-content .field--item').removeClass('selected');
            jQuery(this).parents('.field--item').addClass('selected');
        });
    });

    jQuery(".issue-option-content .field--item").click(function() {
        var nhref = jQuery('.field--item.selected .issue-form-wrapper .prev-next--button a').attr('href');
        jQuery('.top--prev-next--button a.btn-next').attr("href", nhref);
        jQuery('.top--prev-next--button a.btn-next').removeClass('disabled');
    });


    // left-sidebar-area
    var divCount = jQuery(".description-text ul:nth-child(2) li").length;
    jQuery(".description-text h3:first-child").append('<span class="div-count">' + divCount + '</span>');
    jQuery(".description-text h3:first-child strong").click(function() {
        jQuery(".description-text ul:nth-child(2)").toggle();
        jQuery(".description-text h3:first-child strong").toggleClass('downimg');
    });

    var divCountt = jQuery(".description-text ul:nth-child(4) li").length;
    jQuery(".description-text h3:nth-child(3)").append('<span class="div-count">' + divCountt + '</span>');
    jQuery(".description-text h3:nth-child(3) strong").click(function() {
        jQuery(".description-text ul:nth-child(4)").toggle();
        jQuery(".description-text h3:nth-child(3) strong").toggleClass('downimg');
    });

    jQuery('.left--sidebar--area .description-text ul li a').click(function() {
        jQuery(this).attr('target', '_blank');
    });

    jQuery(".like-dislike-box .like_dislike .like a").click(function() {
        jQuery(".like-dislike-box .like_dislike .dislike a").removeClass('likedown');
        jQuery(".like-dislike-box .like_dislike .like a").toggleClass('likeup');
    });
    jQuery(".like-dislike-box .like_dislike .dislike a").click(function() {
        jQuery(".like-dislike-box .like_dislike .like a").removeClass('likeup');
        jQuery(".like-dislike-box .like_dislike .dislike a").toggleClass('likedown');
    });



    // My Self-Help - Issue Resolution Options

    // jQuery(".option-content .field--item").each(function() {
    //     jQuery(this).find('.issue-form-wrapper').click(function() {
    //         jQuery('.option-content .field--item').removeClass('selected');
    //         jQuery(this).parents('.option-content .field--item').addClass('selected');
    //     });
    // });


});


/**
 * Recaptcha bug fix with ajax rendering form.
 */
(function($, Drupal) {
    Drupal.behaviors.recaptcha_ajax_behaviour = {
        attach: function(context, settings) {

            if (typeof grecaptcha != "undefined") {
                var captchas = document.getElementsByClassName('g-recaptcha');
                for (var i = 0; i < captchas.length; i++) {
                    var site_key = captchas[i].getAttribute('data-sitekey');
                    if (!$(captchas[i]).html()) {
                        grecaptcha.render(captchas[i], { 'sitekey': site_key });
                    }
                }
            }
            jQuery(document).ready(function() {
                jQuery('.option-content .field--item').each(function(index) {
                    jQuery(this).find('.issue-form-wrapper').once().click(function() {
                        jQuery('.option-content .field--item').removeClass('selected');
                        jQuery(this).parents('.option-content .field--item').addClass('selected');
                    });
                });
            });

        }
    };
})(jQuery, Drupal);