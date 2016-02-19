{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
        <h1>{{tr('coordinations')}}</h1>
        <div class="panel-group">
            {% for year,yeararray in coordinationsarray %}
            <b>{{year}}:</b>
            {% for month, coordinations in yeararray %}
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#collapse{{month}}" style="display:block;">{{month}}</a>
                </h4>
              </div>
              <div id="collapse{{month}}" class="panel-collapse collapse">
                <ul class="list-group">
                  {% for coordination in coordinations %}
                  <li class="list-group-item">
                      {{date('d/m/Y',coordination.tstamp)}} - {{coordination.title}}
                      <br>thematisierte Projekte:
                      <ul>
                          {% for project in coordination.getProjects() %}
                          <li><a href="{{host}}{{baseurl}}{{language}}/projects/update/{{project.uid}}">{{project.title}}</a></li>
                          {% endfor %}
                      </ul>
                  </li>                  
                  {%  endfor %}
                </ul>
                
              </div>
            </div>
            {% endfor %}
            {% endfor %}
            
          </div>
        
    </div>
    
</div>
{% endif %}


