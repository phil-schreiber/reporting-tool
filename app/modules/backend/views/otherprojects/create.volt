{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>Sonstige Projekte {{tr('create')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/otherprojects/create/', 'method': 'post') }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32) }}
				<br><br>
                                <label>{{ tr('usergroup') }}</label><br>
				{{select('usergroup',usergroups,"using":['uid','title'])}}
                                <br><br>
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description") }}
                                <br><br>
                                <label>{{ tr('starttime') }}</label><br>
				{{ text_field("starttime", "size": 32, "class":"datepicker") }}
				<br><br>
                                <label>{{ tr('endtime') }}</label><br>
				{{ text_field("endtime", "size": 32, "class":"datepicker") }}
				
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
