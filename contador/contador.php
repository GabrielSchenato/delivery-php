<script type="text/javascript">
    function start_countdown()
    {
        var counter = 99999999;
        myVar = setInterval(function ()
        {
            if (counter >= 0)
            {
                document.getElementById("countdown").innerHTML = "<strong>Atenção</strong></br>Você vai ser deslogado em " + counter + " segundos";
            }
            if (counter == 0)
            {
                $.ajax
                        ({
                            type: 'post',
                            url: 'logoff.php',
                            data: {
                                logout: "logout"
                            },
                            success: function (response)
                            {
                                window.location = "";
                            }
                        });
            }
            counter--;
        }, 1000)
    }
</script>
<script>start_countdown();</script>

<div class="col-md-offset-5" style="display: inline-block;
     float: none !important; color: red; font-size: medium; text-align: center" id="countdown"> </div>