<?php use Phalcon\Tag as Tag ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		 {{ get_title() }}        
	{{ stylesheet_link('css/bootstrap.min.css') }}		
        {{ stylesheet_link('css/font-awesome/css/font-awesome.css') }}
        {{ stylesheet_link('css/smart-forms.css') }}		
        {{ stylesheet_link('css/smart-addons.css') }}		
        {{ stylesheet_link('css/MegaNavbar.css') }}		
        {{ stylesheet_link('css/denkfabrikscheme.css') }}		
        {{ stylesheet_link('css/owl.carousel.css') }}		
        {{ stylesheet_link('css/jquery.datetimepicker.css') }}		        
        {{ stylesheet_link('css/jquery.dataTables.css') }}		                        
        {{ stylesheet_link('css/styles.css') }}     
		{{ assets.outputCss() }}
		
		
		{{ assets.outputJs() }}
                <script data-main="{{ baseurl }}js/vendor/plugins" src="{{ baseurl }}js/require.js"></script>
		
	
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="wrapper">
        
        {{content()}}
        
		</div>
		
       {%- if session.get('auth') -%}
	   <input id="suredel" value="{{tr('suredel')}}" type="hidden">
	   <input id="controller" value="{{controller}}" type="hidden">
	   <input id="lang" value="{{language}}" type="hidden">
		
		{%- endif -%}
		<input id="baseurl" value="{{baseurl}}" type="hidden">
    </body>
</html>