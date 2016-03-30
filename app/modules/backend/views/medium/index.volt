<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('mediums')}}</h1>

<ul class="listviewList">
	{% for medium in mediums %}
	<li><a href='{{ path }}/update/{{ medium.uid }}'>>> {{medium.title}} | {{ date('d.m.Y',medium.tstamp) }} | {{medium.reach}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{medium.uid}}">X</span></li>
	{% endfor %}
</ul>
</div>


</div>

{%- endif -%}

</div>
