<div id="params">
    <div class="bloc">
        <h2 class="title">SECURITE</h2>
    </div>

    <div class="line"></div>

    <?php if(!empty($datas)):?>
        <div class="first">

            <h3>Modifier mes informations</h3>

            <form action="" method="post" id="form">

            <div id="msg"></div>

                <img src="/projetFinance/uploads/user/<?=$datas['profil_pic']?>" id="pic" alt="profile" width="100px" style="border:1px solid;border-radius: 50%;" height="100px">

                <div class="group">
                    <label for="upload">Modifier Image</label>
                    <input type="file" name="file" id="file">
                </div>

                <div class="group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= $datas['nom']?>">
                </div>

                <div class="group">
                    <label for="prenoms">Prenoms</label>
                    <input type="text" name="prenoms" id="prenoms" value="<?= $datas['prenoms']?>">
                </div>

                <div class="group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" value="<?= $datas['contact']?>">
                </div>

                <div class="group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= $datas['email']?>">
                </div>

                <button type="submit" id="submit">Modifier</button>

            </form>

        </div>

        <div class="line"></div>

        <div class="second">

            <h3>Modifier mon Mot de passe</h3>

            <form action="" method="post" id="passform">

                <div id="pmsg"></div>

                <div class="group">
                    <label for="password">Nouveau mot de passe <span class="red">*</span></label>
                    <input type="password" name="password" required id="password">
                </div>

                <div class="group">
                    <label for="password">Confirmer le mot de passe <span class="red">*</span></label>
                    <input type="password" name="cpassword" required id="cpassword">
                </div>

                <button type="submit" id="submit">Modifier</button>

            </form>

        </div>
    <?php endif; ?>
</div>
<script>
    $(document).ready(function(){

        // Modifier information
        $('#form').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var contact = $('#contact').val();
            var email = $('#email').val();
            var file_data = $('#file').prop('files')[0];

            var form_data = new FormData();
            form_data.append('nom',nom)
            form_data.append('prenoms',prenoms)
            form_data.append('contact',contact)
            form_data.append('email',email)
            form_data.append('file',file_data);

            $.ajax({
                    url: '../ajax/updateinfo.php',
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: form_data,
                    success: function(data)
                    {
                        if(data){
                            $('#msg').html(data)
                            setTimeout(function() {
                                $('#msg').html('')
                            },5000)
                        }
                    }
                });
        });

        // Modifier mot de passe
        $('#passform').on('submit',function(e){
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();

            if(password.length < 6){
                $msg = "<div class='alert alert-danger'>Le mot de passe doit compter au moins 6 caractères</div>"
                $('#pmsg').html($msg)
            }else
            {  
                if(cpassword == ""){
                    $msg = "<div class='alert alert-danger'>Veuillez confirmer le mot de passe</div>"
                    $('#pmsg').html($msg)
                }
                else if(password !== cpassword){
                    $msg = "<div class='alert alert-danger'>Le mot de passe ne correspond pas</div>"
                    $('#pmsg').html($msg)
                }
                else{
                    $.ajax({
                        url: '../ajax/newpass.php',
                        type: 'POST',
                        data: {email: email, password: password, cpassword: cpassword },
                        success: function(data)
                        {
                            if(data){
                                $('#pmsg').html(data)
                                setTimeout(function() {
                                    $('#pmsg').html("");
                                },5000)
                            }
                        }
                    });
                }
            }
        });


    })
</script>