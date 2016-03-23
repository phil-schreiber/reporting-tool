{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
   
    <div class="col-xs-12">
        <h1>Medienkontakte</h1>
        
 
        <table id="clippings" class="display dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Medium</th>  
                <th>Thema</th>                
            </tr>
        </thead>
        <tbody>
            {% for index,project in projects %}
            <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
                <td>
                    {{date('d.m.Y',project.starttime)}}
                </td>
                <td>
                    {{project.getMedium().title}}
                </td>
                <td>
                    {{project.description}}
                </td>
                
            </tr>
            {% endfor %}
        </tbody>         
    </table>
    </div>
</div>
{% endif %}

