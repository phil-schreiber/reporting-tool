{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}

<div class="ceElement medium">
<h1>{{tr('profile')}}</h1>
<div class='listelementContainer'>
{{ form('backend/'~language~'/profiles/create/', 'method': 'post') }}

	<label>{{ tr('title') }}</label><br>
    {{ text_field("title", "size": 32) }}
	<br><br>	
	
	 {{ submit_button(tr('ok')) }}

</form>
</div>
</div>
{%- endif -%}

</div>
