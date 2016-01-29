<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('projecttypes')}}</h1>

<ul class="listviewList">
	{% for projecttype in projecttypes %}
	<li><a href='{{ path }}{{ projecttype.uid }}'>>> {{projecttype.title}} | {{ date('d.m.Y',projecttype.tstamp) }}}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}"><input type="hidden" value="{{projecttype.uid}}"></span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
