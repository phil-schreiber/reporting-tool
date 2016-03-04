<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('budgets')}}</h1>

<ul class="listviewList">
	{% for budget in budgets %}
	<li><a href='{{ path }}{{ budget.uid }}'>>> Kunde: {{budget.getUsergroup().title}} | zugehöriger Vertrag: {{ date('d/m/Y',budget.getContractruntime().startdate) }} (Startdatum) </a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}"><input type="hidden" value="{{budget.uid}}">X</span></li>
	{% endfor %}
</ul>
</div>

{%- endif -%}

</div>
