{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('coordination')}} {{tr('update')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/coordinations/create/', 'method': 'post',"enctype":"multipart/form-data") }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32,"value":coordination.title) }}
				<br><br>
                                 <label>Datum</label><br>
				{{ text_field("tstamp", "size": 32, "class":"datepicker", "value":date('d.m.Y',coordination.tstamp)) }}
				<br><br>   
                                <label>{{ tr('comments') }}</label><br>
				{{ text_area("comments","value":coordination.comments) }}
                                <br><br>
                                
                                <label>{{ tr('project') }}</label><br>
                                <select name="projects[]" multiple>
                                    {% for project in projects %}
                                        {% if in_array(project.uid,projectsarray) %}
                                        <option value="{{project.uid}}" selected>{{project.title}}</option>
                                        {% else %}
                                        <option value="{{project.uid}}">{{project.title}}</option>
                                        {% endif %}
                                    {% endfor %}
                                    
                                </select>
				
                                <br><br>                                                                
                                
                                {{hidden_field("usergroup","value":coordination.usergroup)}}
                                
                                
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
