<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CIS URL Shortener</title>
        <meta name="author" content="Olav Schettler <olav@schettler.net>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
        <link rel="stylesheet" href="/styles.css">
    </head>
    <body>

        <div class="container">

            <h1>CIS URL Shortener</h1>

            <form id="login" class="row hidden">
                <div class="well offset-by-three six columns">
                    <h2>Login</h2>

                    <label for="username">Username</label>
                    <input class="u-full-width" type="text" placeholder="Your username" id="username-field">

                    <label for="username">Password</label>
                    <input class="u-full-width" type="password" placeholder="Your password" id="password-field">

                    <div class="buttons">
                        <button class="button-primary" type="submit">Login</button>
                    </div>
                </div>
            </form>

            <div id="links" class="row hidden">
                <a href="#" class="u-pull-right" id="logout">Logout</a>
                <ul></ul>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="/scripts.js"></script>
    </body>
</html>

