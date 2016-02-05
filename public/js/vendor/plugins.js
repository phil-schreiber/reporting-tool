require.config({
	
    paths: {        
        jquery: 'jquery-1.11.1.min',//'jquery-1.10.2.min',		
	datetimepicker:'jquery.datetimepicker',
	datatables:'jquery.dataTables',	
        isotope:'jquery.isotope',
        main: 'main',
    }
});

require(['jquery'], function( jQuery ) {	
    
        require(['datetimepicker'],function(){
            require(['isotope'],function(){
                require(['main']);	    					
            });
            
        });
	
});

