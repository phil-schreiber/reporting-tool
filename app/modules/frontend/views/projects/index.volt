{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<div class="col-xs-12">
    	<h1>{{tr('projectsTitle')}}</h1>
    </div>
    
    
    <div class="col-xs-12">
    	<div class="col-xs-12 text-right">
        <button class="btn btn-primary sm-right"><i class="fa fa-plus-circle"></i>
 {{tr('filterResults')}}</button>
 </div>
        <div class="col-xs-12">
        <div class="col-xs-12 border-box smart-forms">
        <p><strong>{{tr('projectsDesc')}}</strong></p>
        
        
         <div class="frm-row">
                                    <div class="section colm colm12">
                                        <label class="field">
                                            <input name="vorname" class="gui-input address_field" id="vorname" type="text" placeholder="Themenauswahl">
                                           

                                        </label>
                                    </div><!-- end section -->
                                    
                                   
                                </div>
        
        
        <div class="frm-row">




                        <div class="section colm colm12">

                            <div class="option-group field sorten" id="sorten_selektoren">
                                {% for projecttype in projecttypes %}
                                <div class="col-xs-6 col-sm-3 utilisation_6 utilisation_7 utilisation_1">
                                    <label class="option block spacer-t10">
                                        <input name="sorten" type="radio" value="{{projecttype.uid}}" data-filter=".category_{{projecttype.uid}}">
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
                                            <input name="startdate" class="gui-input address_field" id="vorname" type="text" placeholder="Startdatum">
                                           

                                        </label>
                                    </div><!-- end section -->
                                    
                                    <div class="section colm colm6">
                                        <label class="field ">
                                            <input name="enddate" class="gui-input address_field" id="nachname" type="text" placeholder="Enddatum">
                                           
                                        </label>
                                    </div><!-- end section -->
                                </div>
        
        </div>
    </div>
    </div>
    
    <div class="col-xs-12 smart-forms">
        {% for project in projects %}
        <div class="col-xs-12 col-sm-4">
           	<div class="price-box ">
                <img src="{{baseurl}}img/{{project.getType().icon}}" class="category_icon" />
                
                <h3>{{project.title}}</h3>
                <h5>{{project.topic}}</h5>
                
                <table>
	                <tr>
    	            	<td>Letzte Änderung:</td>
        	            <td>{{date('d.m.Y H:i',project.tstamp)}}</td>                    
                    </tr>
                    <tr>
                    	<td>Typ:</td>
                        <td>{{project.getType().title}}</td>                        
                    </tr>
                    
                    
                </table>
                <br />
                
                <a href="{{baseurl~language~'/projects/update/'~project.uid}}" class="btn-default btn">{{tr('project')}} {{tr('show')}}</a>
                
        	</div>
        </div>
        {% endfor %}
    </div>
</div>
{% endif %}