{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>Sonstige Projekte {{tr('update')}}</h1>
		<div class="listelementContainer">			
			{{ form('backend/'~language~'/otherprojects/update/'~project.uid, 'method': 'post') }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "value": project.title) }}
				<br><br>
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description","value":project.description) }}
                                <br><br>
                                 <label>{{ tr('starttime') }}</label><br>
				{{ text_field("starttime", "value":date('d.m.Y',project.starttime),"class":"datepicker") }}
				<br><br>
                                <label>{{ tr('endtime') }}</label><br>
                                {% if project.endtime > 0 %}
				{{ text_field("endtime", "value":date('d.m.Y',project.endtime),"class":"datepicker") }}
                                {% else %}
                                {{ text_field("endtime", "class":"datepicker") }}
                                {% endif %}
				<br><br>
                                
                                
                                {{ hidden_field('uid',"value":project.uid) }}
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>