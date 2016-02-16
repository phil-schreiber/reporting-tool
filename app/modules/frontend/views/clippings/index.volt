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
                  <li class="list-group-item"><a href="{{baseurl}}{{filelink}}" style='display:block;'>{{month}}</a></li>                  
                  {% endfor %}
                </ul>
                
              </div>
            </div>
            {% endfor %}
            
          </div>
        
    </div>
    <div class="col-xs-12">
        <h1>{{tr('clippings')}} insgesamt</h1>
        <form id="filterForm">
    	<div class="col-xs-12 text-right">
            
        <button type="submit" class="btn btn-primary sm-right"><i class="fa fa-minus-circle"></i>
 {{tr('filterShow')}}</button>
 </div>
        <div class="col-xs-12">
        <div class="col-xs-12  border-box smart-forms" id="filters">
            
        <p><strong>{{tr('clippingsDesc')}}</strong></p>
        
        
         <div class="frm-row">
                                    <div class="section colm colm6">
                                        <label class="field">
                                            <select multiple id="topic" name="topics[]" data-placeholder="Themenauswahl">
                                                {% for topic in topics %}
                                                    <option value="{{topic}}">
                                                        {{topic}}
                                                    </option>
                                                {% endfor %}
                                            </select>
                                            
                                           

                                        </label>
                                    </div><!-- end section -->
                                    <div class="section colm colm6">
                                        <label class="field">
                                            <select multiple id="projects" name="projects[]" data-placeholder="Projektauswahl">
                                                   <option value=""></option>
                                                {% for project in projects %}
                                                    <option value="{{project.uid}}">
                                                        {{project.title}}
                                                    </option>
                                                {% endfor %}
                                            </select>
                                            
                                           

                                        </label>
                                    </div>
                                   
                                </div>
        
        
        
        <div class="frm-row">




                        <div class="section colm colm12">

                            <div class="option-group field sorten" id="sorten_selektoren">
                                {% for projecttype in projecttypes %}
                                <div class="col-xs-6 col-sm-3 utilisation_6 utilisation_7 utilisation_1">
                                    <label class="option block spacer-t10">
                                        <input name="projecttype" type="radio" value="{{projecttype.uid}}">
                                        <span class="radio"></span> {{projecttype.title}}
                                    </label>
                                </div>
                                {% endfor %}
                            </div><!-- end .option-group section -->
							<div style="display: none; visibility: hidden !important;">
                                	<input name="sorten" id="reset_sorten" type="radio" value="1" data-filter="">
                                </div>
                        </div>

                    </div>
                    
                    
                    <div class="frm-row">
                                    <div class="section colm colm6">
                                        <label class="field">
                                            <input name="startdate" class="gui-input datepicker" id="startdate" type="text" placeholder="Von">
                                           

                                        </label>
                                    </div><!-- end section -->
                                    
                                    <div class="section colm colm6">
                                        <label class="field ">
                                            <input name="enddate" class="gui-input datepicker" id="enddate" type="text" placeholder="Bis">
                                           
                                        </label>
                                    </div><!-- end section -->
                                </div>
        
        </div>
    </div>
            </form>
    </div>
    <div class="col-xs-12">
        
        <table id="clippings" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{tr('medium')}}</th>
                <th>{{tr('title')}}</th>
                <th>{{tr('publicationdate')}}</th>	                
                <th>{{tr('project')}}</th>
                <th>{{tr('startdate')}}</th>                
                <th>{{tr('clippingtype')}}</th>
                <th>{{tr('file')}}</th>		
                <th>{{tr('url')}}</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>{{tr('medium')}}</th>
                <th>{{tr('title')}}</th>
                <th>{{tr('publicationdate')}}</th>
                <th>{{tr('project')}}</th>
                <th>{{tr('startdate')}}</th>                		
                <th>{{tr('clippingtype')}}</th>                
		<th>{{tr('file')}}</th>		
                <th>{{tr('url')}}</th>
            </tr>
        </tfoot>
    </table>
    </div>
</div>
{% endif %}

