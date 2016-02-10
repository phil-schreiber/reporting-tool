
  
var mainModule = function (jq, is) {
 
  var viewportW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      viewportH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  var baseurl;
  var dummyEmpty=function(){};
  var lang=jq('#lang').val();
  
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
  var initIsotope=function(){
        var isotopeCont=new is('#isotope',{
                itemSelector: '.element-item',
                layoutMode: 'fitRows'                
              });
        var selectFilters = [];      
        var radioFilter='';
        jq('#filters').on( 'change', 'select', function(e) {           
           var filterValue = jq( this ).val();                                        
           if(filterValue){
            selectFilters.push('.'+filterValue);
            selectFilters.push(radioFilter);
            var filterStrng = selectFilters.join('');            
                isotopeCont.arrange({ filter: filterStrng  });
           }else{
               selectFilters=[];
               isotopeCont.arrange({ filter: '*'});
           }
        });
        jq('#filters').on( 'change', 'input[type="radio"]', function(e) {           
            var filterValue= jq(this).val();
            var filterStrng = selectFilters.join('');            
                isotopeCont.arrange({ filter: filterStrng+'.'+filterValue  });
        });
        
        jq('#filters').on('change','input[type="text"]',function(e){
            var filterValue= jq(this).val().split('.');
            var tstamp=Date.parse(filterValue[1]+'-'+filterValue[0]+'-'+filterValue[2])/1000;
            var largerThan=true;
            if(jq(this).attr('id')==='enddate'){
                tstamp+=86399;
                largerThan=false;
            }
            
            isotopeCont.arrange({
                filter: function(  ) {
                    var returnVal=false;
                    
                    var number = jq(this).attr('data-tstamp');
                    console.log(number);
                    if(largerThan){
                        returnVal=parseInt( number, 10 ) > tstamp;
                    }else{
                        returnVal=parseInt( number, 10 ) < tstamp;
                    }
                    return returnVal;
                  }
            })
            
        });
    };
  return {
      
    init:function(){
        
      jq('.datepicker').datetimepicker({
		lang:lang,
                timepicker:false,
                format:'d.m.Y'
	}); 
      jq("#topic").chosen({max_selected_options: 5});
      initIsotope();
   
        
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
 
};


    
  


	
  
