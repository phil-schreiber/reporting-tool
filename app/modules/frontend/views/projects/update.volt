{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
    	<h1>{{project.title}}</h1>
            
    </div>
</div>
{% endif %}
