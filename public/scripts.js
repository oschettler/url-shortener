/*
 *
 */
jQuery(function ($) {
    var linksTag;

    function showLogin() {
        console.log("Login");
        delete localStorage['token'];

        $('#login').removeClass('hidden');
        $('#links').addClass('hidden');
    }

    function showLinks() {
        console.log("Links");
        $('#login').addClass('hidden');
        $('#links').removeClass('hidden');

        api('/api', {
           success: function (response) {
               linksTag = riot.mount('links', { links: response });
           }
        });
    }

    window.api = function (url, settings) {
        if (typeof localStorage['token'] !== 'undefined') {
            settings.headers = { 'X-Chefkoch-Api-Token': localStorage['token'] };
        }

        settings.cache = false;
        settings.dataType = 'json'; // From the server

        $.ajax(url, settings);
    }

    if (typeof localStorage['token'] === 'undefined') {
        showLogin();
    }
    else {
        api('/api/me', {
            success: showLinks,
            error: showLogin
        });
    }

    $('#login').submit(function (e) {
        e.preventDefault();

        api('/api/login', {
            method: 'POST',
            data: {
                username: $('#username-field').val(),
                password: $('#password-field').val()
            },
            success: function (response) {
                if (response.status == 'success') {
                    localStorage['token'] = response.content.token;
                    console.log('Successful login');
                    showLinks();
                }
            },
            error: function () {
                console.log('Login failed');
                showLogin();
            }
        });
    });

    $('#logout').click(function (e) {
        e.preventDefault();
        showLogin();
    });
});
