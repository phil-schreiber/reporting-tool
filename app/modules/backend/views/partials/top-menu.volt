{%- if session.get('auth') -%}
<div id="navigation">
  <nav class="navbar denkfabrikscheme no-border no-active-arrow no-open-arrow dropdown-onhover" id="main_navbar" role="navigation">
    
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav">
         {% if linkAllowed(session.get('auth'),'projects','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/projects', tr('projects')~' <span class="caret"></span>', 'title': tr('projects')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/projects/create/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
           {% if linkAllowed(session.get('auth'),'projecttypes','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/projecttypes', tr('projecttypes')~' <span class="caret"></span>', 'title': tr('projecttypes')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/projecttypes/create/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
         {% if linkAllowed(session.get('auth'),'contractruntime','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/contractruntime', tr('contractruntime')~' <span class="caret"></span>', 'title': tr('currentProjects')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/contractruntime/create/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
           {% if linkAllowed(session.get('auth'),'clippings','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/clippings', tr('clippings')~' <span class="caret"></span>', 'title': tr('currentProjects')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/clippings/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
            {% if linkAllowed(session.get('auth'),'clippingsoverview','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/clippingsoverview', tr('clippingoverview')~' <span class="caret"></span>', 'title': tr('clippingoverview')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/clippingsoverview/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
           
          
          {% if linkAllowed(session.get('auth'),'medium','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/medium', tr('medium')~' <span class="caret"></span>', 'title': tr('medium')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/medium/create/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
            {% if linkAllowed(session.get('auth'),'mediumtypes','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/mediumtypes', tr('mediumtypes')~' <span class="caret"></span>', 'title': tr('mediumtypes')) -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/mediumtypes/create/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
           {% if linkAllowed(session.get('auth'),'otherprojects','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/otherprojects/', 'Sonstige Projekte <span class="caret"></span>', 'title': 'Sonstige Projekte') -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/otherprojects/create', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
           {% if linkAllowed(session.get('auth'),'mediacontacts','index') %}		
           
            <li class="dropdown-short xs-hover">
           
            {{- link_to('backend/'~language~'/mediacontacts/', 'Medienkontakte <span class="caret"></span>', 'title': 'Medienkontakte') -}}             
            <ul class="dropdown-menu">
                <li>
                    {{- link_to('backend/'~language~'/mediacontacts/', tr('create'), 'title': tr('create')) -}}         
                </li>
            </ul>
          </li>
          {% endif %}
           <li>{{ link_to('session/logout/', 'logout','title': 'Logout', "class": "logout") }}</li>	
           
        </ul>
        
        
       
        
      </div>
    
  </nav>

</div>

{%- endif -%}