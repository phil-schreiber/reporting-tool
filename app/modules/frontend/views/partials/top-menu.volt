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
		
		
		  <ul class="nav navbar-nav">
			  
			  
			  
			  {% if linkAllowed(session.get('auth'),'templateobjects','index') %}		
			  {% if 'templateobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/templateobjects', tr('templateobjects')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('templateobjects')) -}}
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'templateobjects','create') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'templateobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/templateobjects/create/',tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'templateobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/templateobjects/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>
			{% endif %}
			
			{% if linkAllowed(session.get('auth'),'configurationobjects','index') %}		
			  {% if 'configurationobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/configurationobjects', tr('configurationobjects')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('configurationobjects')) -}}
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'configurationobjects','create') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'configurationobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/configurationobjects/create/', tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'configurationobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/configurationobjects/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>
			{% endif %}
			
			{% if linkAllowed(session.get('auth'),'addressfolders','index') %}		
			{% if 'addressfolders' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/addressfolders', tr('addressfolders')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('addressfolders')) -}}
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'addressfolders','index') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'addressfolders' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/addressfolders/create/', tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'addressfolders' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/addressfolders/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% endif %}
			{% if linkAllowed(session.get('auth'),'segmentobjects','index') %}		
			{% if 'segmentobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/segmentobjects', tr('segmentobjects')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('segmentobjects')) -}}
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'segmentobjects','create') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'segmentobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/segmentobjects/create/', tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'segmentobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/segmentobjects/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% endif %}
			
			{% if linkAllowed(session.get('auth'),'distributors','index') %}		
			  {% if 'distributors' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/distributors', tr('distributors')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('distributors')) -}}
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'distributors','create') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'distributors' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/distributors/create/', tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'distributors' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/distributors/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% endif %}
			{% if linkAllowed(session.get('auth'),'mailobjects','index') %}		
			  {% if 'mailobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/mailobjects', tr('mailobjects')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('mailobjects')) -}}
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'mailobjects','create') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'mailobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/mailobjects/create/', tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'mailobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/mailobjects/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>
			{% endif %}
			{% if linkAllowed(session.get('auth'),'campaignobjects','index') %}		
			   {% if 'campaignobjects' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/campaignobjects', tr('campaign')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('campaign')) -}}				
				<ul class="dropdown-menu submenu">
					{% if linkAllowed(session.get('auth'),'campaignobjects','create') %}		
					<li {% if 'create' == dispatcher.getActionName() AND 'campaignobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/campaignobjects/create/', tr('create'), 'title': tr('create')) }}</li>
					{% endif %}
					<li {% if 'index' == dispatcher.getActionName() AND 'campaignobjects' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/campaignobjects/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>
			{% endif %}
			{% if linkAllowed(session.get('auth'),'review','index') %}		
			  {% if 'review' == dispatcher.getControllerName() %}
              <li class="dropdown active">
              {% else %}
			 <li class="dropdown">
              {% endif %}
				{{- link_to(language~'/review', tr('review')~' <span class="glyphicon glyphicon-chevron-down"></span>', 'title': tr('review')) -}}
				<ul class="dropdown-menu submenu">					
					<li {% if 'index' == dispatcher.getActionName() AND 'review' == dispatcher.getControllerName() %} class="active" {% endif %}>{{ link_to(language~'/review/index/', tr('retrieve'), 'title': tr('retrieve')) }}</li>
				</ul>
			</li>	
			{% endif %}
			{% if linkAllowed(session.get('auth'),'report','index') %}		
			{% if 'report' == dispatcher.getControllerName() %}
              <li class="active">
              {% else %}
			 <li>
              {% endif %}
				{{- link_to(language~'/report', tr('report'), 'title': tr('report')) -}}
				
			</li>	
			{% endif %}
			  			
			
				
			
			
		  </ul>	
		

			


		
	  
	</nav>
	
	<div class="clearfix"></div>
	
</header>
{%- endif -%}