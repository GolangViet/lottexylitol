jQuery(function ($) {

    var api = {
        caches: {},
        lang: '',
        csrf: '',
        player: null,
        recaptcha: {
            key: '',
            token: ''
        },
        init: function () {
            this.lang = $('html').attr('lang') || '';
            this.csrf = $('meta[name="csrf"]').attr('content') || '';
            // this.lottie_icon();
            this.fill_blank();
            this.add_events();
            this.history();
        },
        request: function (route, data, callback) {
            if ($('body').hasClass('process')) return;

            $('body').addClass('process');

            let url = '/api' + route;

            if (this.lang == 'en') {
                url += (url.indexOf('?') > -1 ? '&' : '?') + 'lang=en';
            }

            let type = 'POST';

            let timeout = setTimeout(function () {
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
            }).done(function (response) {
                if (typeof callback == 'function') {
                    callback(response);
                }
            }).always(function () {
                clearTimeout(timeout);
                $('body').removeClass('process');
            });
        },
        get_headers: function () {
            let headers = {}, token = this.get_cookie('lot_token');

            if (token != '') {
                headers.token = token;
            }

            return headers;
        },
        get_cookie: function (name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },
        set_cookie: function (name, value, days) {
            let expires = "";
            if (days) {
                let date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        },
        get_data: function ($form, show_popup) {
            let data = {}, errors = [];

            $('[data-field]', $form).each(function () {
                let input = $(this), name = input.data('field'), value = '';

                if (typeof data[name] == 'undefined') {

                    if (input.attr('type') == 'radio') {
                        value = $('[data-field="' + name + '"]:checked', $form).val();
                    } else if (input.attr('type') == 'checkbox') {
                        $('[data-field="' + name + '"]:checked', $form).each(function () {
                            if (this.value != '') {
                                value += (value != '' ? ',' : '') + this.value;
                            }
                        });
                    } else {
                        value = input.val();

                        if (name == 'username') {
                            const regEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                            const pattern = '[0]{1}[1-9]{1}[0-9]{8}';
                            let error = '';

                            if (value.match(pattern) == null && value.match(regEmail) == null) {
                                error = input.data('pattern-error');
                                errors.push(error);
                                error = '<ul class="list-unstyled c-red"><li>' + error + '</li></ul>';
                            }

                            input.closest('.form-group').find('.with-errors').html(error);
                        }
                    }

                    if (input.attr('required') && (value == '' || input.closest('.has-error').length > 0)) {
                        errors.push(input.data('error') || name);

                        data[name] = '';
                    } else {
                        data[name] = value;
                    }
                }
            });

            if (show_popup) {
                this.show_fancybox_error(errors);
            }

            return errors.length == 0 ? data : false;
        },
        show_fancybox_message: function (message) {
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
        show_fancybox_error: function (errors, description) {
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

                if (typeof description == 'string') {
                    $('.content', popup).append(`<div class="popup-description">${description}</div>`);
                } else {
                    popup.find('.popup-description').remove();
                }

                $.fancybox({
                    'padding': 0,
                    content: popup
                });
            }
        },
        show_modal: function (selector, callback) {
            $(selector).each(function () {
                const p = $(this);

                $('html, body').css({ overflow: 'hidden' });

                if (typeof callback == 'string') {
                    p.find('.message').html(callback);
                } else if (typeof callback == 'function') {
                    p.each(callback);
                }

                p.addClass('active');
            });
        },
        hide_modal: function (selector, callback) {
            $(selector).each(function () {
                const p = $(this);

                $('html, body').css({ overflow: '' });

                if (typeof callback == 'string') {
                    p.find('.message').html(callback);
                } else if (typeof callback == 'function') {
                    p.each(callback);
                }

                p.removeClass('active');
            });
        },
        decodeUTF8: function (data) {
            const decode = decodeQueryParam(atob(data));

            if (btoa(encodeURIComponent(decode) === data)) {
                return decode;
            }

            return null;
        },
        fill_blank: function () {
            if (typeof $.fn.draggable == 'undefined') return;

            $("#fill-blank .js-answer-item").draggable({
                containment: "body",
                revert: true
            });
        },
        check_answers: function () {
            return $("#fill-blank .js-question-item").length == $('#fill-blank .js-question-item.selected').length;
        },
        action_player: function (event, action) {
            // var $target = $(event.target); // drag event
            var $target = $(event.target).closest(".js-answer-item");// use document event
            var targetOffset = {
                top: -1,
                left: -1,
            };
            var card = $('#fill-blank');

            if (event.type == 'mouseup') {
                targetOffset.left = event.clientX;
                targetOffset.top = event.clientY + $(window).scrollTop();
            } else if (event.type == 'dragstop') {
                targetOffset.left = event.clientX;
                targetOffset.top = event.clientY;
            } else if (event.type == 'touchend') {
                let touch = null;

                if (typeof event.touches != 'undefined') {
                    touch = event.touches[0];
                } else if (typeof event.changedTouches != 'undefined') {
                    touch = event.changedTouches[0];
                } else if (typeof event.originalEvent != 'undefined' && typeof event.originalEvent.changedTouches != 'undefined') {
                    touch = event.originalEvent.changedTouches[0];
                }

                if (typeof touch == 'object' && typeof touch.clientX != 'undefined') {
                    targetOffset.left = touch.clientX;
                    targetOffset.top = touch.clientY + $(window).scrollTop();
                }
            }

            if (targetOffset.left < 0 || targetOffset.top < 0) return;

            card.find(".js-question-item").each(function (i) {
                let item = $(this), itemOffset = item.offset();

                if (item.hasClass('selected')) return;

                itemOffset.height = item.height();
                itemOffset.width = item.width();

                let check = api.check_position_event(targetOffset, itemOffset);

                if (action == 'selected' && check) {
                    if ($target.data('value') == 'selected') {
                        item.html($target.text())
                            .addClass('selected')
                            .data('target', $target)
                            .attr('data-index', $target.data('index'));

                        $target.addClass('selected');
                    } else {
                        $target.addClass('disabled');

                        card.find('.row-error').show();

                        setTimeout(function () {
                            card.find('.row-error').hide();
                        }, 5000);
                    }

                    if ($target.hasClass('ui-draggable')) {
                        $target.draggable("option", "disabled", true);
                    }
                } else if (action == 'hover') {
                    item.toggleClass('hover', check);
                }
            });
        },
        check_position_event: function (eventOffset, itemOffset) {
            const left = itemOffset.left <= eventOffset.left && eventOffset.left <= itemOffset.left + itemOffset.width;
            const top = itemOffset.top <= eventOffset.top && eventOffset.top <= itemOffset.top + itemOffset.height;

            return left && top;
        },
        check_position: function (a, b) {
            // check a in b
            if (typeof a.width == 'undefined') a.width = a.left + 1;
            if (typeof a.height == 'undefined') a.height = a.top + 1;
            if (typeof b.width == 'undefined') b.width = b.left + 1;
            if (typeof b.height == 'undefined') b.height = b.top + 1;

            const left = b.left <= a.left && a.left <= b.left + b.width;
            const top = b.top <= a.top && a.top <= b.top + b.height;
            const right = b.left <= a.left + a.width && a.left + a.width <= b.left + b.width;
            const bottom = b.top <= a.top + a.height && a.top + a.height <= b.top + b.height;

            return (left && top) || (right && top) || (left && bottom) || (right && bottom);
        },
        add_events: function () {

            $(document).on(api.is_touch_device() ? 'touchend' : 'mouseup', ".js-answer-item", function (event) {
                api.action_player(event, 'selected');

                if (api.check_answers()) {
                    $('.group-answers').hide();
                    $('.group-results').show();

                    $('.group-questions .selected').each(function (i) {
                        let item = $(this);

                        if (item.data('index') != null) {
                            i = item.data('index');
                        }

                        $('.group-questions .value').eq(i).text(item.text()).addClass('txt-bold');
                    });
                }
            });

            $(document).on('click', '.js-step-lucky', function (e) {
                e.preventDefault();

                if (!api.check_answers()) return;

                var answers = $(this).data('value');

                api.submit_recaptcha(function () {
                    api.show_fancybox_message('Loading');

                    api.request('/must-buy/fill-blank', {
                        t: (new Date()).getTime(),
                        answers: answers
                    }, function (response) {
                        let message = '';

                        if (response.code == 200) {
                            $.fancybox.close();

                            $('.section-must-buy').removeClass('active');
                            $('#lucky').addClass('active');

                            return;
                        } else if (typeof response.error == 'string') {
                            message = response.error;

                            if (response.code == 401) {
                                return api.show_fancybox_error(response.error, error_expired);
                            }
                        } else {
                            message = response.message;
                        }

                        api.show_fancybox_error(message);
                    });
                });
            });

            $(document).on('click', '.js-box-close', function (e) {
                e.preventDefault();

                if ($(this).data('reset-code')) {
                    $('#inputcode').val('');
                }

                $.fancybox.close();
            });

            $(document).on('click', '.js-btn-start', function (e) {
                e.preventDefault();

                $.fancybox({
                    'padding': 0,
                    content: $('#box-start')
                });
            });

            $(document).on('click', '.js-btn-restart', function (e) {
                e.preventDefault();

                api.show_fancybox_message('Loading');

                $.get('?wrap=' + (new Date()).getTime() + 60, function (data) {
                    $.fancybox.close();
                    let wrap_html = $(`<div>${data}</div>`).find('#wrap').html();
                    if (wrap_html) {
                        $('#wrap').html(wrap_html).ready(function () {
                            api.lottie_icon();
                            api.fill_blank();

                            $('.modal-must-buy-lucky').each(function () {
                                api.hide_modal(this);
                            });

                            $('.section-must-buy').removeClass('active');
                            $('#start').addClass('active');
                            $('#modal-lucky .lucky-content').empty();

                            $('.js-btn-terms-submit').trigger('click');
                        });
                    }
                });
            });

            $(document).on('click', '.js-btn-lock', function (e) {
                e.preventDefault();

                $.fancybox({
                    'padding': 0,
                    content: $('#box-code-error')
                });
            });

            $(document).on('click', '.js-btn-terms', function (e) {
                e.preventDefault();

                api.show_terms();
            });

            $(document).on('click', '.js-btn-terms-submit', function (e) {
                e.preventDefault();

                let btn = $(this);

                $.fancybox.close();

                if (btn.data('modal') == 'code') {
                    $.fancybox({
                        'padding': 0,
                        content: $('#box-code')
                    });
                } else {
                    $('.section-must-buy').removeClass('active');
                    if (btn.data('step') == 'lucky') {
                        $('#lucky').addClass('active');
                    } else {
                        $('#fill-blank').addClass('active');
                    }
                }
            });

            $(document).on('click', '.js-btn-back-code', function (e) {
                e.preventDefault();

                $('.js-btn-terms-submit').trigger('click');
            });

            $(document).on('click', '.js-btn-play', function (e) {
                e.preventDefault();

                var btn = $(this);

                api.submit_recaptcha(function () {
                    if (btn.hasClass('disabled')) return;
                    btn.addClass('disabled');

                    api.show_fancybox_message('Loading');

                    api.request('/must-buy/lucky', {
                        t: (new Date()).getTime()
                    }, function (response) {
                        var message = '';

                        if (response.code == 200) {
                            var html = '';

                            if (typeof response.data == 'string' && response.data != '') {
                                html = api.decodeUTF8(response.data);
                            }

                            $.fancybox.close();

                            $('html, body').animate({
                                scrollTop: $('.play__button').offset().top - $('header').height()
                            }, 500, function () {
                                if (typeof api.player == 'object') {
                                    api.player.play();

                                    setTimeout(function () {
                                        api.player.pause();

                                        api.show_result(html);
                                    }, 5000);
                                } else {
                                    setTimeout(function () {
                                        api.show_result(html);
                                    }, 3000);
                                }
                            });

                            return;
                        } else if (typeof response.error == 'string') {
                            message = response.error;

                            if (response.code == 401) {
                                return api.show_fancybox_error(response.error, error_expired);
                            }
                        } else {
                            message = response.message;
                        }

                        btn.removeClass('disabled');
                        api.show_fancybox_error(message);
                    });

                    setTimeout(function () {
                        btn.removeClass('disabled');
                    }, 30000);
                });
            });

            $(document).on('click', '.js-term-form [type="submit"]', function (e) {
                e.preventDefault();

                let $form = $(this).closest('.js-term-form'), errors = [];

                $form.find('.checkbox').each(function () {
                    const label = $(this),
                        is_error = label.find('[type="checkbox"]:checked').length == 0;

                    if (is_error) {
                        errors.push(this);
                    }

                    label.toggleClass('error', is_error);
                });

                if (errors.length == 0) {
                    $form.trigger('reset');

                    $.fancybox.close();

                    if ($form.data('modal') == 'code') {
                        $.fancybox({
                            'padding': 0,
                            content: $('#box-code')
                        });
                    } else {
                        $('.section-must-buy').removeClass('active');
                        if ($form.data('step') == 'lucky') {
                            $('#lucky').addClass('active');
                        } else {
                            $('#fill-blank').addClass('active');
                        }
                    }
                }
            });

            $(document).on('submit', '.js-verify-code-form', function (e) {
                e.preventDefault();

                let $form = $(this);

                api.submit_recaptcha(function () {
                    let data = api.get_data($form);

                    if (data != false) {
                        api.show_fancybox_message('Loading');

                        api.request('/must-buy/verify-code', data, function (response) {
                            let message = '';

                            $form.trigger('reset');

                            if (response.code == 200) {
                                $.fancybox.close();

                                $('.section-must-buy').removeClass('active');
                                $('#fill-blank').addClass('active');

                                return;
                            } else if (typeof response.error != 'undefined') {
                                if (response.code == 401) {
                                    return api.show_fancybox_error(response.error, error_expired);
                                }

                                $.fancybox.close();

                                $('#box-code-error .error').addClass('u-hidden');
                                $('#box-code-error .error-' + response.error).removeClass('u-hidden');

                                setTimeout(function () {
                                    $.fancybox({
                                        'padding': 0,
                                        content: $('#box-code-error')
                                    });
                                }, 1000);

                                return;
                            } else {
                                message = response.message;
                            }

                            api.show_fancybox_error(message);
                        });
                    }
                });

                return false;
            });

            const checkbox_selector = '.js-term-form [type="checkbox"]';
            $(document).on('change', checkbox_selector, function () {
                $(this).parent().toggleClass('error', this.checked == false);
                $('.js-term-form .js-button').toggleClass('disabled', $(checkbox_selector).length != $(checkbox_selector + ':checked').length);
            });

            const checkbox_selector_2 = '.js-terms [type="checkbox"]';
            $(document).on('change', checkbox_selector_2, function () {
                $(this).parent().toggleClass('error', this.checked == false);
                $('.js-terms .js-button').toggleClass('disabled', $(checkbox_selector_2).length != $(checkbox_selector_2 + ':checked').length);
            });
        },
        auto_show: function () {
            if (location.hash == '#terms') {
                api.show_terms();
            }

            if ($('body').data('show')) {
                $('.js-btn-terms-submit').trigger('click');
            }
        },
        show_result: function (html) {
            if (html && html != '') {
                api.show_modal('#modal-lucky', function () {
                    const p = $(this);

                    p.find('.lucky-content').html(html).ready(function () {
                        // show notice by content
                        if (html.search('voucher') > -1) {
                            p.find('.lucky-bottom__all').addClass('u-hidden');
                            p.find('.lucky-bottom__evoucher').removeClass('u-hidden');
                        }
                    });
                });
            } else {
                api.show_modal('#modal-lucky-later');
            }
        },
        show_terms: function () {
            $.fancybox.close();
            $('.section-must-buy').removeClass('active');
            $('#terms').addClass('active');
        },
        history: function () {
            if ($('.js-history-must-buy').length == 0) return;

            // get data after action get user history completed;
            let idInterval = setInterval(function () {
                if ($('body').hasClass('process')) return;

                clearInterval(idInterval);

                api.request('/history/must-buy', {}, function (response) {
                    if (typeof response.items == 'object') {
                        $('.js-history-must-buy__items').empty().append(response.items.map(item => {
                            let html = '<div class="content">';

                            if (typeof item.created == 'string') {
                                html += `<div class="content-date">${item.created}</div>`;
                            }

                            html += `<div class="content-des txt-black">${item.content}</div>`;
                            html += '</div>';

                            return html;
                        }));
                    }
                });

            }, 500);
        },
        get_recaptcha_response: function () {
            let item = $('script[src*="/recaptcha/api"]');
            if (item.length == 0) return;

            let key = item.attr('src').split('render=')[1] || null;
            if (key != null) {
                grecaptcha.ready(function () {
                    api.recaptcha.key = key;

                    // grecaptcha.execute(key, { action: 'submit' }).then(function (token) {
                    //     // Add your logic to submit to your backend server here.
                    //     api.recaptcha.token = token;
                    // });
                });
            }
        },
        submit_recaptcha: function (callback) {
            if (typeof callback != 'function') return false;

            if (api.recaptcha.key != '' && api.recaptcha.token == '') {
                grecaptcha.execute(api.recaptcha.key, { action: 'submit' }).then(function (token) {
                    // Add your logic to submit to your backend server here.

                    api.recaptcha.token = token;

                    callback();
                });
            } else {
                callback();
            }
        },
        lottie_icon: function () {
            api.player = null;

            if (typeof lottie != 'object') return;

            $('.lottie-icon').each(function () {
                var src = this.getAttribute('data-src') || '';
                if (src == '') return;

                this.removeAttribute('data-src');

                lottie.loadAnimation({
                    container: this,
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: src
                });
            });

            $('.play__lucky').each(function () {
                var p = $(this), src = p.attr('data-src') || '';
                if (src == '') return;

                p.removeAttr('data-src');
                p.find('img').hide();

                api.player = lottie.loadAnimation({
                    container: this,
                    renderer: 'svg',
                    loop: true,
                    autoplay: false,
                    path: src
                });
            });
        },
        is_touch_device: function () {
            return ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0);
        }
    };

    /** API init */
    api.init();

    $(window).on('load', function () {
        setTimeout(function () {
            api.auto_show();
            api.lottie_icon();
            api.get_recaptcha_response();
        }, 1000);
    });

    // empty value
    $('[type="password"]').val('');

    function decodeQueryParam(p) {
        return decodeURIComponent(p.replace(/\+/g, " "));
    }
});
