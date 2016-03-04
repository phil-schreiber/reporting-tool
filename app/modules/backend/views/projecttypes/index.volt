<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('projecttypes')}}</h1>

<ul class="listviewList">
	{% for projecttype in projecttypes %}
	<li><a href='{{ path }}/update/{{ projecttype.uid }}'>>> {{projecttype.title}} | {{ date('d.m.Y',projecttype.tstamp) }}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{projecttype.uid}}">X</span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
