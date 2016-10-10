{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
        <h1>Leads {{date('Y')}}</h1>
        <span class="btn btn-default" style="margin-right:10px;background:#333;color:#fff">Gesamt: {{leads}}</span>
    </div>
 
    
    
    
    <div class="col-xs-12">
        <h1>{{tr('clippings')}} {{date('Y')}}</h1>
         <span class="btn btn-default" style="margin-right:10px;background:#333;color:#fff">Gesamt: {{total}}</span>
        <table  class="dataTable display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>{{tr('mediumtype')}}</th>
                <th>Anzahl der Veröffentlichungen</th>
                <th>Reichweite</th>		
                
            </tr>
        </thead>
        <tbody>
            {% for index,mediumtype in mediumtypes %}
            <tr {% if index%2==0 %}class="even"{% else %}class="odd"{% endif %}>
                <td>{{mediumtype.title}}:</td>
                <td>{{clippingstotal[mediumtype.uid]['clippingscount']}}</td>
                <td>{{clippingstotal[mediumtype.uid]['mediumreach']}}</td>
            </tr>
        
        {% endfor %}
        </tbody>
        </table>
    	
        <br><br>
        
    </div>
    <div class="col-xs-12">
        
        <table id="clippings" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{tr('project')}}</th>
                <th>{{tr('topic')}}</th>
                <th>{{tr('medium')}}</th>
                <th>{{tr('mediumtype')}}</th>
                <th>{{tr('reach')}}</th>                
                <th>{{tr('publicationdate')}}</th>	                                                
                <th>{{tr('clippingtype')}}</th>
                <th>{{tr('file')}}</th>		
                
            </tr>
        </thead>
 
        
    </table>
    </div>
</div>
{% endif %}

