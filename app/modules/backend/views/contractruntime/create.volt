{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('contractruntime')}} {{tr('create')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/contractruntime/create/', 'method': 'post') }}

				
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>                                
                                <label>{{ tr('startdate') }}</label><br>
				{{ text_field("startdate", "size": 32, "class":"datepicker") }}
				<br><br>
                                <label>{{ tr('enddate') }}</label><br>
				{{ text_field("enddate", "size": 32, "class":"datepicker") }}
                                <br><br>
                                {{select('active',[ '1' : tr('active'), '0' : tr('inactive')], 'value':1)}}
                                
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
                                         <label>Anzahl: </label> {{ numeric_field("amount["~projecttype.uid~"]", "class":"amountInput") }}<br>
                                     </td>
                                </tr>
                                {% endfor %}
                                </table><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
