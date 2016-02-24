{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('contractruntime')}} {{tr('update')}}</h1>
		<div class="listelementContainer">			
			{{ form('backend/'~language~'/contractruntime/update/'~contractruntime.uid, 'method': 'post') }}

				
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>                                
                                 <label>{{ tr('startdate') }}</label><br>
				{{ text_field("startdate", "value":date('d.m.Y',contractruntime.startdate),"class":"datepicker") }}
				<br><br>
                                <label>{{ tr('enddate') }}</label><br>
                                {% if contractruntime.enddate > 0 %}
				{{ text_field("enddate", "value":date('d.m.Y',contractruntime.enddate),"class":"datepicker") }}
                                {% else %}
                                {{ text_field("enddate", "class":"datepicker") }}
                                {% endif %}
				<br><br>
                               
                                {{select('active',[ '1' : tr('active'), '0' : tr('inactive')])}}
                                <br><br>
                               <br><br>
                                <h2>zugehöriges Budget:</h2>
                                <table class="selectTable">
                                {% for projecttype in projecttypes %}
                                <tr>
                                    <td>
                                        {{projecttype.title}}
                                    </td> 
                                    <td>
                                        <==>
                                     </td>
                                     <td>
                                         {% if arrayKeyExists(projecttype.uid,budgetspecs)%}
                                         {% set amount = budgetspecs[projecttype.uid] %}
                                         {% else %}
                                         {% set amount = 0 %}
                                         {% endif %}
                                         <label>Anzahl: </label> {{ numeric_field("amount["~projecttype.uid~"]", "class":"amountInput", "value":amount) }}<br>
                                     </td>
                                </tr>
                                {% endfor %}
                                </table><br>
                                
                                {{ hidden_field('uid',"value":contractruntime.uid) }}
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>