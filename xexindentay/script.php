<?php defined('APP_PATH') or die(); ?>
<script>
jQuery(function($) {

    var api = {
        caches: {},
        lang: '',
        csrf: '',
        recaptcha: {
            key: '',
            token: ''
        },
        init: function() {
            this.lang = $('html').attr('lang') || '';
            this.csrf = $('meta[name="csrf"]').attr('content') || '';
            this.start_form();
        },
        request: function(route, data, callback) {
            if ($('body').hasClass('process')) return;

            $('body').addClass('process');

            let url = '/api' + route;

            if (this.lang == 'en') {
                url += (url.indexOf('?') > -1 ? '&' : '?') + 'lang=en';
            }

            let type = 'POST';

            let timeout = setTimeout(function() {
                $('body').removeClass('process');
            }, 30000);

            if (data == null || Object.getOwnPropertyNames(data).length == 0) {
                type = 'GET';
            } else {
                data.csrf = this.csrf;
                data['g-recaptcha-response'] = this.recaptcha.token;
            }

            $.ajax({
                type: type,
                url: url,
                headers: this.get_headers(),
                data: data,
                dataType: 'json'
            }).done(function(response) {
                if (typeof callback == 'function') {
                    callback(response);
                }
            }).always(function() {
                clearTimeout(timeout);
                $('body').removeClass('process');
            });
        },
        get_headers: function() {
            let headers = {},
                token = this.get_cookie('lot_token');

            if (token != '') {
                headers.token = token;
            }

            return headers;
        },
        get_cookie: function(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },
        set_cookie: function(name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        },
        show_fancybox_message: function(message) {
            if (this.lang == 'vi') {
                var translates = {
                    'Loading': 'Đang xử lý'
                };

                if (translates[message]) {
                    message = translates[message];
                }
            }

            this.show_fancybox_error(message);
        },
        show_fancybox_error: function(errors) {
            if (typeof errors == 'undefined') return;
            if (typeof errors != 'object') errors = [errors];

            if (errors.length > 0 && typeof $.fancybox != 'undefined') {
                let popup = $('.js-popup-error');
                // $(window).scrollTop(0);

                if (popup.length == 0) {
                    return alert(errors.join("\n"));
                } else if ($('.popup-title', popup).length > 0) {
                    $('.popup-title', popup).html(errors.join('<br>'));
                } else {
                    $('.content', popup).html(errors.join('<br>'));
                }

                $.fancybox({
                    'padding': 0,
                    content: popup
                });
            }
        },
        show_modal: function(selector, callback) {
            $(selector).each(function() {
                const p = $(this);

                $('html, body').css({
                    overflow: 'hidden'
                });

                if (typeof callback == 'string') {
                    p.find('.message').html(callback);
                } else if (typeof callback == 'function') {
                    p.each(callback);
                }

                p.addClass('active');
            });
        },
        hide_modal: function(selector, callback) {
            $(selector).each(function() {
                const p = $(this);

                $('html, body').css({
                    overflow: ''
                });

                if (typeof callback == 'string') {
                    p.find('.message').html(callback);
                } else if (typeof callback == 'function') {
                    p.each(callback);
                }

                p.removeClass('active');
            });
        },
        start_form: function() {

            var player = false;

            if (typeof lottie == 'object') {
                $('.play__lucky').each(function() {
                    var p = $(this),
                        src = p.attr('data-src') || '';
                    if (src == '') return;

                    p.removeAttr('data-src');
                    p.find('img').hide();

                    player = lottie.loadAnimation({
                        container: this,
                        renderer: 'svg',
                        loop: true,
                        autoplay: false,
                        path: src
                    });
                });
            }

            $(document).on('click', '.js-btn-welcome', function(e) {
                $(this).addClass('disabled');

                $.fancybox({
                    'padding': 0,
                    content: $('#box-lucky-welcome')
                });
            });

            $(document).on('click', '.js-btn-play', function(e) {
                e.preventDefault();

                var btn = $(this);

                if (btn.hasClass('disabled')) return;
                btn.addClass('disabled');

                api.show_fancybox_message('Loading');

                // return testing();

                api.request('/must-buy/xexindentay', {
                    t: (new Date()).getTime()
                }, function(response) {
                    var message = '';

                    if (response.code == 200) {
                        var callback = function() {
                            $(this).find('.js-phone').text(response.data.phone || 'error');
                            $(this).find('.js-code').text(response.data.code || 'error');
                        }

                        $.fancybox.close();

                        $('html, body').animate({
                            scrollTop: $('.play__button').offset().top - $('header').height()
                        }, 500, function() {
                            if (typeof player == 'object') {
                                player.play();

                                setTimeout(function() {
                                    player.pause();

                                    api.show_modal('#modal-lucky', callback);
                                }, 5000);
                            } else {
                                setTimeout(function() {
                                    api.show_modal('#modal-lucky', callback);
                                }, 3000);
                            }
                        });

                        return;
                    } else if (typeof response.error == 'string') {
                        message = response.error;
                    } else {
                        message = response.message;
                    }

                    btn.removeClass('disabled');
                    api.show_fancybox_error(message);
                });

                setTimeout(function() {
                    btn.removeClass('disabled');
                }, 30000);
            });

            function testing() {
                setTimeout(function() {
                    var callback = function() {
                        $(this).find('.js-phone').text('0931' + parseInt(Math.random() * 10000000));
                        $(this).find('.js-code').text(parseInt(Math.random() * 10000000));
                    };

                    $.fancybox.close();

                    $('html, body').animate({
                        scrollTop: $('.play__button').offset().top - $('header').height()
                    }, 500, function() {
                        if (typeof player == 'object') {
                            player.play();

                            setTimeout(function() {
                                player.pause();

                                api.show_modal('#modal-lucky', callback);
                            }, 5000);
                        } else {
                            setTimeout(function() {
                                api.show_modal('#modal-lucky', callback);
                            }, 3000);
                        }
                    });
                }, 3000);
            }
        },
        get_recaptcha_response: function() {
            let item = $('script[src*="/recaptcha/api"]')
            if (item.length == 0) return;

            let key = item.attr('src').split('render=')[1] || null;
            if (key != null) {
                api.recaptcha.key = key;

                grecaptcha.ready(function() {
                    grecaptcha.execute(key, {
                        action: 'submit'
                    }).then(function(token) {
                        // Add your logic to submit to your backend server here.

                        api.recaptcha.token = token;
                    });
                });
            }
        }
    };

    /** API init */
    api.init();

    $(window).on('load', function() {
        api.get_recaptcha_response();
    });
});
</script>