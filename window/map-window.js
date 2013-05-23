
    function loadNewsMap() {

      var newsMap = L.map('news-map', { zoomControl: true,
        center: [20, 20],
        zoom: 2
      })

      L.tileLayer("https://dnv9my2eseobd.cloudfront.net/v3/cartodb.map-41exmwk3/{z}/{x}/{y}.png", {
        attribution: 'MapBox'
      }).addTo(newsMap);



      var newsMapLayer;
      var layerUrl = 'http://mongabay.cartodb.com/api/v1/viz/21719/viz.json';
      cartodb.createLayer(newsMap, layerUrl, function(layer) {
         newsMapLayer = layer;
         newsMapLayer.infowindow.set('template', $('#infowindow_template').html());
         newsMapLayer.on('featureClick', function(e, latlng, pos, data) {
          var b = newsMap.getBounds();
          var c = (b.getSouthEast().lng - b.getSouthWest().lng) / 6;
          var d = (b.getNorthEast().lat - b.getSouthWest().lat) / 4;
          newsMap.panTo([latlng[0] + d, latlng[1] /* -c */ ]);
         });
         newsMap.addLayer(newsMapLayer);
      });

      var items = $('#myCarousel').find('.item');

      var sql = new cartodb.SQL({ user: 'mongabay'});
      sql.execute("SELECT * FROM {{table_name}} WHERE thumbnail != '' and title != '' ORDER BY updated DESC LIMIT 5", {table_name: 'mongabaydb'},{},function(){
      })
        .done(function(data) {
          var i = 0;
          $.each(items, function(){
            $(this).find('h1').html(data.rows[i].title);     $(this).find('.lead').html(data.rows[i].description+"<a style=\"left:0px;position:relative;float:right;\" href=\""+data.rows[i].loc+"\">Read the full story &gt;&gt;</a>");
            var img = new Image();
            img.src = data.rows[i].thumbnail;
            $(this).find('.carousel-img').append(img);
            $(this).find('.article-href').attr("href",data.rows[i].loc);
            i++;
          }); 
      });

      $('.mb-input-button').click(function(){
        var s = $('.mb-input').val();
        newsMapLayer.setQuery("SELECT * FROM {{table_name}} WHERE description ILIKE '%"+s+"%'");
      });
      $('.masthead-links .clear').click(function(){
        $('.mb-input').val('');
        newsMapLayer.setQuery("SELECT * FROM {{table_name}}");
      });
      $('.masthead-links a:not(.clear)').click(function(){
        var s = $(this).html();
        newsMapLayer.setQuery("SELECT * FROM {{table_name}} WHERE description ILIKE '%"+s+"%'");
        $('.mb-input').val(s);
      });


      $('#mb-input-search-term').keypress(function(event){
        var code = ('charCode' in event) ? event.charCode : event.keyCode;
        if (code === 13) {
           var s = $('.mb-input').val();
           newsMapLayer.setQuery("SELECT * FROM {{table_name}} WHERE description ILIKE '%"+s+"%'");
        }
        });


    }


  function strLimitLength(str,len) { if (str.length > len) { return str.substr(0,len-2) + "..."; } else { return str; } }