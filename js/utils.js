function bg(idobj,i){
  if (i == 1){$('#'+idobj).css("backgroundImage","url('img/bgbutton.png')");}
  if (i == 0){$('#'+idobj).css("backgroundImage","none");}
}
function loadElements(){
  $("#flipPad input:not(.revert)").bind("click",function(){
    var $this = $(this);
    $("#flipbox").flip({
      direction: $this.attr("rel"),
      color: $this.attr("rev"),
      content:$('#flipbox').load( $this.attr("title")),
      onBefore: function(){$(".revert").show()},
      onAnimation: function(){
      //$('#a').html($('#a').html()+'a ');
    },
      onEnd: function(){
      //$('#a').load('img/logo.png');
      var t = $this.attr("title");
      if(t.search("Conta")>-1){
          $("#captchacontainer").captcha({
            borderColor: "silver",
            text: "Verify that you are a human,<br />drag <span>scissors</span> into the circle."
          });
        }
      }
    })
    return false;
  });
}
function resettapagina(){
  $("#flipbox").flip({
      direction: "rl",
      color: "#15457b",
      content:$('#flipbox').load( "home.html"),
      onBefore: function(){$(".revert").show()},
      onAnimation: function(){
      //$('#a').html($('#a').html()+'a ');
    },
      onEnd: function(){
      //$('#a').load('img/logo.png');
      }
    });
    stopslider();
}
function cambiaidioma(i){
  //hago desaparecer los textos
  $('#AndreaCarrozzo').fadeOut('slow');
  $('#portfolio').fadeOut('slow');
  $('#contact').fadeOut('slow');
  $('#tarifas').fadeOut('slow',function(){idioma(i);});
  
}
function idioma(i){
  var a = [];
  var esp =["Quien soy","Portfolio","Contacto","Precios","Fotografía"];
  var eng =["About me","Portfolio","Contact me","Prices","Photography"];
  var ita =["Chi sono","Portfolio","Contattami","Tariffe","Fotografia"];
  var pesp =["ESP/AcercaAndreaCarrozzo.html","ESP/PortfolioAndreaCarrozzo.html","ESP/ContactameAndreaCarrozzo.html","ESP/TarifasAndreaCarrozzo","PhotograpyAndreaCarrozzo.html"];
  var peng =["ENG/AboutAndreaCarrozzo.html","ENG/PortfolioAndreaCarrozzo.html","ENG/ContactmeAndreaCarrozzo.html","ENG/PricesAndreaCarrozzo","PhotograpyAndreaCarrozzo.html"];
  var pita =["ITA/SuAndreaCarrozzo.html","ITA/PortfolioAndreaCarrozzo.html","ITA/ContattamiAndreaCarrozzo.html","ITA/TariffeAndreaCarrozzo","PhotograpyAndreaCarrozzo.html"];
  switch(i){
  case 1:
    a = esp;
    b = pesp;
  break;
  case 2:
    a=eng;
    b=peng;
  break;
  case 3:
    a = ita;
    b = pita;
  break;
  default:
    a = esp;
    b = pesp;
  break;
  }
  $('#AndreaCarrozzo').attr("value",a[0]);
  $('#AndreaCarrozzo').attr("title",b[0]);
  $('#portfolio').attr("value",a[1]);
  $('#portfolio').attr("title",b[1]);
  $('#contact').attr("value",a[2]);
  $('#contact').attr("title",b[2]);
  $('#tarifas').attr("value",a[3]);
  $('#tarifas').attr("title",b[3]);
  //hago aparecer los textos
  $('#AndreaCarrozzo').fadeIn('slow');
  $('#portfolio').fadeIn('slow');
  $('#contact').fadeIn('slow');
  $('#tarifas').fadeIn('slow');
  }
    function next(gallery, max){
    var seed = $('#'+gallery).attr('seed');
    var next = (seed*1.0+1);
    $('#'+gallery+'prev').css('visibility','visible'); 
    $('#'+gallery+'button'+seed).removeClass('active');
    $('#'+gallery).attr('seed',next);
    $('#'+gallery+seed).slideUp('slow');
    if(next == max){
     $('#'+gallery+'next').css('visibility','hidden'); 
    }
    $('#'+gallery+'button'+next).addClass('active');
  }
  function prev(gallery, min){
    var seed = $('#'+gallery).attr('seed');
    var prev = (seed-1);
    $('#'+gallery+'next').css('visibility','visible'); 
    $('#'+gallery+'button'+seed).removeClass('active');
    $('#'+gallery+prev).slideDown('slow');
    $('#'+gallery).attr('seed',prev);
    if(prev == min){
     $('#'+gallery+'prev').css('visibility','hidden'); 
    }
    $('#'+gallery+'button'+prev).addClass('active');
  }
    function gotoficha(gallery, max,min,n){
    var seed = $('#'+gallery).attr('seed');
    $('#'+gallery+'button'+seed).removeClass('active');
    if(n >seed){
      for(var i = seed; i<n;i++){
       next(gallery, max);
      }
    }
    if(n <seed){
      for(var i = seed; i>n;i--){
       prev(gallery, min);
      }
    }
    $('#'+gallery+'button'+n).addClass('active');
  }