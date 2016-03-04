<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>Medienkontakte</h1>
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
<a href="{{path}}/create/{{usergroup.uid}}">Neuen Medienkontakt für {{usergroup.title}}</a>
<br><br>
<ul>
        {% for mediacontact in mediacontacts %}
        <li><a href="{{path}}/update/{{mediacontact.uid}}" >>> {{mediacontact.title}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{mediacontact.uid}}">X</span></li>
            {% endfor %}
</ul>            
{% endif %}
</div>

{%- endif -%}

</div>
