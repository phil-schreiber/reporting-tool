{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('projecttypes')}} {{tr('create')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/projecttypes/create/', 'method': 'post') }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32) }}
				<br><br>
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description") }}
                                <br><br>
                                <label>{{ tr('starttime') }}</label><br>
				{{ text_field("starttime", "size": 32, "class":"datepicker") }}
				<br><br>
                                <label>{{ tr('endtime') }}</label><br>
				{{ text_field("endtime", "size": 32, "class":"datepicker") }}
				<br><br>
                                <label>{{ tr('status') }}</label><br>
                                {{select('status',[ '4' : tr('completed'),'3' : tr('live'),'2' : tr('incoordination'), '1' : tr('inpreparation'), '0' : tr('new')], 'value':0)}}
                                <br><br>
                                <label>{{ tr('projecttype') }}</label><br>
				{{select('projecttype',projecttypes,"using":['uid','title'])}}
                                <br><br>
                                <label>{{ tr('topic') }}</label><br>
				{{ text_area("topic") }}
                                <br><br>
                                <label>{{ tr('estcost') }}</label><br>
				{{ text_field("estcost") }} {{tr('h')}}
                                <br><br>
                                <label>{{ tr('currentcost') }}</label><br>
				{{ text_field("currentcost") }} {{tr('h')}}
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
