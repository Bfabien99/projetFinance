
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="<?= $_SERVER["REQUEST_URI"] ?>assets/js/jquery.js"></script>
    <title>Document</title>
    <style>
        .red{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Inscription</h1>
    <p>Tous les champs suivis de <span class="red">*</span> sont à remplir</p>
    <div id="msg"></div>
    <form action="" method="post" id="form">
        <div class="group">
            <label for="nom">Entrer votre nom <span class="red">*</span></label>
            <input type="text" name="nom" id="nom">
        </div>
        <div class="group">
            <label for="prenoms">Entrer votre prenoms <span class="red">*</span></label>
            <input type="text" name="prenoms" id="prenoms">
        </div>
        <div class="group">
            <label for="contact">Entrer votre contact <span class="red">*</span></label>
            <input type="text" name="contact" id="contact">
        </div>
        <div class="group">
            <label for="email">Entrer votre email<span class="red">*</span></label>
            <input type="text" name="email" id="email">
        </div>
        <div class="group">
            <label for="password">Créer un mot de passe <span class="red">*</span></label>
            <input type="text" name="password" id="password">
        </div>
        <div class="group">
            <label for="password">Confirmer le mot de passe <span class="red">*</span></label>
            <input type="text" name="cpassword" id="cpassword">
        </div>
        <button type="submit" id="submit">Envoyer</button>
    </form>
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
                                $msg = "<div class='alert alert-success'>Inscription réussie</div>"
                                $('#msg').html($msg);
                                setTimeout(function () {
                                    $('#form')[0].reset();
                                },100)
                                setTimeout(function () {
                                    $('#msg').html("")
                                },2000)
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