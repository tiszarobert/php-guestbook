<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuestBook</title>
    <style>
    h2{
        text-align:center;
    }
    h4{
        text-align:center;
    }
    .row{
        display:block;
        text-align:center;
    }
    .error-message{
        color:red;
        font-weight:bold;
        margin-left:10px;
    }
    .success-message{
        color:green;
        font-weight:bold;
        margin-left:10px;
    }
    #list{
        margin-top: 10px;
    }
    #list .message {
        border:1px solid black;
        display:block;
        width:50%;
        margin:0 auto;
    }
    #list .message .header div{
        border: 1px solid black;
        font-weight: bold;
        display:inline-block;
        width:48%;
    }
    </style>
</head>
<body>
<h2>Vendégkönyv</h2>
<h4 id="answer"></h4>
    <form action="" method="post" onsubmit="return Send();">
        <div class="row name-row">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name-text">
        </div>
        <div class="row">
            <label for="message">Üzenet(min. 10 karakter):</label>
        </div>
        <div class="row">
            <textarea name="message" id="message-text" cols="30" rows="10"></textarea>
        </div>
        <div class="row">
            <input type="submit" value="Elküldés">
        </div>
    </form>
    <div id="list">
    
    </div>
    <script src="assets/jquery.min.js"></script>
    <script>
        List();
        function Send(){
            event.preventDefault();
            $("#answer").removeClass("error-message");
            $("#answer").removeClass("success-message");

            var name = $("#name-text").val();
            var message = $("#message-text").val();
            
            var error = 0;
            if(name.trim() == "" || name.length <= 2){
                $("#name-text").css("border","1px solid red");
                $("#answer").addClass("error-message");
                $("#answer").text('Hiányos űrlap!')
                error = 1;
            }else if(message.trim() == "" || message.length <= 10){
                $("#message-text").css("border","1px solid red");
                $("#answer").addClass("error-message");
                $("#answer").text('Hiányos űrlap!')
                error = 1;
            }
            if(error == 0){
                $("input[type='text'], #message-text").css("border","1px solid black");
                $("#answer").removeClass("error-message");
                $("#answer").addClass("success-message");
                $("#answer").text("Sikeres üzenetküldés!");
                $('.e-message').remove();
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {save:1,name:name, message:message},
                    success: function(){
                        List();
                    }
                });
            }
            return false;
        }
        function List(){
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {list:1},
                success: function(data){
                    $('#list').html(data);
                }
                });
        }
    </script>
    
</body>
</html>