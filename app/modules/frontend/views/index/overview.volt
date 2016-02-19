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
                  {% if linkAllowed(session.get('auth'),'clippings','index') %}		
		<div class="col-xs-12 col-sm-4">
                    <div class="price-box ">
                        <h3>Veröffentlichungen</h3>
                        <h5>Veröffentlichungen anzeigen und Clipping-Übersichten runterladen</h5><br>
                        {{ link_to(language~'/clippings/index/', tr('retrieve'), 'title': tr('retrieve'),'class':'btn-primary btn') }}
                    </div>
                </div>		
		{% endif %}
                 {% if linkAllowed(session.get('auth'),'coordinations','index') %}		
		<div class="col-xs-12 col-sm-4">
                    <div class="price-box ">
                        <h3>{{tr('coordinations')}}</h3>
                        <h5>Übersicht der abgehaltenen Abstimmungsgespräche und Themen</h5><br>
                        {{ link_to(language~'/coordinations/index/', tr('retrieve'), 'title': tr('retrieve'),'class':'btn-primary btn') }}
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