  function buildPageFromJson(locale){
    buildStructure();
    embedTexts(locale);
  }

  function buildPage(deck){
    $.each(deck, function(key, val) {
      $("div[data-tag='"+key+"']").append(deck[key]);
      $("#"+key+"_navigator").load("partials/_"+key+"_navigator.html");
    });
  }

  function embedTexts(locale){
    jsonfile = "partials/portfolio"+locale+".json";
    $.getJSON(jsonfile,{}).done(function(data){
      $.each(data, function(key, val) {
        $.each( val, function( index, item ) { 
          texto = "<p><b>"+item.title+"</b><br/>"+item.description+"</p>";
          card = $("div[data-name='"+key+"-"+index+"']");
          card.html(texto);
        });
      });
    });
  }

  function buildStructure(){
    var deck = {};
    $.getJSON("partials/portfolioStructure.json",{}).done(function(data){
      $.each(data, function(key, val) {
        deck[key] = "";
      });
      $.each(data, function(key, val) {
        deck[key] += createDeck(key, val);
      });
      buildPage(deck);
    });
  }

  function createDeck(key, val){
    var deck = "";
    $.each( val, function( index, item ) {
      var image = getImage(item);
      var allTexts = getTexts(key, index);
      var link = getLink(item);
      var icons = createIcons(item.icons.split(", "));
      var card = "<div class='containerficha'><div id='"+key+"container"+(index+1)+"' class='ficha'>"+image+"<div class='three columns alpha omega'>"+icons+link+"</div>"+allTexts+"</div></div>";
      deck += card;
    });
    return deck;
 }

  function getLink(item){
    linkToPage = "<div class='link'><span>Ir a la pagina web</span><div class='bottonemini go'></div></div>"
    return "<a href='"+item.link+"' target='_blank' class='js_linkToPage'>"+linkToPage+"</a>";
  }

  function getImage(item){
    return "<div class='four columns'><img src='img/"+item.image+".png' alt='"+item.title+"' title='"+item.title+"' class='ficha' border='0' /></div>";
  }

  function getTexts(key,index){
    return "<div class='seven columns' data-name="+key+"-"+index+"></div>";
  }

  function createIcons(arrayIcons){
   var icons = "<div class='board'>";
   for(var i = 0; i< arrayIcons.length; i++){
     if(i%2==0){ icons += "<div class='omega bigicon "+arrayIcons[i]+"'></div>"; }
     else{ icons += "<div class='bigicon "+arrayIcons[i]+"'></div>"; }
   }
   icons += "</div>";
   return icons;
  }