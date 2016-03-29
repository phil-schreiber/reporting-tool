{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
        <h1>{{tr('clippingoverviews')}}</h1>
        <div class="panel-group">
            {% for year,yeararray in overviewarray %}
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#collapse{{year}}" style="display:block;">{{year}}</a>
                </h4>
              </div>
              <div id="collapse{{year}}" class="panel-collapse collapse">
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
        <h1>{{tr('clippings')}} insgesamt</h1>
        <p>
    	{% for index,mediumtype in mediumtypes %}
        <strong>{% if index>0 %},&nbsp;{% endif %}{{mediumtype.title}}: {{clippingstotal[mediumtype.uid]}}</strong>
        {% endfor %}
        <br><br>
        </p>
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
                <th>{{tr('title')}}</th>
                <th>{{tr('publicationdate')}}</th>	                                                
                <th>{{tr('clippingtype')}}</th>
                <th>{{tr('file')}}</th>		
                
            </tr>
        </thead>
 
        
    </table>
    </div>
</div>
{% endif %}

