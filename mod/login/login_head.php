<title> Login Utilisateur </title>
<link rel="stylesheet" type="text/css" href="css/formulaire.css" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        outline: none;
    }

    .menu {
        display: none;
    }

    .header_top {
        display: none;
    }

    body {
        background: linear-gradient(45deg, rgba(186, 29, 50, 1), rgba(50, 62, 84, 1));
        height: 100vh;
        font-family: arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    <?php
    // Verification si personnalisation interface
    $img = squery("SELECT value FROM t_parametre WHERE code='mire_bg'");
    if (is_file('pic/interface/bg/' . $img)) {
        echo 'body {' . PHP_EOL;
        echo '  background-image: url(pic/interface/bg/' . $img . ');' . PHP_EOL;
        echo '  background-size: cover;' . PHP_EOL;
        echo '  background-repeat: no-repeat;' . PHP_EOL;
        echo '  background-position: center center;' . PHP_EOL;
        echo '}' . PHP_EOL;
    }
    ?>.container {
        position: relative;
    }

    form {
        background: rgba(255, 255, 255, .3);
        padding: 3rem;
        height: 320px;
        border-radius: 20px;
        border-left: 1px solid rgba(255, 255, 255, .3);
        border-top: 1px solid rgba(255, 255, 255, .3);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        -moz-backdrop-filter: blur(10px);
        box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, .2);
        text-align: center;
    }

    p {
        color: white;
        font-weight: 500;
        opacity: .7;
        font-size: 1.4rem;
        margin-bottom: 60px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
    }

    input {
        background: transparent;
        border: none;
        border-left: 1px solid rgba(255, 255, 255, .3);
        border-top: 1px solid rgba(255, 255, 255, .3);
        padding: 1rem;
        width: 200px;
        border-radius: 50px;
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        -moz-backdrop-filter: blur(5px);
        box-shadow: 4px 4px 60px rgba(0, 0, 0, .2);
        color: white;
        font-weight: 500;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
        transition: all .3s;
        margin-bottom: 2em;
    }

    input:hover,
    input[type="text"]:focus,
    input[type="password"]:focus {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);
    }

    input[type="submit"] {
        margin-top: 10px;
        width: 150px;
        cursor: pointer;
    }

    ::placeholder {
        color: #fff;
    }

    .drop {
        background: rgba(255, 255, 255, .3);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        border-left: 1px solid rgba(255, 255, 255, .3);
        border-top: 1px solid rgba(255, 255, 255, .3);
        box-shadow: 10px 10px 60px -8px rgba(0, 0, 0, 0.2);
        position: absolute;
        transition: all 0.2s ease;
    }

    .drop-1 {
        height: 80px;
        width: 80px;
        top: -20px;
        left: -40px;
        z-index: -1;
        animation: spin 4s linear infinite;
    }

    .drop-2 {
        height: 80px;
        width: 80px;
        bottom: -30px;
        right: -20px;
        animation: spin 5s linear infinite;
    }

    .drop-3 {
        height: 100px;
        width: 100px;
        bottom: 120px;
        right: -50px;
        z-index: -1;
        animation: spin 3s linear infinite;
    }

    .drop-4 {
        height: 120px;
        width: 120px;
        top: -60px;
        right: -60px;
        animation: spin 6s linear infinite;
    }

    .drop-5 {
        height: 60px;
        width: 60px;
        bottom: 170px;
        left: 90px;
        z-index: -1;

    }

    @keyframes spin {
        0% {
            transform: translate(-5%, -5%) rotate(0deg) translate(5px) rotate(0deg);
        }

        100% {
            transform: translate(-5%, -5%) rotate(360deg) translate(5px) rotate(-360deg);
        }
    }

    .content {
        width: unset;
        min-height: unset;
    }

    .login_ko {
        width: 100vw;
        margin: auto;
        height: 40px;
        line-height: 40px;
        background-color: rgba(255, 0, 0, 0.4);
        border: none;
        border-bottom: 1px solid rgba(255, 0, 0, 0.6);
        color: white;
        font-size: 20px;
        text-align: center;
        position: absolute;
        top: 0px;
        left: 0px;
    }
</style>