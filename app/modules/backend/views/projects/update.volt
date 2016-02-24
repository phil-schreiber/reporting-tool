{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('projects')}} {{tr('update')}}</h1>
		<div class="listelementContainer">			
			{{ form('backend/'~language~'/projects/update/'~project.uid, 'method': 'post') }}

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
                                <label>{{ tr('archive') }}</label><br>
                                {{select('status',[ '1' : tr('yes'), '0' : tr('no') ],"value":project.status)}}
                                <br><br>
                                <label>{{ tr('projectstate') }}</label><br>
                                {{select('projectstate',[ '3' : tr('completed'),'2' : tr('live'),'1' : tr('incoordination'), '0' : tr('inpreparation') ], 'value':projectstate.statetype)}}
                                <br><br>
                                <label>{{ tr('projectstatedescription') }}</label><br>
				{{ text_field("projectstatedescription","value":projectstate.description) }}
                                <br><br>
                                <label>{{ tr('projecttype') }}</label><br>
				{{select('projecttype',projecttypes,"using":['uid','title'],"value":project.projecttype)}}
                                <br><br>
                                <label>{{ tr('topic') }}</label><br>
				{{ text_field("topic", "value":project.topic) }}
                                <br><br>
                                <label>{{ tr('estcost') }}</label><br>
				{{ text_field("estcost","value":project.estcost) }} {{tr('h')}}
                                <br><br>
                                <label>{{ tr('currentcost') }}</label><br>
				{{ text_field("currentcost","value":project.currentcost) }} {{tr('h')}}
                                <br><br>
                                
                                {{ hidden_field('uid',"value":project.uid) }}
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>