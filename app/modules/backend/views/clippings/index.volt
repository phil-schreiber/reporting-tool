<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('clippings')}}</h1>
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
<a href="{{path}}/create/{{usergroup.uid}}">Neues Clipping für {{usergroup.title}}</a><br><br>
<ul>
    {% for clipping in clippings %}
    <li><a href="{{path}}/update/{{clipping.uid}}">{{clipping.title}} | {{clipping.getType().title}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{clipping.uid}}">X</span></li>
    {% endfor %}
</ul>    

{% endif %}
</div>

{%- endif -%}

</div>
