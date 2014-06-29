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
    content = "<div class='eight columns box'>"+subtitle+portfolio+"</div>";
    return content;
  }

  function buildPage(deck){
    $.each(deck, function(key, val) {
      $("div[data-tag='"+key+"']").append(deck[key]);
      $("#"+key+"_navigator").load("partials/_"+key+"_navigator.html");
    });
  }

  function embedTexts(locale){
    jsonfile = "partials/portfolio"+locale+".txt";
    $.getJSON(jsonfile,{}).done(function(data){
      $.each(data, function(key, val) {
        $.each( val, function( index, item ) { 
          texto = "<p><b>"+item.title+"</b><br/>"+item.description+"</p>";
          card = $("div[data-name='"+key+"-"+index+"']");
          card.html(texto);
          image = $("img[data-img_attr='"+key+"-"+index+"']");
          image.attr('title', item.title);
          image.attr('alt', item.title);
          sheet = $("a[data-sheet_title='"+key+"-"+index+"']");
          sheet.attr('title', item.title.toUpperCase());
        });
      });
    });
  }

  function buildStructure(){
    var deck = {};
    $.getJSON("partials/portfolioStructure.txt",{}).done(function(data){
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
      var image = getImage(item, key, index);
      var allTexts = getTexts(key, index);
      var link = getLink(item);
      var sheet = getSheet(item, key, index);
      var icons = createIcons(item.icons.split(", "));
      var sheet_and_link = "<div class='row'>"+sheet+link+"</div>";
      var card = "<div class='containerficha'><div id='"+key+"container"+(index+1)+"' class='ficha'>"+image+"<div class='three columns'>"+icons+sheet_and_link+"</div>"+allTexts+"</div></div>";
      deck += card;
    });
    return deck;
 }

  function getSheet(item, key, index){
    linkToSheet = "<div class='link'><div class='bottonemini zoom'></div></div>"
    return "<a href='#' data-sheet_title='"+key+"-"+index+"' onclick='sheetWindow(this.title, \""+key+"\","+index+");'>"+linkToSheet+"</a>";
  }
  function getLink(item){
    linkToPage = "<div class='link'><div class='bottonemini go'></div></div>"
    return "<a href='"+item.link+"' target='_blank'>"+linkToPage+"</a>";
  }

  function getImage(item, key, index){
    return "<div class='four columns'><img src='img/"+item.image+".png' alt='"+key+"' title='' data-img_attr='"+key+"-"+index+"' class='ficha' border='0' /></div>";
  }

  function getTexts(key, index){
    return "<div class='seven columns' data-name="+key+"-"+index+"></div>";
  }

  function createIcons(arrayIcons){
   var icons = "<div class='row'>";
   for(var i = 0; i< arrayIcons.length; i++){
     if(i%2==0){ icons += "<div class='omega bigicon "+arrayIcons[i]+"'></div>"; }
     else{ icons += "<div class='bigicon "+arrayIcons[i]+"'></div>"; }
   }
   icons += "</div>";
   return icons;
  }

  function sheetWindow(mytitle, sheetkey, sheetindex){
    var locale = $('.js_porfolio').attr('data-language');
    jsonfile = "partials/projectSheets"+locale+".txt";
    graph = "<canvas id='myCanvas' style='float:left;'></canvas>";
    $.getJSON(jsonfile,{}).done(function(data){
      $.each(data, function(key, val) {
        if (key == sheetkey) {
          $.each( val, function( index, item ) { 
            if(index == sheetindex) {
              company = getSheetCompany(item.company);
              customer = "<p><b>Cliente:</b><br/>"+item.customer+"<p/>";
              description = "<p><b>Descripción:</b><br/>"+item.description+"<p/>";
              content =  "<div class='pop-up js_sheet'>"; 
              sheet = graph+"<div class='sheet_text'>"+company+customer+description+"</div>";
              content = content+sheet;
              content = content + "</div>";
              $.colorbox({html: content, width:'720px', height:'450px', maxWidth:'95%', maxHeight:'95%', title: mytitle});
              resizeCanvas();
              HoverPie.make($("#myCanvas"), item.data, {});
            }
          });
        }
      });
    });
  }

  function getSheetCompany(text){
    company = "";
    if (text.length > 0) { company = "<p><b>Empresa:</b><br/>"+text+"<p/>"; }
    return company;
  }

 function resizeCanvas(){
  popup_size = $('#colorbox').width();
  coeff = 2.25;
  canvas_size = popup_size / coeff ;
  $("#myCanvas").attr("width",canvas_size);
  $("#myCanvas").attr("height",canvas_size);
 }
