{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
        <h1>{{tr('clippingoverviews')}} 2016</h1>
        <div class="panel-group">
            {% for year,yeararray in overviewarray %}
            <div class="panel panel-default">
              
              <div id="collapse{{year}}" class="panel-collapse">
                <ul class="list-group">
                  {% for month, filelink in yeararray %}
                  <li class="list-group-item"><a href="{{host}}{{baseurl}}{{filelink}}" target="_blank" style='display:block;'>{{month}}</a></li>                  
                  {% endfor %}
                </ul>
                
              </div>
            </div>
            {% endfor %}
            
          </div>
        
    </div>
    
    
    
    <div class="col-xs-12">
        <h1>{{tr('clippings')}} 2016 insgesamt</h1>
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

