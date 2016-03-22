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
<table class="display dataTable">
    <thead><th>Datum</th><th>Titel</th><th>Medium</th><th>Projekt</th></thead>
<tbody>
    {% for index,clipping in clippings %}
    <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
        <td>{{date('d.m.Y',clipping.tstamp)}}</td><td><a href="{{path}}/update/{{clipping.uid}}">{{clipping.title}}</td><td>{{clipping.getType().title}}</td><td>{{clipping.getProject().title}}</a></td><td><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{clipping.uid}}">X</span></td></li>
    </tr>
    {% endfor %}
</tbody>    
</table>

    


{% endif %}
</div>

{%- endif -%}

</div>
