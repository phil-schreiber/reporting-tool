{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('mediumtype')}} {{tr('update')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/mediumtypes/update/'~mediumtype.uid, 'method': 'post') }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32, "value": mediumtype.title) }}
				<br><br>
				
                                
                                {{ hidden_field('uid',"value":mediumtype.uid) }}
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>

