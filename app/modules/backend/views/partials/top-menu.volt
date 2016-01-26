{%- if session.get('auth') -%}
<header>
	
	
	
	
	<nav class="navbar navbar-reverse" role="navigation">
		<div id="headerLeft">
	<div id="logo">
		<a href="{{ baseurl }}" title="Home">{{image('images/logo.png')}}</a>
	</div>
	</div>
		<div id="pageTitle">
			<h1>Newsletter Tool</h1>
		</div>
		<ul class="sercive-nav navbar-right">						
			<li>{{ link_to('', '<span class="glyphicon glyphicon-home"></span>', 'title': 'Home') }}</li>			
			<li>{{ link_to('session/logout/', '<span class="glyphicon glyphicon-off"></span>', 'title': 'Logout') }}</li>			
		</ul>
		
	
		

			


		
	  
	</nav>
	
	<div class="clearfix"></div>
	
</header>
{%- endif -%}