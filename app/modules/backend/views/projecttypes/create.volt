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
				
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description") }}
                                <br><br>
                                <label>{{ tr('icon') }}</label><br>
				{{ text_field("icon") }}
                                <br><br>
                                <label>kann Veröffentlicheungen haben?</label><br>
				{{select('publishable',[ '1' : tr('yes'), '0' : tr('no') ], 'value':0)}}
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
