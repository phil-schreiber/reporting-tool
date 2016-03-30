{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
        <h1>{{tr('coordinations')}} {{date('Y')}}</h1>
        
            <table id="clippings" class="display dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Datum</th>                
                <th>Thema</th>                
            </tr>
        </thead>
        <tbody>
            {% for index,coordination in coordinations %}
            <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
                <td>{{date('d/m/Y',coordination.tstamp)}}</td>
                <td>{{coordination.title}}</td>
            </tr>
             {% endfor %}   
        </tbody>
            </table>            
                  
                  
            
            
            
          
        
    </div>
    
</div>
{% endif %}


