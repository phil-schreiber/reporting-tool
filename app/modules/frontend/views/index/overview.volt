{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">    
 <div class="col-xs-12">
    	<h1>&nbsp;</h1>
        <div class="col-xs-12 text-right"> </div>
        <div class="col-xs-12"> </div>
    </div>    
	<div class="col-xs-12 smart-forms">
                {% if linkAllowed(session.get('auth'),'projects','index') %}		
		<div class="col-xs-12 col-sm-4">
                    <div class="price-box ">
                        <h3>{{tr('current')}} {{tr('projects')}}</h3>
                        <h5>{{tr('projectsDesc')}}</h5><br>
                        {{ link_to(language~'/projects/index/', tr('filterShow'), 'title': tr('filterShow'),'class':'btn-primary btn') }}
                    </div>
                </div>		
		{% endif %}
                  {% if linkAllowed(session.get('auth'),'contractruntime','index') %}		
		<div class="col-xs-12 col-sm-4">
                    <div class="price-box ">
                        <h3>Vertrag und Budget</h3>
                        <h5>Ihre Vertragskonditionen und aktuellen Verbräuche</h5><br>
                        {{ link_to(language~'/projects/index/', tr('retrieve'), 'title': tr('retrieve'),'class':'btn-primary btn') }}
                    </div>
                </div>		
		{% endif %}
                 {% if linkAllowed(session.get('auth'),'contractruntime','index') %}		
		<div class="col-xs-12 col-sm-4">
                    <div class="price-box ">
                        <h3>Vertrag und Budget</h3>
                        <h5>Ihre Vertragskonditionen und aktuellen Verbräuche</h5><br>
                        {{ link_to(language~'/projects/index/', tr('retrieve'), 'title': tr('retrieve'),'class':'btn-primary btn') }}
                    </div>
                </div>		
		{% endif %}
		
		
		{% if session.get('auth')['superuser'] == 1 %}		
		<div class="col-xs-12 col-sm-4">
                    <div class="price-box ">
			
			<h3>{{ link_to('backend', tr('backend'), 'title': tr('backend')) }}
			</h3>			
                    </div>
		</div>
		{% endif %}
	</div>
</div>