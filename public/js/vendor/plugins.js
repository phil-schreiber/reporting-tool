require.config({
	
    paths: {        
        jquery: 'jquery-2.2.0.min',//'jquery-1.10.2.min',		
	datetimepicker:'jquery.datetimepicker',
	datatables:'jquery.dataTables',	
        isotope:'isotope.pkgd',
        chosen:'chosen.jquery',
        bootstrap:'bootstrap.min',
        timeline: 'jquery.timelineMe',
        main: 'main'
    },
    shim: {
    'datetimepicker':['jquery'],
    'datatables':['jquery'],
    'isotope':['jquery'],
    'chosen':['jquery'],
    'bootstrap':['jquery'],
    'timeline':['jquery'],
    'main':['jquery','datatables','datetimepicker','chosen','timeline']
      }
});

require(['jquery','datetimepicker','bootstrap','main'], function( $,datetimepicker ) {	       
    
        $( document ).ready( function(jQuery) {
            var main=new mainModule($);
            main.mainController();
            
            
        });
});

