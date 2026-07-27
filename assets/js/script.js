(function ($) {

    var api = {
        caches: {},
        lang: '',
        recaptcha: {
            key: '',
            token: ''
        },
        init: function () {
            this.lang = $('html').attr('lang') || '';
            this.signup_form();
            this.signin_form();
            this.survey_form();
            this.survey_form('brand');
            this.profile_form();
            this.history();
            this.contest_form();
            this.forgot_form();
            this.verify_newpass_form();
            this.verify_phone_form();
        },
        request: function (route, data, callback) {
            if ($('body').hasClass('process')) return;

            $('body').addClass('process');

            let url = '/api' + route;

            if (this.lang == 'en') {
                url += (url.indexOf('?') > -1 ? '&' : '?') + 'lang=en';
            }

            let type = 'POST';

            let timeout = setTimeout(() => {
                $('body').removeClass('process');
            }, 30000);

            if (data == null || Object.getOwnPropertyNames(data).length == 0) {
                type = 'GET';
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
        get_cache: function (name, value) {
            if (typeof this.caches[name] != 'undefined') {
                value = this.caches[name];
            }

            return value;
        },
        set_cache: function (name, value) {
            this.caches[name] = value;
        },
        get_data: function ($form, show_popup) {
            let data = {}, errors = [];

            $('[data-field]', $form).each(function () {
                let input = $(this),
                    name = input.data('field'),
                    group = input.closest('.form-group'),
                    value = '',
                    error = '';

                if (typeof data[name] == 'undefined') {

                    if (input.attr('type') == 'radio') {
                        const radio_item = $('[data-field="' + name + '"]:checked', $form);
                        if (radio_item.length > 0) {
                            value = radio_item.val();
                        }
                    } else if (input.attr('type') == 'checkbox') {
                        $('[data-field="' + name + '"]:checked', $form).each(function () {
                            if (this.value != '') {
                                value += (value != '' ? ',' : '') + this.value;
                            }
                        });
                    } else {
                        const regEmail = /^([A-Za-z0-9_\+\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                        const pattern = '[0]{1}[1-9]{1}[0-9]{8}';

                        value = input.val().trim();

                        if (name == 'username') {
                            if (value.match(pattern) == null && value.match(regEmail) == null) {
                                error = input.data('pattern-error');
                                errors.push(error);
                                error = '<ul class="list-unstyled c-red"><li>' + error + '</li></ul>';
                            }

                            group.addClass('api-has-error').find('.with-errors').html(error);
                        } else if (name == 'email') {
                            if (value.match(regEmail) == null) {
                                error = input.data('error');
                                errors.push(error);
                                error = '<ul class="list-unstyled c-red"><li>' + error + '</li></ul>';
                            }

                            group.addClass('api-has-error').find('.with-errors').html(error);
                        } else if (name == 'city') {
                            if(value == 0) {
                                error = input.data('error');
                                errors.push(error);
                                error = '<ul class="list-unstyled c-red"><li>' + error + '</li></ul>';
                            }

                            group.addClass('api-has-error').find('.with-errors').html(error);
                        }
                    }

                    if (input.attr('required') && (value == '' || group.hasClass('has-error'))) {
                        error = input.data('error') || name;
                        errors.push(error);
                        error = '<ul class="list-unstyled c-red"><li>' + error + '</li></ul>';

                        group.addClass('api-has-error').find('.with-errors').html(error);

                        data[name] = '';
                    } else {
                        data[name] = value;
                    }

                    if (error == '') {
                        group.removeClass('api-has-error').find('.with-errors').empty();
                    }
                }
            });

            if (show_popup) {
                this.show_popup_error(errors);
            }


            return errors.length == 0 ? data : false;
        },
        get_data_survey: function (questions, skip) {
            let data = {}, errors = [], top = 0;

            questions.each(function () {
                let item = $(this),
                    values = [],
                    inputs = $('input:checked', item),
                    value = '',
                    title = $('.question', this).removeClass('has-error');

                if (item.data('type') == 'textarea') {
                    value = $('textarea', item).val();
                    if (item.data('required') == 1 && value == '' && skip == false) {
                        errors.push(item.data('error'));
                        title.addClass('has-error');
                        if (top == 0) {
                            top = item.offset().top;
                        }
                    }
                    values.push(value);
                } else if (item.data('type') == 'input') {
                    value = $('input', item).val();
                    if (item.data('required') == 1 && value == '' && skip == false) {
                        errors.push(item.data('error'));
                        title.addClass('has-error');
                        if (top == 0) {
                            top = item.offset().top;
                        }
                    }
                    values.push(value);
                } else if (inputs.length == 0) {
                    if (item.data('required') == 1 && skip == false) {
                        errors.push(item.data('error'));
                        title.addClass('has-error');
                        if (top == 0) {
                            top = item.offset().top;
                        }
                    }
                    values.push(value);
                } else {
                    inputs.each(function () {
                        values.push($(this).val());
                    });
                }

                data[item.data('field')] = values.join(',');
            });

            if (top > 0) {
                setTimeout(function () {
                    $('html, body').stop().animate({
                        scrollTop: top
                    }, 300);
                }, 1000);
            }

            return {
                data: data,
                errors: errors
            };
        },
        show_popup_error: function (errors) {
            if (typeof errors == 'undefined') return;
            if (typeof errors != 'object') errors = [errors];

            if (errors.length > 0 && typeof $.fancybox != 'undefined') {
                let popup = $('.js-popup-error');
                $(window).scrollTop(0);

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
        show_form_group_error: function (item, message) {
            let group = item.closest('.form-group'),
                errors = group.find('.with-errors');

            if (typeof message == 'undefined' || message == '') {
                message = '';
                group.removeClass('has-error');
            } else {
                message = `<ul class="list-unstyled"><li>${message}</li></ul>`;
                group.addClass('has-error');
            }

            errors.html(message);
        },
        signup_form: function () {
            $('.js-signup-form').each(function () {
                let $form = $(this),
                    questions = $('.js-question-item', $form),
                    skip = false;

                if (questions.length > 0) {
                    // Process special input
                    $('[data-value="skip"]', $form).on('change', function () {
                        skip = $('[data-value="skip"]:checked', $form).length > 0;
                    });

                    $('.js-fill-value[data-target*="#"]', $form).on('change', function () {
                        let input = $(this);

                        $(input.data('target')).val(input.val());
                    });
                }

                let phone = $('[data-field="phone"]', $form);
                function validatePhone(showError = true) {
                    const phoneValue = api.normalizeVietnamPhone(phone.val());
                    phone.val(phoneValue);
                    if (!phoneValue) {
                        phone.removeClass('has-error');

                        return false;
                    }

                    const valid = api.isValidVietnamPhone(phoneValue);
                    phone.toggleClass('has-error', !valid);
                    phone.closest('.form-group, .form-field, .field').toggleClass('has-error', !valid);
                    api.show_form_group_error(phone, '');
                    if (!valid && showError) {
                        api.show_form_group_error(phone, phone.data('error'));
                    }

                    return valid;
                }

                phone.on('blur change', function () {
                    validatePhone(true);
                });

                $("#phone-verify").each(function () {
                    let pv = $(this);
                    phone.on('change', function () {
                        const valid = validatePhone(false);
                        pv.toggleClass('u-hidden', !valid);
                        $('#box-verify-phone [data-field="phone"]').val(api.normalizeVietnamPhone(phone.val()));
                    });

                    /*
                    $('.js-send-phone-code').on('click', function (e) {
                        e.preventDefault();

                        if (phone.closest('.has-error').length == 0) {
                            let sent = $(this).data('sent');
                            if (sent > 0) {
                                $.fancybox({
                                    'padding': 0,
                                    content: $('#box-verify-phone')
                                });
                            } else {
                                // send code
                                $(this).data('sent', 1);

                                api.send_code(phone.val());
                            }
                        }
                    });
                    */
                });

                $form.on('submit', function (e) {
                    e.preventDefault();

                    const phoneValue = api.normalizeVietnamPhone(phone.val());
                    if (!api.isValidVietnamPhone(phoneValue)) {
                        phone.focus();
                        phone.toggleClass('has-error', true);
                        phone.closest('.form-group, .form-field, .field').toggleClass('has-error', true);
                        api.show_form_group_error(phone, phone.data('error'));

                        return false;
                    }

                    setTimeout(function(){
                        let data = api.get_data($form);
                        if (data != false) {

                            if (questions.length > 0) {
                                let data_survey = api.get_data_survey(questions, skip);
                                if (data_survey.errors.length > 0) {
                                    // api.show_popup_error(data_survey.errors);

                                    return;
                                } else if (Object.getOwnPropertyNames(data_survey.data).length > 0) {
                                    data['answers'] = data_survey.data;
                                }
                            }

                            // if (data['code'] == '' && $('#box-verify-phone').length > 0) {
                            //     return api.send_code(data['phone']);
                            // }

                            api.request('/user/signup', data, function (response) {
                                if (response.code == 200) {
                                    if (response.jwt_token) {
                                        api.set_cookie('lot_token', response.jwt_token, 365);
                                    }

                                    if (typeof data['name'] == 'string') {
                                        $('#box-thanks').find('.user-name').text(data['name']);
                                    }

                                    $form.trigger('reset');

                                    $.fancybox({
                                        'padding': 0,
                                        content: $('#box-thanks')
                                    });

                                    // api.redirect(5000);
                                } else if (typeof response.error != undefined) {
                                    api.show_popup_error(response.error);
                                } else {
                                    api.show_popup_error(response.message);
                                }
                            });
                        }
                    }, 500);

                    return false;
                });
            });
        },
        profile_form: function () {
            $('.js-profile-form').each(function () {
                let $form = $(this);

                $form.on('submit', function (e) {
                    e.preventDefault();

                    let data = api.get_data($form);
                    if (data != false) {
                        api.request('/user/info', data, function (response) {
                            if (response.code == 200) {
                                api.redirect(0);
                            } else if (typeof response.error != undefined) {
                                api.show_popup_error(response.error);
                            } else {
                                api.show_popup_error(response.message);
                            }
                        });
                    }

                    return false;
                });
            });

            $('.js-remove-form').each(function () {
                let $form = $(this);

                $('.js-submit', $form).on('click', function (e) {
                    e.preventDefault();

                    var input = $('[data-field="password"]', $form);
                    if (input.val() == '') {
                        api.show_form_group_error(input, input.data('error'));
                        return;
                    } else {
                        api.show_form_group_error(input, '');
                    }

                    api.request('/user/del-account', { password: input.val() }, function (response) {
                        let message = '';

                        if (response.code == 200) {
                            api.set_cookie('lot_token', '');

                            api.show_popup_error(response.message);

                            api.redirect(3000);

                            return;
                        } else if (typeof response.error != undefined) {
                            message = response.error;
                        } else {
                            message = response.message;
                        }

                        input.val('');
                        api.show_popup_error(message);
                    });
                });
            });

            $('.js-avatar-image').each(function () {
                let p = $(this),
                    btn = $('.js-avatar-submit', p),
                    img = $('img', p),
                    input = $('input[type=file]', p),
                    accepts = input.attr('accept').split(',').map(v => v.trim()),
                    image_data = '',
                    maxsize = 1024 * 1024, // 1MB
                    old_src = img.attr('src');

                input.on('change', function () {
                    image_data = '';

                    if (this.files.length > 0) {

                        if (api.get_size(this) > maxsize) {
                            api.show_popup_error(input.data('size-error'));

                            return;
                        }

                        if (accepts.indexOf(this.files[0].type) == -1) {
                            api.show_popup_error(input.data('accept-error'));

                            return;
                        }

                        var reader = new FileReader();

                        reader.onload = function (e) {
                            // get loaded data and render thumbnail.
                            image_data = e.target.result;

                            img.attr('src', image_data);
                        };

                        // read the image file as a data URL.
                        reader.readAsDataURL(this.files[0]);
                    } else {
                        img.attr('src', old_src);
                    }

                    btn.toggleClass('u-hidden', this.files.length == 0);
                });

                btn.on('click', function (e) {
                    e.preventDefault();

                    if (image_data != '') {
                        api.request('/user/avatar', { image: image_data }, function (response) {
                            if (response.code == 200) {
                                api.show_popup_error(p.data('success'));

                                input.val('');
                                btn.addClass('u-hidden');
                            } else {
                                api.show_popup_error(p.data('error'));
                            }
                        });
                    }
                });
            });
        },
        signin_form: function () {
            $('.js-signin-form').each(function () {
                let $form = $(this);

                $form.on('submit', function (e) {
                    e.preventDefault();

                    let data = api.get_data($form);
                    if (data != false) {
                        api.submit_recaptcha(function () {
                            data['g-recaptcha-response'] = api.recaptcha.token;

                            api.request('/user/signin', data, function (response) {
                                if (response.code == 200) {
                                    api.set_cookie('lot_token', response.jwt_token, 365);

                                    if (typeof response.name == 'string') {
                                        $('#box-thanks').find('.user-name').text(response.name);
                                    }

                                    $form.trigger('reset');

                                    $.fancybox({
                                        'padding': 0,
                                        content: $('#box-thanks')
                                    });

                                    api.redirect(5000);
                                } else if (typeof response.error != undefined) {
                                    api.show_popup_error(response.error);

                                    if (response.recaptcha) {
                                        setTimeout(function () {
                                            location.reload();
                                        }, 3000);
                                    }
                                } else {
                                    api.show_popup_error(response.message);
                                }
                            });
                        });
                    }

                    return false;
                });
            });
        },
        survey_form: function (subname) {
            let selector = '.js-survey-form', api_url = '/user/answer';

            if (typeof subname != 'undefined') {
                selector = '.js-survey-' + subname + '-form';
                api_url += '/' + subname;
            } else {
                subname = '';
            }

            $(selector).each(function () {
                let $form = $(this),
                    questions = $('.js-question-item', $form),
                    skip = false;

                // Process special input
                $('[data-value="skip"]', $form).on('change', function () {
                    skip = $('[data-value="skip"]:checked', $form).length > 0;
                });

                $('.js-fill-value[data-target*="#"]', $form).on('change', function () {
                    let input = $(this);

                    $(input.data('target')).val(input.val());
                });

                $form.on('submit', function (e) {
                    e.preventDefault();

                    let data_survey = api.get_data_survey(questions, skip);

                    if (data_survey.errors.length > 0) {
                        // api.show_popup_error(data_survey.errors);
                    } else {
                        api.request(api_url, data_survey.data, function (response) {
                            if (response.code == 200) {
                                api.show_popup_error('Submit answer success!');

                                api.redirect(100);
                            } else if (typeof response.error != undefined) {
                                api.show_popup_error(response.error);
                            } else {
                                api.show_popup_error(response.message);
                            }
                        });
                    }

                    return false;
                });
            });
        },
        history: function () {
            $('.js-history').each(function () {
                api.get_history();

                $(this).on('click', '.js-history__filter li', function () {
                    api.get_history($(this).data('value'));
                });
            });
        },
        get_history: function (year) {
            let url = '/user/history', current = (new Date()).getFullYear();

            if (typeof year != 'undefined') {
                url += '?year=' + year;

                if (year < current) {
                    let cache = api.get_cache(url);
                    if (typeof cache == 'object') {
                        return api.history_html(cache, year);
                    }
                }
            }

            api.request(url, {}, function (response) {
                if (response.code == 200) {
                    api.history_html(response, year);

                    api.set_cache(url, response);
                }
            });
        },
        history_html: function (response, current) {

            if (typeof response.years == 'object') {
                if (typeof current == 'undefined') {
                    current = response.years[response.years.length - 1];
                }

                $('.js-history__filter').empty().append(response.years.map(value => `<li data-value="${value}" class="${current == value ? 'active' : ''}">${value}</li>`));
            }

            if (typeof response.items == 'object') {
                $('.js-history__items').empty().append(response.items.map(item => {
                    let html = '<div class="content">';
                    html += `<div class="content-date">${item.created}</div>`;
                    html += `<div class="content-des txt-black">${item.description}</div>`;
                    html += '</div>';

                    return html;
                }));
            }
        },
        contest_form: function () {
            $('.js-contest-submit').on('click', function (e) {
                e.preventDefault();

                let input = $('.js-contest-url'), url = input.val().trim();

                if (url == '' || url.indexOf('facebook') == false) {
                    api.show_popup_error(input.data('error'));

                    return false;
                }

                api.request('/user/contest', { url: url }, function (response) {
                    if (response.code == 200) {
                        api.redirect(0);
                        api.show_popup_error('Submit contest success!');
                    } else if (typeof response.error != undefined) {
                        api.show_popup_error(response.error);
                    } else {
                        // alert(response.message);

                        api.show_popup_error(response.message);
                    }
                });
            });
        },
        forgot_form: function () {
            $('.js-forgot-form').each(function () {
                let $form = $(this);

                $form.on('submit', function (e) {
                    e.preventDefault();

                    let data = api.get_data($form);
                    if (data != false) {
                        api.request('/user/forgot', data, function (response) {
                            if (response.code == 200) {
                                if (typeof data['email'] == 'string') {
                                    $('#box-forgot .input-email').val(data['email']);
                                }

                                $.fancybox({
                                    'padding': 0,
                                    content: $('#box-forgot')
                                });
                            } else if (typeof response.error != undefined) {
                                api.show_popup_error(response.error);
                            } else {
                                api.show_popup_error(response.message);
                            }
                        });
                    }

                    return false;
                });
            });
        },
        verify_newpass_form: function () {
            $('.js-verify-newpass-form').each(function () {
                let $form = $(this);

                $form.on('submit', function (e) {
                    e.preventDefault();

                    let data = api.get_data($form);
                    if (data != false) {
                        api.request('/user/verify/newpass', data, function (response) {
                            let message = '';

                            if (response.code == 200) {
                                $.fancybox({
                                    'padding': 0,
                                    content: $('#box-thanks')
                                });

                                api.redirect(5000);
                            } else if (typeof response.error == 'string') {
                                message = response.error;
                            } else {
                                message = response.message;
                            }

                            $('.js-message').find('p').text(message);
                            $('.js-message').removeClass('u-hidden');
                        });
                    }

                    return false;
                });
            });
        },
        verify_phone_form: function () {
            $('.js-verify-phone-form').each(function () {
                let $form = $(this);

                $form.on('submit', function (e) {
                    e.preventDefault();

                    let data = api.get_data($form);
                    if (data != false) {

                        // Fix form data phone not set
                        if (typeof data['phone'] == 'undefined' || data['phone'] == '') {
                            if (typeof api.caches['phone'] != 'undefined') {
                                data['phone'] = api.caches['phone'];
                            } else {
                                $('.js-message').find('p').text('Số điện thoại chưa được gửi OTP!');
                                $('.js-message').removeClass('u-hidden');

                                setTimeout(function () {
                                    $('.js-message').addClass('u-hidden');
                                }, 10000);

                                return;
                            }
                        }

                        api.request('/user/phone/verify', data, function (response) {
                            let message = '';

                            if (response.code == 200) {
                                if (typeof data['code'] == 'string') {
                                    $('.js-signup-form .input-code').val(data['code']);
                                }

                                message = $('.js-message').data('message');

                                setTimeout(() => {
                                    $.fancybox.close();

                                    // Auto submit
                                    $('.js-signup-form').trigger('submit');
                                }, 1000);
                            } else if (typeof response.error == 'string') {
                                message = response.error;
                            } else {
                                message = response.message;
                            }

                            $('.js-message').find('p').text(message);
                            $('.js-message').removeClass('u-hidden');
                        });
                    }

                    return false;
                });
            });
        },
        send_code: function (phone) {
            api.request('/user/phone/sms', { phone: phone }, function (response) {
                if (response.code == 200) {
                    api.caches['phone'] = phone;

                    $.fancybox({
                        'padding': 0,
                        content: $('#box-verify-phone')
                    });

                    // testing
                    if (response.data) {
                        alert(response.data);
                    }

                    return;
                } else if (typeof response.error == 'string') {
                    api.show_popup_error(response.error);
                } else {
                    api.show_popup_error(response.message);
                }

                $('.js-send-phone-code').data('sent', 0);
            });
        },
        get_size: function (input) {
            if (window.ActiveXObject) {
                var fso = new ActiveXObject("Scripting.FileSystemObject");
                var filepath = input.value;
                var thefile = fso.getFile(filepath);
                var sizeinbytes = thefile.size;
            } else {
                var sizeinbytes = input.files[0].size;
            }

            // var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');

            return sizeinbytes;
        },
        redirect: function (time) {
            if (typeof time == 'undefined') {
                time = 100;
            }

            let url = $('.redirect_to').val() || '';
            if (url != '') {
                var item = $('.redirect-time-count'), count = item.length > 0 ? parseInt(item.text()) : 0;
                if (count > 0) {
                    var idInterval = setInterval(() => {
                        count--;

                        item.text(count);

                        if (count <= 0) {
                            location.href = url;

                            return clearInterval(idInterval);
                        }
                    }, 1000);
                } else {
                    setTimeout(() => {
                        location.href = url;
                    }, time);
                }
            }
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
        normalizeVietnamPhone: function (value) {
            let phone = String(value || '')
                .trim()
                .replace(/[\s().-]/g, '');

            if (phone.startsWith('+84')) {
                phone = '0' + phone.slice(3);
            } else if (phone.startsWith('0084')) {
                phone = '0' + phone.slice(4);
            } else if (phone.startsWith('84') && phone.length === 11) {
                phone = '0' + phone.slice(2);
            }

            return phone;
        },
        isValidVietnamPhone: function (value) {
            const phone = api.normalizeVietnamPhone(value);
            const phoneRegex =
                /^(?:081|082|083|084|085|088|091|094|070|076|077|078|079|089|090|093|086|032|033|034|035|036|037|038|039|096|097|098|052|056|058|092|087|055|059|099)\d{7}$/;

            return phoneRegex.test(phone);
        }
    };

    /** API init */
    api.init();

    $(window).on('load', function () {
        api.get_recaptcha_response();
    });

    // empty value
    $('[type="password"]').val('');

    // Prevent space key from being registered in specific inputs
    $('.js-no-space').on('keydown', function(e) {
        if (e.which === 32) {
            return false;
        }
    }).on('change', function() {
        this.value = this.value.replace(new RegExp(' ', 'g'), '');
    });

    $('.js-trim-space')
        .on('keydown', function (e) {
            const value = this.value;
            if (e.key === ' ' && value.trim() === '') {
                e.preventDefault();
            }
        })
        .on('blur change focusout', function () {
            this.value = this.value.trim().replace(/\s+/g, ' ');
        })
        .on('paste', function (e) {
            const input = this;
            setTimeout(() => { input.value = input.value.trim(); }, 0);
        });

})(jQuery);
