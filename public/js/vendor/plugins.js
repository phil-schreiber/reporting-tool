require.config({
	
    paths: {        
        jquery: 'jquery-2.2.0.min',//'jquery-1.10.2.min',		
	datetimepicker:'jquery.datetimepicker',
	datatables:'jquery.dataTables',	
        isotope:'isotope.pkgd',
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

