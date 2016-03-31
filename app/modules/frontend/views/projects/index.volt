{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<div class="col-xs-12">
    	<h1>{{tr('projectsTitle')}} {{date('Y')}}</h1>
        
    
    {% if preselected %}
    
    
    <h2>>> {{projecttype}}</h2><br>
        <span class="btn btn-default" style="margin-right:10px;background:#333;color:#fff">Ist: {{ist}}</span>
        <span class="btn btn-default" style="margin-right:10px;background:#333;color:#fff">in Arbeit: {{inprocess}}</span>
        <span class="btn btn-default" style="background:#333;color:#fff">Soll: {{soll}}</span>
        
    
    {% endif %}


    
    <div class="col-xs-12" style="display:none">
        <form id="filterForm" name="filterForm">
    	<div class="col-xs-12 text-right">
            <button type="reset" class="btn btn-primary sm-right"><i class="fa fa-minus-circle"></i>
 {{tr('resetFilters')}}</button>
        <button type="submit" class="btn btn-primary sm-right"><i class="fa fa-minus-circle"></i>
 {{tr('filterResults')}}</button>
 </div>
        <div class="col-xs-12">
        <div class="col-xs-12 border-box smart-forms" id="filters">
        <p><strong>{{tr('projectsDesc')}}</strong></p>
        
        
         <div class="frm-row">
                                    <div class="section colm colm12">
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
                                    
                                   
                                </div>
        
        
        <div class="frm-row" >




                        <div class="section colm colm12">

                            <div class="option-group field sorten" id="sorten_selektoren">
                                {% for projecttype in projecttypes %}
                                <div class="col-xs-6 col-sm-3 utilisation_6 utilisation_7 utilisation_1">
                                    <label class="option block spacer-t10">
                                        <input name="projecttype" type="radio" value="{{projecttype.uid}}" {% if preselected==projecttype.uid %}checked{% endif %} >
                                        <span class="radio"></span> {{projecttype.title}}
                                    </label>
                                </div>
                                {% endfor %}
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
    
    <div class="col-xs-12 smart-forms">
        <table id="projects" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>                
                <th>{{tr('projectttitle')}}</th>
                <th>{{tr('starttime')}}</th>	                                                
                <th>{{tr('typetitle')}}</th>                	
                <th>{{tr('state')}}</th>
                
            </tr>
        </thead>
         
    </table>
    </div>
    <div id="myModal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Status</h4>
      </div>
      <div class="modal-body" style="background:#d3d3d3">
      <div id="timeline-container-basic" type="text"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
    
    </div>
</div>
{% endif %}