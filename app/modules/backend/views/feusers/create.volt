{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('feusersCreateTitle')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/feusers/create/', 'method': 'post') }}

				<label>{{ tr('feusers.username') }}</label><br>
				{{ text_field("username", "size": 32) }}
				<br><br>
				<label>{{ tr('feusers.password') }}</label><br>
				{{ password_field("password", "size": 32) }}
			<br><br>
				<label>{{ tr('feusers.lastname') }}</label><br>
				{{ text_field("last_name", "size": 32) }}
			<br><br>
			<label>{{ tr('feusers.firstname') }}</label><br>
				{{ text_field("first_name", "size": 32) }}
			<br><br>
				<label>{{ tr('feusers.title') }}</label><br>
				{{ text_field("title", "size": 32) }}
				<br><br>
				<label>{{ tr('feusers.email') }}</label><br>
				{{ text_field("email","size": 32) }}
			<br><br>
			<label>{{ tr('feusers.phone') }}</label><br>
				{{ text_field("phone","size": 32) }}
			<br><br>
			<label>{{ tr('feusers.address') }}</label><br>
				{{ text_field("address","size": 32) }}
			<br><br>
			<label>{{ tr('feusers.city') }}</label><br>
				{{ text_field("city","size": 32) }}
			<br><br>
			<label>{{ tr('feusers.zip') }}</label><br>
				{{ text_field("zip","size": 32) }}
			<br><br>
			<label>{{ tr('feusers.company') }}</label><br>
				{{ text_field("company","size": 32) }}
			<br><br>
			<label>{{ tr('feusers.profile') }}</label><br>
				 {{ select("profileuid", profiles, 'using': ['uid', 'title']) }}
				 <br><br>
			<label>{{ tr('feusers.usergroup') }}</label><br>
			{{ select("usergroup", usergroups, 'using': ['uid', 'title']) }}
			<br><br>
			<label>{{ tr('feusers.userlanguage') }}</label><br>
			{{ select("userlanguage", languages, 'using': ['uid', 'title']) }}
			<br><br>
			<label>{{ tr('feusers.superuser') }}</label><br>
				 {{ select("superuser", [ '1' : tr('active'), '0' : tr('inactive')], 'value':0) }}
				 <br><br>	 
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
