<div class="container">
	{{ content() }}
{%- if session.get('auth') -%}
<div class="ceElement medium">
<h1>{{tr('projects')}}</h1>
<table class="display dataTable">
    <thead><th>Kunde</th><th>Erstelldatum</th><th>Titel</th><th>Projekttyp</th></thead>
<tbody>
    {% for index,project in projects %}
    <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
        <td>{{project.getUsergroup().title}}</td>
        <td>{{ date('d.m.Y',project.crdate) }}</td>
        <td><a href='{{ path }}/update/{{ project.uid }}'>{{project.title}}</a><span class="glyphicon glyphicon-remove deleteListItem" title="{{tr('delete')}}" data-element="{{project.uid}}">X</span></td>
        <td>{{project.getType().title}}</td>
    </tr>

	
	
	{% endfor %}
</tbody>
</table>
</div>

{%- endif -%}

</div>
