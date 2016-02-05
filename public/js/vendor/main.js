

  
var mainModule = (function (jq) {
 
  var viewportW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      viewportH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  var baseurl;
  var dummyEmpty=function(){};
  var lang=jq('#lang').val();
  var isotopeCont=jq('.isotope').isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows',
                getSortData: {
                  name: '.name',
                  symbol: '.symbol',
                  number: '.number parseInt',
                  category: '[data-category]'
                  
                }
              });

  var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function() {
          var number = $(this).find('.number').text();
          return parseInt( number, 10 ) > 50;
        },
        // show if name ends with -ium
        ium: function() {
          var name = $(this).find('.name').text();
          return name.match( /ium$/ );
        }
      };
      
  return {
      
    init:function(){
      jq('.datepicker').datetimepicker({
		lang:lang
	}); 
        
       

        
        
    },
    initIsotope:function(){
        jq('#filters').on( 'change', 'input', function(e) {
           console.log(e);
        var filterValue = jq( this ).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        isotopeCont.isotope({ filter: filterValue });
      });
    },
    // A public function utilizing privates
    ajaxIt: function(controller,action,formdata,successhandler, parameters) {
            parameters = typeof parameters !== 'undefined' ? '/'+parameters : '';
              if(successhandler !== dummyEmpty){
              jq('#loadingimg').show();
              }

              jq.ajax({
                      url: baseurl+controller+'/'+action+parameters,
                      cache: false,
                      async: true,
                      data: formdata,   
                      type: 'POST',
                      success: function(data) {
                              jq('#loadingimg').hide();	
                              successhandler(data);
                      },
                      error: function(e){			
                              jq('#loadingimg').hide();
                              }
                      });
    },
    

      // filter functions
      

      // bind filter button click
     
    
  };
 
})(jQuery);

mainModule.init();
	
  
