require.config({
	
    paths: {        
        jquery: 'jquery-1.11.1.min',//'jquery-1.10.2.min',		
	datetimepicker:'jquery.datetimepicker',
	datatables:'jquery.dataTables',	
        main: 'main',
    }
});

require(['jquery'], function( jQuery ) {	
	require(['main']);	    					
});

