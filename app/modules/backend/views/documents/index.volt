<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('documents')}}</h1>
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
<a href="{{path}}/create/{{usergroup.uid}}">Neues Dokument für {{usergroup.title}}</a><br><br>
<ul>
    {% for document in documents %}
    <li><a href="{{path}}/update/{{document.uid}}">{{document.title}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{document.uid}}">X</span></li>
    {% endfor %}
</ul>    
{% endif %}
</div>

{%- endif -%}

</div>
