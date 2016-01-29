{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('projecttypes')}} {{tr('update')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/projecttypes/create/'~projecttype.uid, 'method': 'post') }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32, "value": projecttype.title) }}
				<br><br>
				
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description","value":projecttype.description) }}
                                <br><br>
                                {{ hidden_field('uid',"value":projecttype.uid) }}
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>

