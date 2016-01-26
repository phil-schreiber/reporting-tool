{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">	
	<div class="desktop">
		
		<h1>{{tr('actionTitle')}}</h1><br>
		{% if linkAllowed(session.get('auth'),'feusers','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to('backend/'~language~'/feusers/index/', tr('feusersIndexTitle'), 'title': tr('feusers')) }}
			</h1>
			<ul>
			<li>{{ link_to('backend/'~language~'/feusers/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
			<li>{{ link_to('backend/'~language~'/feusers/update/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'profiles','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to('backend/'~language~'/profiles/index/',tr('profiles'), 'title': tr('profiles')) }}
			</h1>
			<ul>
			<li>{{ link_to('backend/'~language~'/profiles/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
			<li>{{ link_to('backend/'~language~'/profiles/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
			</ul>
		</div>
		{% endif %}
		
		
		
		<div class="ceElement xs">
			
			<h1>{{ link_to('', tr('frontend'), 'title': tr('frontend')) }}
			</h1>			
			
		</div>
		
	</div>
</div>