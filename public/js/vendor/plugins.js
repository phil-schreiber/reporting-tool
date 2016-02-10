require.config({
	
    paths: {        
        jquery: 'jquery-2.2.0.min',//'jquery-1.10.2.min',		
	datetimepicker:'jquery.datetimepicker',
	datatables:'jquery.dataTables',	
        isotope:'isotope.pkgd',
        chosen:'chosen.jquery',
        main: 'main'
    },
    shim: {
    'datetimepicker':['jquery'],
    'datatables':['jquery'],
    'isotope':['jquery'],
    'chosen':['jquery'],
    'main':['jquery','datatables','datetimepicker','isotope','chosen']
      }
});

require(['jquery','datetimepicker','isotope','main'], function( $,datetimepicker,isotope ) {	       
    
        $( document ).ready( function(jQuery) {
            var main=new mainModule($,isotope);
            main.init();
            
            
        });
});

