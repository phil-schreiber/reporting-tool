<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('coordinations')}}</h1>
{% if customerselect %}
<h2>Kunden auswählen</h2>
<form method="POST">
    <select name="usergroup">
            {% for usergroup in usergroups %}
            <option value="{{usergroup.uid}}">{{usergroup.title}}</option>
            {% endfor %}
    </select><br><br>
    <input type="submit" value="Ok">
</form>
{% else %}
<a href="{{path}}/create/{{usergroup.uid}}">Neues {{tr('coordination')}} für {{usergroup.title}}</a>
<br><br>
   <ul class="listviewList">
	{% for coordination in coordinations %}
	<li><a href='{{ path }}/update/{{ coordination.uid }}'>>> {{coordination.title}} | {{ date('d.m.Y',coordination.tstamp) }}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{coordination.uid}}">X</span></li>
	{% endfor %}
</ul>
{% endif %}
</div>

{%- endif -%}

</div>
