<?php
$uri = $_SERVER['REQUEST_URI'];
if (substr($uri,strlen($uri)-1,1) == "/") {
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mongabay Geospatial News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">

    <link rel="stylesheet" href="http://libs.cartodb.com/cartodb.js/v3/themes/css/cartodb.css" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="http://libs.cartocdn.com/cartodb.js/v3/themes/css/cartodb.ie.css" />
    <![endif]-->
    <style>
      body {
        min-width: 800px;
      }
      #map {
        width: 100%; height: 529px;
        display: block;
        float: left; position: absolute; z-index:0;
      }
      .navbar-inverse .navbar-inner {
        background-image: none;
        background-repeat: no-repeat;
        filter: none;
        background-color: #8cc640;
      }

      .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus {
        color: #8cc640;
      }

      li.active {
        background-color:gray;
      }

      .masthead .containerx {
        background-color: transparent;
        position: static;
        width: 550px;
        height: 428px;
        padding: 0 0px;
        margin: 0 0 0 50px;
        z-index:30;
        pointer-events:none;
        position:relative;
        top:-8px;

      }


      .masthead .mongabay-search-box {
        top:-436px;
        height:0px;
        margin:none;
        float:right;
        left:-10px;
      }


      .masthead-search {
        float: left; position: relative;
        margin-top: 0px;
        line-height: 80px;
        width: 100%;
        color: #fff;
        background-color: #393e4a;
        background-color: rgba(57,62,75,0.95);
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        -khtml-border-radius: 6px;
        border-radius: 6px;
      }
      .masthead-search .mb-title {
        float: left; width: 90%; line-height: 40px; font-size: 38px;
        padding: 12px 8px 2px 20px; margin: 0; text-align: left;
        font-weight: bold;
        text-transform: uppercase;
        font-family: "Proxima Nova", sans-serif;
      }
      .masthead-search .mb-sub-title {
        float: left; width: 90%; line-height: 25px; font-size: 22px;
        padding: 2px 8px 2px 20px; margin: 0; text-align: left;
        color: #ddd;
      }
      .masthead-search .mb-sub-title-desc {
        float: left; width: 90%; line-height: 25px; font-size: 22px;
        padding: 2px 8px 10px 20px; margin: 0; text-align: left;
        color: #ddd;
      }
      .masthead-search .mb-input{
        float: left; width: 375px; line-height: 40px; font-size: 32px;
        margin: 2px 0 10px 20px; padding: 5px; text-align: left;
        pointer-events:auto;
      }
      .masthead-search .mb-input-button{
        float: left;
        width: 115px;
        height: 54px;
        margin-top: 2px;
        padding: 0px 8px 0 8px;
        font: bold 32px Arial;
        color: #FFFFFF;
        background: #8cc640;
        border: none;
        letter-spacing: -1px;
        cursor: pointer;
        pointer-events:auto;
      }
      .masthead-links {
        float: left; position: relative;
        width: 97%;
        margin-left:1.5%;
        color: #000;
        pointer-events:auto;
        
        background-color:#ccc;
        border-bottom-left-radius:6px;
        border-bottom-right-radius:6px;
        border:solid 1px #393e4a;

      }
      .masthead-links a {
        color: #000;
        cursor: pointer;
      }
      .masthead-links a:hover {
        color: #888;
      }

    .article-slide {
      margin-top:20px;
    }

    .carousel {
      margin-bottom: 60px;
      margin-left: -20px;
      margin-right: -20px;
      height: 200px;
      overflow: visible;
    }

    .carousel .container {
      position: relative;
      float: left;
      height: 100%;
      z-index: 9;
      width:99%;
    }

    .carousel-control {
      height: 80px;
      margin-top: 0;
      font-size: 120px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;
    }

    .carousel .item {
      height: 280px;
      padding-left: 60px;
    }
    .carousel-img {
      position: relative; float: left;
      margin: 10px 20px 0 0;
      padding: 12px 0 12px 12px;
      border: 1px solid #393e4a;
      border: 1px solid rgba(57,62,75,0.95);
      width: 162px;
      -moz-border-radius: 6px;
      -webkit-border-radius: 6px;
      -khtml-border-radius: 6px;
      border-radius: 6px;
    }
    .carousel-img img {
      width: 150px;   
      height: 100px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 90%;
      padding: 0 20px;
      margin-top: 10px;
    }
    .carousel-caption h1 {
      margin: 0;
      line-height: 1.25;
      color: #fff;
        color: #393e4a;
        color: rgba(57,62,75,0.95);
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
        font-size: 30px;
    }
    .carousel-caption .lead {
      margin: 0;
      padding-top: 10px;
      line-height: 1.25;
      color: #fff;
        color: #393e4a;
        color: rgba(57,62,75,0.95);
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
        font-size: 20px;
    }
      .carousel-caption .btn {
        font-size: 18px;
        margin-top: 10px;
      }
      .cartodb-popup-content-wrapper{
        z-index: 1000;
      }

      .cartodb-popup-content .btn-large {
        position:relative;
        margin-top:10px;
        margin-left:auto;
        margin-right:auto;
        color:white;
        width:78%;
      }

      .cartodb-popup-content .btn-large:hover {
        color:black;
      }

      .masthead-search .mb-input {
        border-top-left-radius:8px;
        border-bottom-left-radius:8px;
      }

      .masthead-search .mb-input-button {
        border-top-right-radius:6px;
        border-bottom-right-radius:6px;
        font:normal 30px Arial;
      }
      .masthead-search .mb-input-button:hover {
        color:#44aa44;
      }

      .mongabay-search-box {
        position:absolute;
      }

    </style>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">


  <script type="infowindow/html" id="infowindow_template">
    <div class="cartodb-popup">
      <a href="#close" class="cartodb-popup-close-button close">x</a>

       <div class="cartodb-popup-content-wrapper">
         <div class="cartodb-popup-content">
           <p>
            <div style="color:black;font-size:18px;line-height:19px;text-align:center;width:100%;font-weight:bold;clear:both;">
              {{content.data.title}}
              <br />
              <span style="font-weight:normal; font-size:65%;"><!--Published: -->
              {{content.data.published}}
              </span>
              </div>
            <a class="btn btn-primary btn-large" href="{{content.data.loc}}" target="_blank" style="clear:both;">Read Full Article</a>
           
           <!--<p>{{content.data.description}}</p>-->
         </div>
       </div>
       <div class="cartodb-popup-tip-container"></div>
    </div>
  </script>

  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar">


    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="//www.mongabay.com/">Mongabay</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="//www.mongabay.com/" style="color:white;">Home</a>
              </li>
              <li class="">
                <a href="//news.mongabay.com/" style="color:white;">News Home</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

<div class="map" id="map"></div>
<div class="jumbotron masthead">
  <div class="containerx">
    <div class="masthead-search">
      <div class="mb-title">Environmental News</div>
      <div class="mb-sub-title">Access the latest geospatial news</div>
      <div class="mb-sub-title-desc" style="font-size:80%;">Click and drag the map to change position. Zoom in and out using the +/- buttons on the top left.</div>


    </div>

  </div>

  <div class="containerx mongabay-search-box">
    <div class="masthead-search" style="padding-top:20px;padding-bottom:10px;">

      <input class="mb-input" id="mb-input-search-term"></input>
      <input class="mb-input-button" type="submit" value="Search">

    </div>
    <ul class="masthead-links">
      <li style="color:black;font-weight:bold;">
        Popular:
      </li>
      <li>
        <a style="font-size:80%;position:relative;top:-1px;">Deforestation</a>
      </li>
      <li>
        <a style="font-size:80%;position:relative;top:-1px;">Indonesia</a>
      </li>
      <li>
        <a style="font-size:80%;position:relative;top:-1px;">Palm Oil</a>
      </li>
      <li>
        <a style="font-size:80%;position:relative;top:-1px;">Amazon</a>
      </li>
      <li>-
      </li>
      <li>
        <a class="clear" style="padding-left:0px;font-weight:bold;">Clear Search</a>
      </li>
    </ul>
  </div>

</div>




    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide article-slide">
      <div class="carousel-inner">
        <div class="item active">
          <div class="container">
            <div class="carousel-caption">
              <a class="article-href">
                <h1 class="article-title"></h1>
                <div class="carousel-img"></div>
              </a>
              <p class="lead"></p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container">
            <div class="carousel-caption">
              <a class="article-href">
              <h1 class="article-title">a</h1>
                <div class="carousel-img"></div>
            </a>
              <p class="lead"></p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container">
            <div class="carousel-caption">
              <a class="article-href">
              <h1 class="article-title">a</h1>
              <div class="carousel-img"></div>
            </a>
              <p class="lead"></p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container">
            <div class="carousel-caption">
              <a class="article-href">
              <h1 class="article-title">a</h1>
              <div class="carousel-img">
                
              </div>
            </a>
              <p class="lead"></p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container">
            <div class="carousel-caption">
              <a class="article-href">
              <h1 class="article-title">a</h1>
              <div class="carousel-img">
                
              </div>
            </a>
              <p class="lead"></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->


</div>

    <footer class="footer">
      <div class="container">
        <p>Please note, the geospatial map mostly includes stories posted after January 1, 2013.</p>
        <p>We are continually working to add older stories to the system.</p>
        <p>&copy; 2013, Mongabay</p>
      </div>
    </footer>

    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/bootstrap-affix.js"></script>

    <script src="js/holder/holder.js"></script>
    <script src="js/google-code-prettify/prettify.js"></script>

    <script src="js/application.js"></script>
    <script src="http://libs.cartocdn.com/cartodb.js/v3/cartodb.js"></script>
    <script>

    function main() {

      var map = L.map('map', { 
        zoomControl: true,
        center: [20, 20],
        zoom: 3
      });

      // add a nice baselayer from mapbox
      L.tileLayer("https://dnv9my2eseobd.cloudfront.net/v3/cartodb.map-41exmwk3/{z}/{x}/{y}.png", {
        attribution: 'Mapbox <a href="http://mapbox.com/about/maps" target="_blank">Terms &amp; Feedback</a>'
      }).addTo(map);


      var mapLayer;

      var layerUrl = {
        json: 'http://mongabay.cartodb.com/api/v2/viz/61cc0450-a48a-11e3-ae10-0e10bcd91c2b/viz.json'
      };
      
      var mapLayer, subLayer;

      cartodb.createLayer(map, layerUrl.json,{infowindow:true}).addTo(map)
        .on('done', function(layer){
          mapLayer = layer;
          mapLayer.setInteraction(true);
          subLayer = mapLayer.getSubLayer(0);
          subLayer.setInteraction(true);
      //    subLayer.infowindow.set('template', $('#infowindow_template').html());
          subLayer.on('featureClick', function(e, latlng, pos, data) {

            var b = map.getBounds();
            var c = (b.getSouthEast().lng - b.getSouthWest().lng) / 6;
            var d = (b.getNorthEast().lat - b.getSouthWest().lat) / 4;
            map.panTo([latlng[0] + d, latlng[1] /* -c */ ]);
          });

        }).on('error', function(err){
        });

      var items = $('#myCarousel').find('.item');

      var sql = new cartodb.SQL({ user: 'mongabay'});
      sql.execute("SELECT * FROM mongabaydb WHERE thumbnail != '' and title != '' ORDER BY updated DESC LIMIT 5", {table_name: 'mongabaydb'},{},function(){

      
      }).done(function(data) {
          var i = 0;
          $.each(items, function(){
            $(this).find('h1').html(data.rows[i].title); 
            $(this).find('.lead').html(data.rows[i].description+"<a style=\"left:0px;position:relative;float:right;\" href=\""+data.rows[i].loc+"\">Read the full story &gt;&gt;</a>");
            var img = new Image();
            img.src = data.rows[i].thumbnail;
            $(this).find('.carousel-img').append(img);
            $(this).find('.article-href').attr("href",data.rows[i].loc);
            i++;
          }); 
      });

      $('.mb-input-button').click(function(){
        var s = $('.mb-input').val();
        mapLayer.setQuery("SELECT * FROM mongabaydb WHERE description ILIKE '%"+s+"%'");
      });
      $('.masthead-links .clear').click(function(){
        $('.mb-input').val('');
        mapLayer.setQuery("SELECT * FROM mongabaydb");
      });
      $('.masthead-links a:not(.clear)').click(function(){
        var s = $(this).html();
        mapLayer.setQuery("SELECT * FROM mongabaydb WHERE description ILIKE '%"+s+"%'");
        $('.mb-input').val(s);
      });


      $('#mb-input-search-term').keypress(function(event){
        var code = ('charCode' in event) ? event.charCode : event.keyCode;
        if (code === 13) {
           var s = $('.mb-input').val();
           mapLayer.setQuery("SELECT * FROM mongabaydb WHERE description ILIKE '%"+s+"%'");
        }
        });

    }
    window.onload = main;
    function strLimitLength(str,len) { if (str.length > len) { return str.substr(0,len-2) + "..."; } else { return str; } }
</script>
<script type="text/javascript"> var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-12973256-1']); _gaq.push(['_trackPageview']); (function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })(); </script>
</body>
</html><?php 
} else {
  header("Location: {$uri}/");
  exit;
}
?>