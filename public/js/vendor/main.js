var mainModule = (function (jq) {
 
  var viewportW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      viewportH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  var baseurl;
  var dummyEmpty=function(){};
  var lang=jq('#lang').val();
  
 
  return {
      
    init:function(){
      jq('.datepicker').datetimepicker({
		lang:lang
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
        }
  };
 
})(jQuery);

mainModule.init();
	
