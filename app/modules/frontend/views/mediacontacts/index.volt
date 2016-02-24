{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
   
    <div class="col-xs-12">
        <h1>Medienkontakte</h1>
        
 
        <table id="clippings" class="display dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Medium</th>  
                <th>Thema</th>
                <th>Beginn</th>
                <th>Ende</th>
            </tr>
        </thead>
        <tbody>
            {% for index,project in projects %}
            <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
                <td>
                    {{project.getMedium().title}}
                </td>
                <td>
                    {{project.description}}
                </td>
                <td>
                    {{date('d.m.Y H:i',project.starttime)}}
                    
                </td>
                <td>
                    {{date('d.m.Y H:i',project.endtime)}}
                    
                </td>
            </tr>
            {% endfor %}
        </tbody>         
    </table>
    </div>
</div>
{% endif %}

