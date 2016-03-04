<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('mediumtypes')}}</h1>

<ul class="listviewList">
	{% for mediumtype in mediumtypes %}
	<li><a href='{{ path }}{{ mediumtype.uid }}'>>> {{mediumtype.title}} | {{ date('d.m.Y',mediumtype.tstamp) }}}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{mediumtype.uid}}">X</span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
