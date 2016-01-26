{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">

<h1>{{tr('feusersCreateTitle')}}</h1>
	<div class="listelementContainer">
	{{ form('backend/'~language~'/feusers/update/', 'method': 'post') }}

		<label>{{ tr('feusers.username') }}</label><br>
		{{ form.render("username") }}
		<br><br>
		<label>{{ tr('feusers.password') }}</label><br>
		{{ form.render("password") }}
	<br><br>
		<label>{{ tr('feusers.lastname') }}</label><br>
		{{ form.render("last_name") }}
	<br><br>
	<label>{{ tr('feusers.firstname') }}</label><br>
		{{ form.render("first_name") }}
	<br><br>
		<label>{{ tr('feusers.title') }}</label><br>
		{{ form.render("title") }}
		<br><br>
		<label>{{ tr('feusers.email') }}</label><br>
		{{ form.render("email") }}
	<br><br>
	<label>{{ tr('feusers.phone') }}</label><br>
		{{ form.render("phone") }}
	<br><br>
	<label>{{ tr('feusers.address') }}</label><br>
		{{ form.render("address") }}
	<br><br>
	<label>{{ tr('feusers.city') }}</label><br>
		{{ form.render("city") }}
	<br><br>
	<label>{{ tr('feusers.zip') }}</label><br>
		{{ form.render("zip") }}
	<br><br>
	<label>{{ tr('feusers.company') }}</label><br>
		{{ form.render("company") }}
	<br><br>
	<label>{{ tr('feusers.profile') }}</label><br>
		 {{ form.render("profileuid") }}
		 <br><br>
	<label>{{ tr('feusers.usergroup') }}</label><br>
	{{ form.render("usergroup") }}
	{{form.render("uid")}}
	<br><br>
	<label>{{ tr('feusers.userlanguage') }}</label><br>
	{{ form.render("userlanguage") }}
	<br><br>
	<label>{{ tr('feusers.superuser') }}</label><br>
		 {{ form.render("superuser") }}
		 <br><br>	 
		 {{ submit_button(tr('ok')) }}

	</form>
	</div>
</div>
{%- endif -%}

</div>
