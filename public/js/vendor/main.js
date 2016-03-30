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
            });
            
        });
    
};

var projectClippings=function(jq){
    var projectuid=jq('#projectuid').val();
    
    var dt = jq('#clippings').dataTable({
            "bProcessing": true,	        
            "sAjaxSource": baseurl+"projects/update/",
            "bServerSide": true,        
            "sServerMethod": 'POST',
            "oLanguage": {
                    "sSearch": "Suchen:",
                    "sLengthMenu": "_MENU_ Einträge anzeigen",
                    /*"sInfo": "Es werden Einträge _START_ bis _END_ von insgesamt _TOTAL_ angezeigt",
                    "sInfoEmpty": "keine passenden Veranstaltungen gefunden",*/
                    "sInfoFiltered":"(gefiltert von _MAX_  Einträgen)",
                    "oPaginate":{
                            "sPrevious" : "Vorherige",
                            "sNext" : "Nächste"
                            }
            },
            "fnServerParams": function ( aoData ) {

                    aoData.push( { "name": "projectuid","value":projectuid} );
            }
            });
    
};

var clippings=function(jq){
   
   var filters=[];
    jq('#filterForm').on( 'submit', function(e) {           
        e.preventDefault();
        filters=jq(this).serializeArray();                
        
        dt.fnDraw();
     });	
	
    var dt = jq('#clippings').dataTable({
            "bProcessing": true,	        
            "sAjaxSource": baseurl+"clippings/index/",
            "bServerSide": true,        
            "sServerMethod": 'POST',
            "oLanguage": {
                    "sSearch": "Suchen:",
                    "sLengthMenu": "_MENU_ Einträge anzeigen",
                    /*"sInfo": "Es werden Einträge _START_ bis _END_ von insgesamt _TOTAL_ angezeigt",
                    "sInfoEmpty": "keine passenden Veranstaltungen gefunden",*/
                    "sInfoFiltered":"(gefiltert von _MAX_  Einträgen)",
                    "oPaginate":{
                            "sPrevious" : "Vorherige",
                            "sNext" : "Nächste"
                            }
            },
            "fnServerParams": function ( aoData ) {
                filters.forEach(function(el){                    
                    aoData.push({"name":el.name,"value":el.value});
                });
                
   
            }
            });
    
};

var clippingsForMediumtypes = function(jq){
   
   var filters=jq('#filterForm').serializeArray();
   
	
    var dt = jq('#clippings').dataTable({
            "bProcessing": true,	        
            "sAjaxSource": baseurl+"clippings/update/",
            "bServerSide": true,        
            "sServerMethod": 'POST',
            "oLanguage": {
                    "sSearch": "Suchen:",
                    "sLengthMenu": "_MENU_ Einträge anzeigen",
                    /*"sInfo": "Es werden Einträge _START_ bis _END_ von insgesamt _TOTAL_ angezeigt",
                    "sInfoEmpty": "keine passenden Veranstaltungen gefunden",*/
                    "sInfoFiltered":"(gefiltert von _MAX_  Einträgen)",
                    "oPaginate":{
                            "sPrevious" : "Vorherige",
                            "sNext" : "Nächste"
                            }
            },
            "fnServerParams": function ( aoData ) {
                filters.forEach(function(el){                    
                    aoData.push({"name":el.name,"value":el.value});
                });
                
   
            }
            });
    
};


var projects=function(jq,ajaxIt){
   var preselect=0;
   var getTypeVal=function(){
       var radioGroup = document['filterForm']['projecttype'];
       for (var i=0; i<radioGroup.length; i++)  {
          if (radioGroup[i].checked)  {
          return( radioGroup[i].value);
          }
       }
   };
   preselect= getTypeVal();
   var filters=[];
    jq('#filterForm').on( 'submit', function(e) {           
        e.preventDefault();
        filters=jq(this).serializeArray();                
        
        dt.fnDraw();
     });	
     jq('#filterForm').on( 'reset', function(e) {           
         e.preventDefault();
        filters=[];
        jq("#filters #topic").val('').trigger("chosen:updated");
        jq("#filters input").val('');
        dt.fnDraw();
     });	
    var hideSearch="f";
    if(preselect>0){
         filters=jq('#filterForm').serializeArray();         
         hideSearch='<"hidden"f';
    }
    
     
     jq('#myModal').on('hide.bs.modal',function(){
         jq('.modal-body').html('<div id="timeline-container-basic" type="text"></div>');
     });
     
     
     jq('#projects').on('click','.statehistory',function(e){
         var projectid=jq(this).val();
         ajaxIt('projects','index','projectid='+projectid,
         function(data){
             
             jq('#timeline-container-basic').timelineMe({
                
                items:JSON.parse(data)
            });
         },
         '?statusinfo=1');
         
     });
    var dt = jq('#projects').dataTable({
            "bProcessing": true,	        
            "sAjaxSource": baseurl+"projects/index/",
            "bServerSide": true,    
            "bPaginate": false,
            "sDom":hideSearch,
            "sServerMethod": 'POST',
            "order": [[ 1, "desc" ]],
            "oLanguage": {
                    "sSearch": "Suchen:",
                    "sLengthMenu": "_MENU_ Einträge anzeigen",
                    /*"sInfo": "Es werden Einträge _START_ bis _END_ von insgesamt _TOTAL_ angezeigt",
                    "sInfoEmpty": "keine passenden Veranstaltungen gefunden",*/
                    "sInfoFiltered":"(gefiltert von _MAX_  Einträgen)",
                    "oPaginate":{
                            "sPrevious" : "Vorherige",
                            "sNext" : "Nächste"
                            }
            },
            "fnServerParams": function ( aoData ) {
                filters.forEach(function(el){                    
                    aoData.push({"name":el.name,"value":el.value});
                });
                
   
            }
            });
    
};


var baseurl;
var mainModule = function (jq, is) {
 
  var viewportW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
      viewportH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  
  var dummyEmpty=function(){};
  var lang=jq('#lang').val();
  var ajaxIt= function(controller,action,formdata,successhandler, parameters) {
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
    }; 
    
    var deleteItem=function(e){
        var element = jq(this).attr('data-element');
        if (window.confirm("Sicher?!")) { 
            jq(this).parent().html('Element exterminiert');
        ajaxIt('backend/'+jq('#lang').val()+'/'+jq('#controller').val(),'delete','uid='+element,dummyEmpty);
          }
        
    };

  
  return {
     // A public function utilizing privates
    
    mainController:function(){
      baseurl=jq('#baseurl').val();
      jq('.datepicker').datetimepicker({
		lang:lang,
                timepicker:false,
                format:'d.m.Y'
	}); 
         jq('.datetimepicker').datetimepicker({
		lang:lang,                
                format:'d.m.Y H:i'
	}); 
      jq("#filters #topic,#filters #projects").chosen({max_selected_options: 5});
      if(jq('#controller').val()==='projects' && jq('#action').val()==='index'){
        /*new isotopeModule(jq,is);*/
          new projects(jq,ajaxIt);
        }
      if(jq('#controller').val()==='projects' && jq('#action').val()==='update'){
          new projectClippings(jq);
      }
      if(jq('#controller').val()==='clippings' && jq('#action').val()==='index'){
          new clippings(jq);
      }  
      jq('.deleteListItem').click(deleteItem);
      
     /* if(jq('#controller').val()==='clippings' && jq('#action').val()==='update'){
          new clippingsForMediumtypes(jq);
      }*/
    }
    
    
    
     
    
  };
 
};


    
  


	
  
