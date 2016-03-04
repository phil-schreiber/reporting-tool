<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('clippingoverviews')}}</h1>
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
<a href="{{path}}/create/{{usergroup.uid}}">Neue Clippingübersicht für {{usergroup.title}}</a>
<br><br>
<ul>
    {% for clippingsoverview in clippingsoverviews %}
    <li><a href="{{path}}/update/{{clippingsoverview.uid}}">{{clippingsoverview.title}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{clippingsoverview.uid}}">X</span></li>
    {% endfor %}
</ul>  
{% endif %}
</div>

{%- endif -%}

</div>
