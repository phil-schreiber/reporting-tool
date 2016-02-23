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
           <li>{{ link_to('session/logout/', 'logout','title': 'Logout', "class": "logout") }}</li>	
           
        </ul>
        
        
       
        
      </div>
    
  </nav>
  
  <nav class="navbar no-border no-active-arrow no-open-arrow dropdown-onhover" role="navigation">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        					
					<a class="navbar-brand navbar-left" href="#"><img width="130" src="{{baseurl}}img/logo_df.svg"></a>
				</div>
                
                
                <ul class="nav navbar-nav navbar-right">
        				<li>
        				<form class="navbar-form-expanded navbar-form navbar-left visible-lg-block visible-md-block visible-xs-block" role="search">
        					<div class="input-group">
        						<input name="query" class="form-control" type="text" placeholder="Schnellsuche" data-width="120px" data-width-expanded="200px">
        						<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i>&nbsp;</button></span>
        					</div>
        				</form>
                        </li>
        				
        				
        				
        			</ul>
      
    </div>
  </nav>
</div>
<div id="header"><img src="{{baseurl}}img/header_df.jpg" width="2604" height="541" alt="" class="img-responsive"/> </div>
{%- endif -%}