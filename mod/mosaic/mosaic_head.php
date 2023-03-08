<title> Page Mosaic </title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="css/formulaire.css"/>
<script type="text/javascript">
    $().ready(function() {
        $( "#slider" ).slider({
            orientation: "horizontal",
            range: "min",
            max: 127,
            value: 87,
            slide: function( event, ui ) {
                var alpha = eval(127 - ui.value);
                $( "#hidden_alpha" ).val( alpha );
            }
        });
    });
</script>

<style type="text/css">
    .zone_formulaire{
        padding: 10px;
        font-family: arial;
        font-size: 12px;
        color: black;
        text-align: center;
        min-width:320px;
        min-height: 120px;
        background-color: rgba(255,255,255,0.4);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 5px;
        position: absolute;
        top: calc( (100vh - 120px) / 8);
        left: calc( (100vw - 320px) / 2);
        z-index: 10000;
    }
    .upload_ok{
        width: 70%;
        margin:auto;
        height: 40px;
        line-height: 40px;
        background-color: rgba(0,255,0,0.4);
        border: 1px solid rgba(0,255,0,0.6);
        color: black;
        border-radius: 5px;
        text-align: center;
    }
    .upload_ko{
        width: 70%;
        margin:auto;
        height: 40px;
        line-height: 40px;
        background-color: rgba(255,0,0,0.4);
        border: 1px solid rgba(255,0,0,0.6);
        color: black;
        border-radius: 5px;
        text-align: center;
    }

    .apercu_img{
        padding: 10px;
        text-align: center;
        width: 700px;
        background-color: rgba(255,255,255,0.4);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 5px;
        margin:auto;
        margin-top:30px;
    }

    #slider{
        width:50%;
        margin:auto;
        margin-top: 20px;
    }
    .info_slider{
        width:50%;
        margin:auto;
        margin-top: 20px;
    }
    .info_left{
        float: left;
        width: 45%;
        text-align: left;
    }
    .info_right{
        float: right;
        width: 45%;
        text-align: right;
    }
</style>