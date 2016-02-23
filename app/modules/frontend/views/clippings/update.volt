{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
   
    <div class="col-xs-12">
        <h1>{{tr('clippings')}} {{mediumtype.title}}</h1>
        <table>
            <tr>
                <td>Veröffentlichungen gesamt:</td>
                <td>{{clippingstotal}}</td>
            </tr>
        </table>
        <form id="filterForm">
        {{hidden_field('mediumtype',"id":"uid","value":mediumtype.uid)}}
        </form>
 </div>
       
    <div class="col-xs-12">
        
        <table id="clippings" class="display dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{tr('project')}}</th>
                <th>Anzahl der Veröffentlichungen</th>                
            </tr>
        </thead>
        <tbody>
            {% for index,project in projects %}
            <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
                <td>
                    {{project.title}}
                </td>
                <td>
                    {{project.countMediumtypeClippings(mediumtype.uid)}}
                </td>
            </tr>
            {% endfor %}
        </tbody>         
    </table>
    </div>
</div>
{% endif %}

