{%- if session.get('auth') -%}
<div id="header"><img src="{{baseurl}}img/header_df.jpg" width="2604" height="541" alt="" class="img-responsive"/> </div>
<div id="navigation">
  <nav class="navbar denkfabrikscheme no-border no-active-arrow no-open-arrow dropdown-onhover" id="main_navbar" role="navigation">
    
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="dropdown-short xs-hover">
                {{- link_to('', 'Übersicht', 'title': 'Übersicht') -}}             
            </li>   
         {% if linkAllowed(session.get('auth'),'projects','index') %}		
            {% if 'projects' == dispatcher.getControllerName() %}                            
             <li class="dropdown-short xs-hover active">
            {% else %}     
            <li class="dropdown-short xs-hover">
            {% endif %}
            {{- link_to(language~'/projects', tr('currentProjects')~'<span class="caret"></span>', 'title': tr('currentProjects')) -}}             
            <ul class="dropdown-menu">
           {% for projecttype in projecttypes %}
           <li>{{- link_to(language~'/projects/index/'~projecttype.uid, projecttype.title, 'title': projecttype.title) -}}             </li>
           {% endfor %}
           
           </ul>
          </li>
          {% endif %}
          
          <li class="dropdown-short xs-hover">{{- link_to(language~'/clippings', 'Veröffentlichungen <span class="caret"></span>', 'title': "Veröffentlichungen") -}}             
            <ul class="dropdown-menu">
           {% for mediumtype in mediumtypes %}
           <li>{{- link_to(language~'/clippings/update/'~mediumtype.uid, mediumtype.title, 'title': mediumtype.title) -}}             </li>
           {% endfor %}
           </ul>
          </li>
                    
          <li class="xs-hover">{{- link_to(language~'/coordinations', tr('coordinations'), 'title': tr('coordinations')) -}}              </li>
          {% if session.get('auth')['superuser'] == 1 %}				                			
            <li>{{ link_to('backend', tr('backend'), 'title': tr('backend')) }}	
          {% endif %}
          
          <li>{{ link_to('session/logout/', 'logout','title': 'Logout', "class": "logout") }}</li>			
        </ul>
        
        
       
        
      </div>
      
    
      
  </nav>
  
  
</div>

{%- endif -%}