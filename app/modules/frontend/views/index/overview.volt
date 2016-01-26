{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">	
	<div class="desktop">
		
		<h1>{{tr('actionTitle')}}</h1><br>
		{% if linkAllowed(session.get('auth'),'templateobjects','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/templateobjects/index/', tr('templateobjects'), 'title': tr('templateobjects')) }}
			</h1>
			<ul>
			<li>{{ link_to(language~'/templateobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('templateobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/templateobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('templateobjectsRetrieve')) }}</li>
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'configurationobjects','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/configurationobjects/index/',tr('configurationobjects'), 'title': tr('configurationobjects')) }}
			</h1>
			<ul>
			<li>{{ link_to(language~'/configurationobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('configurationobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/configurationobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('configurationobjectsRetrieve')) }}</li>
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'addressfolders','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/addressfolders/', tr('addressfolders'), 'title': tr('addressfolders')) }}
			</h1>
			<ul>
			<li>{{ link_to(language~'/addressfolders/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('addressfoldersCreate')) }}</li>
			<li>{{ link_to(language~'/addressfolders/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('addressfoldersCreate')) }}</li>
			
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'segmentobjects','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/segmentobjects/', tr('segmentobjects'), 'title': tr('segmentobjects')) }}
			</h1>
			<ul>
			<li>{{ link_to(language~'/segmentobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('segmentobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/segmentobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('segmentobjectsCreate')) }}</li>
			
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'distributors','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/distributors/', tr('distributors'), 'title': tr('distributors')) }}
			</h1>
			<ul>
			<li>{{ link_to(language~'/distributors/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('distributorsCreate')) }}</li>
			<li>{{ link_to(language~'/distributors/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('distributorsCreate')) }}</li>
			
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'mailobjects','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/mailobjects/index/', tr('mailobjects'), 'title': tr('mailobjects')) }}
			</h1>
			<ul>
			<li>{{ link_to(language~'/mailobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('mailobjectsCreate')) }}</li>
			<li>{{ link_to(language~'/mailobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('mailobjectsRetrieve')) }}</li>
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'campaignobjects','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/campaignobjects/index/', tr('campaigns'), 'title': tr('campaign')) }}
			</h1>
			
			<ul>
			<li>{{ link_to(language~'/campaignobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('campaignCreate')) }}</li>
			<li>{{ link_to(language~'/campaignobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('campaignRetrieve')) }}</li>
			</ul>
			
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'report','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/report/', tr('report'), 'title': tr('report')) }}
			</h1>
			<ul>			
			<li>{{ link_to(language~'/report/index/', '<span class="glyphicon glyphicon-eye-open"></span> '~tr('create'), 'title': tr('report')) }}</li>
			
			</ul>
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'subscriptionobjects','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/subscriptionobjects/index/', tr('subscriptionobjects'), 'title': tr('subscriptionobjects')) }}
			</h1>
			
			<ul>
			<li>{{ link_to(language~'/subscriptionobjects/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
			<li>{{ link_to(language~'/subscriptionobjects/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
			</ul>
			
		</div>
		{% endif %}
		{% if linkAllowed(session.get('auth'),'triggerevents','index') %}		
		<div class="ceElement xs">
			<h1>{{ link_to(language~'/triggerevents/index/', tr('triggerevents'), 'title': tr('triggerevents')) }}
			</h1>
			
			<ul>
			<li>{{ link_to(language~'/triggerevents/create/', '<span class="glyphicon glyphicon-edit"></span> '~tr('create'), 'title': tr('create')) }}</li>
			<li>{{ link_to(language~'/triggerevents/index/', '<span class="glyphicon glyphicon-list"></span> '~tr('retrieve'), 'title': tr('retrieve')) }}</li>
			</ul>
			
		</div>
		{% endif %}
		
		{% if session.get('auth')['superuser'] == 1 %}		
		<div class="ceElement xs">
			
			<h1>{{ link_to('backend', tr('backend'), 'title': tr('backend')) }}
			</h1>			
			
		</div>
		{% endif %}
	</div>
</div>