<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>Sonstige Projekte</h1>

<ul class="listviewList">
	{% for project in projects %}
	<li><a href='{{ path }}{{ project.uid }}'>>> {{project.title}} | {{ date('d.m.Y',project.tstamp) }}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}"><input type="hidden" value="{{project.uid}}"></span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
