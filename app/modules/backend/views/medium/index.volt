<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('mediums')}}</h1>

<ul class="listviewList">
	{% for medium in mediums %}
	<li><a href='{{ path }}/update/{{ medium.uid }}'>>> {{medium.title}} | {{ date('d.m.Y',medium.tstamp) }}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}"><input type="hidden" value="{{medium.uid}}"></span></li>
	{% endfor %}
</ul>
</div>


</div>

{%- endif -%}

</div>
