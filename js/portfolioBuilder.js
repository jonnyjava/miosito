  function buildPortfolio(lang){
    var sections = ["work","free","demo","uni"];
    switch(lang){
      case 'ESP':
        var titles = ["Trabajos","Proyectos como Freelance","Productos y Demos","Proyectos Universitarios"];  
        break;
      case 'ENG':
        var titles = ["Works","Projects as Freelance","Products and Demos","University projects"];  
        break;
      case 'ITA':
        var titles = ["Lavori","Progetti come Freelance","Productos y Demos","Proyectos Universitarios"];  
        break;
      default:
        var titles = ["","","",""];
    }
    buildRows(sections, titles);
    buildContentFromJson(lang);
  }

  function buildContentFromJson(locale){
    buildStructure();
    embedTexts(locale);
  }
  
  function buildRows(sections, titles){
    var portfoliorow = "";
    var rowcontainer = "";
    for(var i = 0; i<sections.length; i++){
      rowcontainer += buildSection(sections[i], titles[i]);
      if (i%2==1&&i>0){
        portfoliorow += "<div class='row'>"+rowcontainer+"</div>";
        rowcontainer = "";
      }
    }
    $('.js_porfolio').append(portfoliorow);
  }

  function buildSection(section, title){
    container = "<div class='containerficha js_embed' data-tag='"+section+"'></div><div id='"+section+"_navigator'></div>";
    portfolio = "<div class='texto portfolio'>"+container+"</div>"
    section = "<span class='icon "+section+"'></span><span>"+title+"</span>";
    subtitle = "<div class='subtitulo'>"+section+"</div>";
    content = "<div class='eight columns alpha box'>"+subtitle+portfolio+"</div>";
    return content;
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