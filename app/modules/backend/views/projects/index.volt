<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('projects')}}</h1>

<ul class="listviewList">
	{% for project in projects %}
	<li><a href='{{ path }}/update/{{ project.uid }}'>>> {{project.title}} | {{ date('d.m.Y',project.tstamp) }}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{project.uid}}">X</span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
