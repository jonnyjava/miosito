function limpiaform(){
   $('#mail').val('');
   $('#objeto').val('');
   $('#contenido').val('');
   $('#avisoobjeto').css("display","none");
   $('#avisotexto').css("display","none");
   $('#avisocorreo').css("display","none");
   rigeneraCaptcha();
  }
  function on(idobj){
    $('#'+idobj).css('background-color','#175C84');
    $('#'+idobj).css('border-color','#004C78');
  }
  function off(idobj){
    $('#'+idobj).css('background-color','#173A4E');
    $('#'+idobj).css('border-color','#00263C');
  }
  function validaEInvia(){
    var okko=true;
    var mail = $('#mail').val();
    //var ex = new RegExp("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+[a-zA-Z]{2,4}$");
    var ex = new RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/);
    if(!ex.test(mail)){okko=false;$('#avisocorreo').css("display","block");}
    var object = "";
    if($('#objeto').val()!=""){var object =$('#objeto').serialize();}else{okko=false;$('#avisoobjeto').css("display","block");};
    var content = "";
    if($('#contenido').val()!=""){var contenido =$('#contenido').serialize();}else{okko=false;$('#avisotexto').css("display","block");};
    var data = "mail="+mail+"&"+object+"&"+contenido;
    if(okko){
      var d = $('#myForm').serialize();
      $.post('../captcha/captcha.php',d,function(msg){
        if(msg.search("OK")>-1){
          $.post('../mail.php',data,function(a){alert('mail enviada');limpiaform();});
        }
        else{
          alert(textocaptchako);
          rigeneraCaptcha();
        }
      });
    } 
  }
  function rigeneraCaptcha(){
    $("#captchacontainer").captcha({
      borderColor: "silver",
      text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
    });
  }