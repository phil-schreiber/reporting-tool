{%- if session.get('auth') -%}
<div id="navigation">
  <nav class="navbar denkfabrikscheme no-border no-active-arrow no-open-arrow dropdown-onhover" id="main_navbar" role="navigation">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
         {% if linkAllowed(session.get('auth'),'projects','index') %}		
            {% if 'projects' == dispatcher.getControllerName() %}                            
             <li class="dropdown-short xs-hover active">
            {% else %}     
            <li class="dropdown-short xs-hover">
            {% endif %}
            {{- link_to(language~'/projects', tr('currentProjects')~' <span class="caret"></span>', 'title': tr('currentProjects')) -}}             
            <ul class="dropdown-menu">
              {% for projecttype in projecttypes %}  
                {{- link_to(language~'/projects/?type='~projecttype.uid, projecttype.title~' <span class="caret"></span>', 'title': tr('currentProjects')) -}}         
              {% endfor %}
              
            </ul>
          </li>
          {% endif %}
          <li class="dropdown-short xs-hover"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Projekt-Archiv<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a title="" href="#">d.velop-Lösungen</a></li>
              <li><a title="" href="#">Success Stories</a></li>
              <li><a title="" href="#">Events</a></li>
              <li><a title="" href="#">Research</a></li>
              <li><a title="" href="#">Response-Elemente</a></li>
            </ul>
          </li>
          <li class="dropdown-short xs-hover"><a class="dropdown-toggle" data-toggle="dropdown" href="aktuelles-erkunden/">Veröffentlichungen<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a title="" href="#">Pressemitteilungen</a></li>
              <li><a title="" href="#">Artikel</a></li>
              <li><a title="" href="#">Interviews</a></li>
              <li><a title="" href="#">Research</a></li>
             
            </ul>
          </li>
          <li class="xs-hover"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Aufwand</a></li>
          <li class="xs-hover"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Leads</a> </li>
          <li class="xs-hover"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Abstimmung</a> </li>
          
        </ul>
        
        
       
        
      </div>
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