{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('contractruntime')}} {{tr('update')}}</h1>
		<div class="listelementContainer">			
			{{ form('backend/'~language~'/contractruntime/create/'~contractruntime.uid, 'method': 'post') }}

				
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>                                
                                 <label>{{ tr('startdate') }}</label><br>
				{{ text_field("startdate", "value":date('d/m/Y H:i',contractruntime.startdate),"class":"datepicker") }}
				<br><br>
                                <label>{{ tr('enddate') }}</label><br>
                                {% if contractruntime.enddate > 0 %}
				{{ text_field("enddate", "value":date('d/m/Y H:i',contractruntime.enddate),"class":"datepicker") }}
                                {% else %}
                                {{ text_field("enddate", "class":"datepicker") }}
                                {% endif %}
				<br><br>
                               
                                {{select('active',[ '1' : tr('active'), '0' : tr('inactive')])}}
                                <br><br>
                               
                                
                                {{ hidden_field('uid',"value":contractruntime.uid) }}
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>