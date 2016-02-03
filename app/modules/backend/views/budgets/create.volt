{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('budget')}} {{tr('create')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/budgets/create/', 'method': 'post') }}

				
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>                                
                                <label>zugehörige Vertragslaufzeit</label><br>
				{{select('contractruntime',contractruntime,"using":['uid','title'])}}
                                <br><br>                                
                                
                                
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
