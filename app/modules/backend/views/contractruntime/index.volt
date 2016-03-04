<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('contractruntime')}}</h1>

<ul class="listviewList">
	{% for contract in contractruntime %}
	<li><a href='{{ path }}/update/{{ contract.uid }}'>>> Start: {{ date('d.m.Y',contract.startdate) }} Ende: {{ date('d.m.Y',contract.enddate) }} | {{contract.getUsergroup().title}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{contract.uid}}">X</span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
