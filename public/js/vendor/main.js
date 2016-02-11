var isotopeModule = function(jq,is){
    
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
        jq('button[type="reset"]').on('click',function(e){
            isotopeCont.arrange({ filter: '*'  });
        });
        jq('#filters').on( 'change', 'input[type="radio"]', function(e) {           
            radioFilter=jq(this).val();
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
                    var addFiltersResult = false;
                    if(radioFilter.length >0){
                        if(jQuery(this).hasClass(radioFilter)){
                            addFiltersResult=true;
                        }
                        
                    }else{
                        addFiltersResult = true;
                    }

                    var returnVal=false;                    
                    var number = jq(this).attr('data-tstamp');                    
                    if(largerThan){
                        returnVal=parseInt( number, 10 ) > tstamp;
                    }else{
                        returnVal=parseInt( number, 10 ) < tstamp;
                    }
                    if(addFiltersResult && returnVal){
                        return true;
                    }
                    
                  }
            })
            
        });
    
};
  
var mainModule = function (jq, is) {
 
  var viewportW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      viewportH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  var baseurl;
  var dummyEmpty=function(){};
  var lang=jq('#lang').val();
  

  
  return {
      
    mainController:function(){
        
      jq('.datepicker').datetimepicker({
		lang:lang,
                timepicker:false,
                format:'d.m.Y'
	}); 
      jq("#topic").chosen({max_selected_options: 5});
      new isotopeModule(jq,is);
   
        
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


    
  


	
  
