
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="/projetFinance/assets/js/jquery.js"></script>
    <title>Inscription</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap');

        body{
            background-image: linear-gradient(to bottom, #845ec2, #8051cd, #7b42d7, #7630e1, #7012eb);
            color: white;
            font-family: Poppins,'Playfair Display',  serif;
            min-height: 100vh;
        }

        .container{
            display: flex;
            flex-direction: column;
            gap: 1em;
            padding: 10px;
            align-items: center;
        }

        .title{
            font-size: 72px;
            text-align: center;
            text-decoration: underline;
            font-weight: 600;
        }

        form{
            width: 100%;
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 1em;
            align-items: center;
            box-shadow: 0px 0px 1px #e00d72;
            padding: 15px;
            border-radius: 5px;
        }

        .entete h1{
            color: tomato;
            text-align: center;
            text-shadow: 0px 0px 2px #444;
        }

        form .group{
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        form .group input{
            transition: all 0.2s;
            outline: none;
            height: 30px;
            padding: 5px;
            border: 1px solid #444;
            border-radius: 5px;
            color: #e00d72;
        }

        form .group input:focus{
            border: 1px solid #ee1212;
        }

        button{
            text-decoration: none;
            border: none;
            border-radius: 5px;
            padding: 5px;
            min-width: 200px;
            color: white;
            background-image: linear-gradient(to left, #ee1212, #f00031, #ee0049, #e9005f, #e00d72);
        }

        .forget{
            color: #e00d72;
        }

        .back{
            text-decoration: none;
            color: white;
            padding: 5px;
            border-radius: 5px;
            background-color: #0d0c45;
        }

        .red{
            color: red;
        }

        .line{
            width: 200px;
            height: 2px;
            background-color: #e9005f;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="block">
        <img src="/projetFinance/assets/img/xbank.png" alt="" width="200px" height="200px" style="display: flex;margin:0 auto;border-radius:50%">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, illum!</p>
        </div>

        <div class="line"></div>

        <div class="entete">
            <h1>Ouverture de compte</h1>
            <p>Tous les champs suivis de <span class="red">*</span> sont à obligatoire</p>
        </div>

        <form action="" method="post" id="form">
              
            <div id="msg"></div>

            <div class="group">
                <label for="nom">Entrer votre nom <span class="red">*</span></label>
                <input type="text" name="nom" required id="nom">
            </div>

            <div class="group">
                <label for="prenoms">Entrer votre prenoms <span class="red">*</span></label>
                <input type="text" name="prenoms" required id="prenoms">
            </div>

            <div class="group">
                <label for="contact">Entrer votre contact <span class="red">*</span></label>
                <input type="tel" name="contact" required id="contact">
            </div>

            <div class="group">
                <label for="email">Entrer votre email<span class="red">*</span></label>
                <input type="email" name="email" required id="email">
            </div>

            <div class="group">
                <label for="password">Créer un mot de passe <span class="red">*</span></label>
                <input type="password" name="password" required id="password">
            </div>

            <div class="group">
                <label for="password">Confirmer le mot de passe <span class="red">*</span></label>
                <input type="password" name="cpassword" required id="cpassword">
            </div>
            
            <button type="submit" id="submit">Envoyer</button>

        </form>

        <a href="/projetFinance" class="back">Retour</a>
    </div>
   
</body>
<!-- JS simple -->
<script>
    function checkLength(variable,number){
        variable.addEventListener('keydown',function(){
            if (variable.value.length<number-1) {
                variable.style.color="red";
            }
            else {
                variable.style.color="black";
            }
        })
    }

    var nom = document.getElementById('nom');
    var prenoms = document.getElementById('prenoms');
    var contact = document.getElementById('contact');
    var email = document.getElementById('email');
    var password = document.getElementById('password');

    checkLength(password,6)
</script>

<!-- AJAX -->
<script>

    $(document).ready(function()
    {
        $('#form').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var contact = $('#contact').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();

            if(password.length < 6){
                $msg = "<div class='alert alert-danger'>Le mot de passe doit compter au moins 6 caractères</div>"
                $('#msg').html($msg)
            }else
            {  
                if(cpassword == ""){
                    $msg = "<div class='alert alert-danger'>Veuillez confirmer le mot de passe</div>"
                    $('#msg').html($msg)
                }
                else if(password !== cpassword){
                    $msg = "<div class='alert alert-danger'>Le mot de passe ne correspond pas</div>"
                    $('#msg').html($msg)
                }
                else{
                    
                    $.ajax({
                        url: 'ajax/inscription.php',
                        type: 'POST',
                        data: {nom: nom, prenoms: prenoms, contact: contact, email: email, password: password},
                        success: function(data)
                        {
                            if(data == "ok"){
                                $msg = "<div class='alert alert-success'>Inscription réussie, veuillez confirmer votre Email</div>"
                                $('#msg').html($msg);
                                setTimeout(function () {
                                    $('#form')[0].reset();
                                },100)
                                setTimeout(function () {
                                    $('#msg').html("")
                                },7000)
                            }
                            else if(data !== "ok"){
                                $('#msg').html(data)
                            }
                            else{
                                
                            }
                        }
                    });

                }
            }
        });

    });

</script>
</html>